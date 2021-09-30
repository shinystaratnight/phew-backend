<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{AdSponsor, Sponsor};
use App\Http\Requests\Dashboard\Ad\AdRequest;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['ads'] = AdSponsor::latest()->paginate(200);
        return view('dashboard.ad.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['sponsors'] = Sponsor::get()->pluck('name', 'id');
        return view('dashboard.ad.create', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        \DB::beginTransaction();
        try {
            $ad = AdSponsor::create(array_except($request->validated(), ['file', 'file_type']));
            \DB::commit();
        } catch (Exception $e) {
            \DB::rollback();
            dd($e);
            return redirect()->route('dashboard.client.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))
                ->with('class', 'warning')->withInput();
        }
        return redirect()->route('dashboard.ad.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!AdSponsor::find($id)) {
            return redirect()->route('dashboard.ad.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['sponsors'] = Sponsor::get()->pluck('name', 'id');
        $data['ad'] = AdSponsor::find($id);
        return view('dashboard.ad.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, $id)
    {
        if (!AdSponsor::find($id)) {
            return redirect()->route('dashboard.ad.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $ad = AdSponsor::find($id);
        $ad->update(array_except($request->validated(), ['file', 'file_type']));
        return redirect()->route('dashboard.ad.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!AdSponsor::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $ad = AdSponsor::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }
}
