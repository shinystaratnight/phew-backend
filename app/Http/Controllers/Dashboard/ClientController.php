<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Country, Package, PackageUser, User};
use App\Http\Requests\Dashboard\Client\{ClientRequest};
use DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['clients'] = User::where('type', 'client')
            ->when($request->gender, function ($q) use ($request) {
                $q->whereGender($request->gender);
            })
            ->when($request->city_id, function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })->latest()->paginate(200);
        return view('dashboard.clients.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Country::all();
        $data['packages'] = Package::get()->pluck('name', 'id');
        $data['last_clients'] = User::orderBy('id', 'desc')->where('type', 'client')->take(10)->get();
        return view('dashboard.clients.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        DB::beginTransaction();
        try {
            $client = User::create(array_except($request->validated(), ['avatar', 'package_id']) + ['type' => 'client']);
            $client->user_setting()->create();
            $package = Package::find($request->package_id);
            $client_package = PackageUser::create([
                'user_id' => $client->id,
                'package_id' => $package->id,
                'package_type' => $package->package_type,
                'subscription_start_date' => now(),
                'subscription_end_date' => now()->add($package->period, $package->period_type),
                'information' => json_encode($package),
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('dashboard.client.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))
                ->with('class', 'warning')->withInput();
        }
        return redirect()->route('dashboard.client.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!User::where('type', 'client')->find($id)) {
            return redirect()->route('dashboard.client.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['client'] = User::where('type', 'client')->find($id);

        $posts_analytics = \App\Models\Post::where('user_id', $id)->get(['id', 'created_at'])->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
        });

        for ($i = 0; $i <= 12; $i++) {
            if (isset($posts_analytics[now()->subMonths($i)->format('Y-m')])) {
                $data['posts_analytics'][now()->subMonths($i)->format('Y-m')] = $posts_analytics[now()->subMonths($i)->format('Y-m')]->count();
            } else {
                $data['posts_analytics'][now()->subMonths($i)->format('Y-m')] = 0;
            }

        }
        return view('dashboard.clients.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!User::where('type', 'client')->find($id)) {
            return redirect()->route('dashboard.client.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['client'] = User::where('type', 'client')->find($id);
        $data['countries'] = Country::all();
        $data['packages'] = Package::get()->pluck('name', 'id');
        $data['last_clients'] = User::orderBy('id', 'desc')->where('type', 'client')->take(10)->get();
        return view('dashboard.clients.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        if (!User::where('type', 'client')->find($id)) {
            return redirect()->route('dashboard.client.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        DB::beginTransaction();
        try {
            $client = User::find($id)->update(array_except($request->validated(), ['avatar']));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('dashboard.client.edit', $id)
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))
                ->with('class', 'warning')->withInput();
        }
        return redirect()->route('dashboard.client.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!User::where('type', 'client')->find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $user = User::where('type', 'client')->find($id);
        $user->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }
}
