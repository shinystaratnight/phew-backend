<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\{CountryRequest};
use App\Models\{City, Country, User};

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['countries'] = Country::paginate(200);
        return view('dashboard.country.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['latest_countries'] = Country::orderBy('id', 'desc')->take(10)->get();
        return view('dashboard.country.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create(array_except($request->validated(), ['flag']));
        return redirect()->route('dashboard.country.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Country::find($id)) {
            return redirect()->route('dashboard.country.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['country'] = Country::find($id);
        $this->data['cities_count'] = City::where(['country_id' => $id])->count();

        $this->data['clients_count'] = User::whereHas('city', function ($query) use ($id) {
            $query->where('country_id', $id);
        })->where('type', 'client')->count();

        $client_active_analytics = User::where(['type' => 'client', 'country_id' => $id])->active()->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });
        $client_deactive_analytics = User::where(['type' => 'client', 'country_id' => $id])->where(['is_active' => false])->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });
        $client_blocked_analytics = User::where(['type' => 'client', 'country_id' => $id])->where(['is_banned' => true])->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });

        for ($i = 0; $i <= 12; $i++) {
            if ($i == 0) {
                if (isset($client_active_analytics[now()->format('Y-m')])) {
                    $this->data['client_active_analytics'][now()->format('Y-m')] = $client_active_analytics[now()->format('Y-m')]->count();
                } else {
                    $this->data['client_active_analytics'][now()->format('Y-m')] = 0;
                }
                if (isset($client_deactive_analytics[now()->format('Y-m')])) {
                    $this->data['client_deactive_analytics'][now()->format('Y-m')] = $client_deactive_analytics[now()->format('Y-m')]->count();
                } else {
                    $this->data['client_deactive_analytics'][now()->format('Y-m')] = 0;
                }
                if (isset($client_blocked_analytics[now()->format('Y-m')])) {
                    $this->data['client_blocked_analytics'][now()->format('Y-m')] = $client_blocked_analytics[now()->format('Y-m')]->count();
                } else {
                    $this->data['client_blocked_analytics'][now()->format('Y-m')] = 0;
                }
            } else {
                if (isset($client_active_analytics[now()->subMonths($i)->format('Y-m')])) {
                    $this->data['client_active_analytics'][now()->subMonths($i)->format('Y-m')] = $client_active_analytics[now()->subMonths($i)->format('Y-m')]->count();
                } else {
                    $this->data['client_active_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
                }
                if (isset($client_deactive_analytics[now()->subMonths($i)->format('Y-m')])) {
                    $this->data['client_deactive_analytics'][now()->subMonths($i)->format('Y-m')] = $client_deactive_analytics[now()->subMonths($i)->format('Y-m')]->count();
                } else {
                    $this->data['client_deactive_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
                }
                if (isset($client_blocked_analytics[now()->subMonths($i)->format('Y-m')])) {
                    $this->data['client_blocked_analytics'][now()->subMonths($i)->format('Y-m')] = $client_blocked_analytics[now()->subMonths($i)->format('Y-m')]->count();
                } else {
                    $this->data['client_blocked_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
                }
            }
        }
        return view('dashboard.country.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Country::find($id)) {
            return redirect()->route('dashboard.country.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['latest_countries'] = Country::orderBy('id', 'desc')->take(10)->get();
        $this->data['country'] = Country::find($id);
        return view('dashboard.country.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        if (!Country::find($id)) {
            return redirect()->route('dashboard.country.edit', $id)->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        Country::find($id)->update(array_except($request->validated(), ['flag']));
        return redirect()->route('dashboard.country.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Country::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $country = Country::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }
}
