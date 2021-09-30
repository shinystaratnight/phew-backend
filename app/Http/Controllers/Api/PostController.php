<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\{PostRequest, UpdatePostRequest, UpdatePrivacyPostRequest};
use App\Http\Resources\Post\{HomeResource, PostResource};
use App\Http\Resources\User\{UserListResource};
use App\Models\{AdSponsor, Post, FindlyPost};
use App\Notifications\Api\ApiNotification;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type == 'friends') {
            $posts = Post::whereHas('user', function ($q) {
                $q->whereHas('friends', function ($query) {
                    $query->where(['user_id' => auth('api')->id()]);
                    $query->orWhere(['friend_id' => auth('api')->id()]);
                });
            })->latest()->paginate(10);
        } else {
            $posts = Post::latest()->paginate(10);
        }
        if (auth('api')->check()) {
            auth('api')->user()->update(['last_seen_at' => now()]);
        }
        $new_posts = collect();
        $ads_in_collect = collect();
        $count_ads = \App\Models\AdSponsor::whereDoesntHave('hidden_ad', function ($query){
            $query->where('user_id', auth('api')->id());
        })->count();
        // dump($count_ads);
        foreach ($posts as $key => $item) {
            if ($count_ads > 0 && $key != 0 && (($key % 2) == 0)) {
                $ads = \App\Models\AdSponsor::whereDoesntHave('hidden_ad', function ($query){
                    $query->where('user_id', auth('api')->id());
                })->when($ads_in_collect->count() <= $count_ads, function ($q) use ($ads_in_collect) {
                    $q->whereNotIn('id', $ads_in_collect->pluck('id'));
                })->inRandomOrder()->first();
                $ads_in_collect->push($ads);
                if ($ads_in_collect->count() == $count_ads) {
                    $ads_in_collect = collect();
                }
                // dump($ads);
                $new_posts->push($ads);
            }
            $new_posts->push($item);
        }
        // dd('gfgfdd');
        return HomeResource::collection($new_posts)->additional(['status' => 'true', 'message' => '', "meta" => [
            "current_page" => $posts->currentPage(),
            "from" => $posts->firstItem(),
            "last_page" => $posts->lastPage(),
            "path" => $posts->url($request->page),
            "per_page" => $posts->perPage(),
            "to" => $posts->lastItem(),
            "total" => $posts->total()
        ]]);
    }

    public function store(PostRequest $request)
    {
        \DB::beginTransaction();
        try {
            $post_data = array_only($request->validated(), ['post_type', 'activity_type', 'text', 'show_privacy']);
            if ($request->post_id) {
                $retweeted_post = Post::find($request->post_id);
                $post = $retweeted_post->retweet()->create($post_data + [
                        'user_id' => auth('api')->id(),
                        'city_id' => auth('api')->user()->city_id,
                        'country_id' => auth('api')->user()->country_id
                    ]);

                if(auth('api')->id() != $retweeted_post->user_id){
                    $data = [
                        'key' => "retweeted_post",
                        'key_type' => "post",
                        'key_id' => $retweeted_post->id,
                        'title' => [
                                'ar' => trans('app.notification.title.retweeted_post', [], 'ar'),
                                'en' => trans('app.notification.title.retweeted_post', [], 'en'),
                            ],
                        'body' => [
                            'ar' => trans('app.notification.body.retweeted_post', ['sender_name' => auth('api')->user()->fullname], 'ar'),
                            'en' => trans('app.notification.body.retweeted_post', ['sender_name' => auth('api')->user()->fullname], 'en'),
                        ],
                        'sender_data' => new UserListResource(auth('api')->user()),
                    ];
                    $retweeted_post->user->notify(new ApiNotification($data, ['database', 'fcm']));
                }
            } else {
                $post = Post::create($post_data + [
                        'user_id' => auth('api')->id(),
                        'city_id' => auth('api')->user()->city_id,
                        'country_id' => auth('api')->user()->country_id
                    ]);
            }
            if ($request->friends_with) {
                $post->mentions()->sync($request->friends_with);
            }
            if ($request->watching && $request->movie_id) {
                $movie = \App\Models\Movie::where('movie_id', $request->movie_id)->first();
                if($movie){
                    $movie->increment('counter');
                }else{
                    \App\Models\Movie::create([
                        'movie_id' => $request->movie_id,
                        'movie_data' => $request->watching,
                        'counter' => 1,
                    ]);
                }
            }
            if($request->show_in_findly == true){
                $user_package = auth('api')->user()->package_user()->where('subscription_start_date', '<=', date('Y-m-d'))->where('subscription_end_date', '>=', date('Y-m-d'))->latest()->first();
                $expire_date = now()->addHours((integer) settings('duration_of_the_post_for_normal_user_in_findly_by_hours'));
                if($user_package && $user_package->package_type == 'paid'){
                    $expire_date = now()->addHours((integer) settings('duration_of_the_post_for_premium_user_in_findly_by_hours'));
                }
                FindlyPost::updateOrCreate(['user_id' => auth('api')->id(), 'post_id' => $post->id], ['expire_date' => $expire_date]);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => '', 'data' => new PostResource($post)], 200);
    }

    public function update(UpdatePostRequest $request, $post_id)
    {
        \DB::beginTransaction();
        try {
            $post = Post::where('user_id', auth('api')->id())->findOrFail($post_id);
            $post->update($request->validated());
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => '', 'data' => new PostResource($post)], 200);
    }

    public function update_privacy(UpdatePrivacyPostRequest $request, $post_id)
    {
        \DB::beginTransaction();
        try {
            $post = Post::where('user_id', auth('api')->id())->findOrFail($post_id);
            $post->update($request->validated());
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => '', 'data' => new PostResource($post)], 200);
    }

    public function show(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);
        return response()->json(['status' => 'true', 'message' => '', 'data' => new PostResource($post)], 200);
    }

    public function destroy(Request $request, $post_id)
    {
        $post = Post::where('user_id', auth('api')->id())->findOrFail($post_id);
        $post->delete();
        return response(['status' => 'true', 'message' => trans('app.messages.deleted_successfully'), 'data' => null], 200);
    }

    public function hide_ad(Request $request, $ad_id)
    {
        $ad = AdSponsor::findOrFail($ad_id);
        auth('api')->user()->hidden_ad()->updateOrCreate(['ad_sponsor_id' => $ad_id], ['ad_sponsor_id' => $ad_id]);
        return response(['status' => 'true', 'message' => trans('app.messages.hidden_successfully'), 'data' => null], 200);
    }
}
