<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Country\{NationalityRequest};
use App\Models\{Nationality, User};

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['nationalities'] = Nationality::paginate(200);
        return view('dashboard.nationality.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['latest_nationalities'] = Nationality::orderBy('id', 'desc')->take(10)->get();
        return view('dashboard.nationality.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NationalityRequest $request)
    {
        $nationality = Nationality::create($request->validated());
        return redirect()->route('dashboard.nationality.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Nationality::find($id)) {
            return redirect()->route('dashboard.nationality.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['nationality'] = Nationality::find($id);

        $this->data['clients_count'] = User::where('nationality_id', $id)->where('type', 'client')->count();

        $client_active_analytics = User::where(['type' => 'client', 'nationality_id' => $id])->active()->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });
        $client_deactive_analytics = User::where(['type' => 'client', 'nationality_id' => $id])->where(['is_active' => false])->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });
        $client_blocked_analytics = User::where(['type' => 'client', 'nationality_id' => $id])->where(['is_banned' => true])->get(['id', 'created_at'])->groupBy(function ($date) {
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
        return view('dashboard.nationality.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Nationality::find($id)) {
            return redirect()->route('dashboard.nationality.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['latest_nationalities'] = Nationality::orderBy('id', 'desc')->take(10)->get();
        $this->data['nationality'] = Nationality::find($id);
        return view('dashboard.nationality.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NationalityRequest $request, $id)
    {
        if (!Nationality::find($id)) {
            return redirect()->route('dashboard.nationality.edit', $id)->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        Nationality::find($id)->update($request->validated());
        return redirect()->route('dashboard.nationality.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Nationality::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $nationality = Nationality::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }
}
