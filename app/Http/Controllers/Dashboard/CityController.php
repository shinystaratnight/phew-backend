<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    City, Country, Package, Store, Street, User
};
use App\Http\Requests\Dashboard\City\{CityRequest};

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['cities'] = City::when($request->country_id,function($q)use($request){
            $q->where('country_id',$request->country_id);
        })->latest()->paginate(200);
        $this->data['countries'] = Country::get()->pluck('name', 'id');
        return view('dashboard.city.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['countries'] = Country::get()->pluck('name', 'id');
        $this->data['latest_cities'] = City::latest()->take(10)->get();
        return view('dashboard.city.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->validated());
        return redirect()->route('dashboard.city.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
    }



    public function show($id)
    {
        if (!City::find($id)) {
            return redirect()->route('dashboard.city.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['city'] = City::find($id);

        $this->data['clients_count'] = User:: where('type', 'client')->where(['city_id' => $id])->count();

        return view('dashboard.city.show', $this->data);
    }


    public function edit($id)
    {
        if (!City::find($id)) {
            return redirect()->route('dashboard.city.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['latest_cities'] = City::latest()->take(10)->get();
        $this->data['city'] = City::find($id);
        $this->data['countries'] = Country::get()->pluck('name', 'id');
        return view('dashboard.city.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        if (!City::find($id)) {
            return redirect()->route('dashboard.city.edit', $id)->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        City::find($id)->update($request->validated());
        return redirect()->route('dashboard.city.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!City::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $city = City::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }

    public function get_cities_by_country($country_id)
    {
        $cities = City::where('country_id', $country_id)->listsTranslations('name')->get()->pluck('name', 'id');
        $view = view('dashboard.city.ajax.get_cities', compact('cities'))->render();
        return response()->json(['value' => 1, 'view' => $view]);
    }


    public function getCities(Request $request)
    {

        $country = Country::find($request->country_id);

        if(!$country) return response()->json(['status' => false], 500);

        return response()->json(['cities' => $country->cities, 'status' => true], 200);
    }
}
