<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\{PostIdRequest};
use App\Http\Resources\Post\{PostResource, HomeResource};
use Illuminate\Http\Request;
use App\Models\{FindlyPost, Post};
use App\Http\Resources\Country\{CityResource, CountryResource};

class FindlyController extends Controller
{
    public function index(Request $request)
    {
        $countries = \App\Models\Country::where('in_findly', true)->get();
        return response()->json(['status' => 'true', 'message' => '', 'data' => CountryResource::collection($countries)], 200);
    }

    public function cities(Request $request, $country_id)
    {
        $cities = \App\Models\City::where('country_id', $country_id)->whereHas('likes')->with('likes')->withCount('likes')->latest('likes_count')->get();
//        dd($cities);
        return response()->json(['status' => 'true', 'message' => '', 'data' => CityResource::collection($cities)], 200);
    }

    public function posts(Request $request, $country_id, $city_id)
    {
        $posts = Post::where(['country_id' => $country_id, 'city_id' => $city_id])->withCount(['likes', 'comments'])->where(function ($query) {
            $query->whereDoesntHave('findly');
            $query->orWhereHas('findly', function ($query) {
                $query->whereDate('expire_date', '>=', now()->format('Y-m-d h:i:s'));
            });
        })->orderBy(\DB::raw("`likes_count` + `comments_count`"), 'desc')->paginate(10);
        $new_posts = $posts->filter(function ($value, $key) {
            $total = $value->comments_count + $value->likes_count;
            return $total >= settings('total_interaction_on_post_to_be_displayed_in_findly');
        });

        return HomeResource::collection($new_posts)->additional(['status' => 'true', 'message' => '', "meta" => [
            "current_page" => $posts->currentPage(),
            "from" => $posts->firstItem(),
            "last_page" => $posts->lastPage(),
            "path" => $posts->url($request->page),
            "per_page" => $posts->perPage(),
            "to" => $posts->lastItem(),
            "total" => $posts->total()
        ]]);

        // return PostResource::collection($posts)->additional(['status' => 'true', 'message' => '']);
    }

    public function store(PostIdRequest $request, $post_id){
        $post = Post::where('user_id', auth('api')->id())->findOrFail($post_id);
        if($post->likes->count() < (integer) settings('limit_of_emojis_to_publish_on_findly')){
            return response()->json(['status' => 'false', 'message' => trans('app.messages.post_has_not_reached_the_required_threshold_for_posting_on_findly'), 'data' => null], 401);
        }
        $user_package = auth('api')->user()->package_user()->where('subscription_start_date', '<=', date('Y-m-d'))->where('subscription_end_date', '>=', date('Y-m-d'))->latest()->first();
        $expire_date = now()->addHours((integer) settings('duration_of_the_post_for_normal_user_in_findly_by_hours'));
        if($user_package && $user_package->package_type == 'paid'){
            $expire_date = now()->addHours((integer) settings('duration_of_the_post_for_premium_user_in_findly_by_hours'));
        }
        FindlyPost::updateOrCreate(['user_id' => auth('api')->id(), 'post_id' => $request->post_id], ['expire_date' => $expire_date]);
        return response(['status' => 'true', 'message' => trans('app.messages.sent_successfully'), 'data' => null], 200);
    }
}
