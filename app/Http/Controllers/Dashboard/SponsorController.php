<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Sponsor\{SponsorRequest};
use App\Models\{Sponsor};

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sponsors'] = Sponsor::latest()->paginate(200);
        return view('dashboard.sponsor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SponsorRequest $request)
    {
        $sponsor = Sponsor::create(array_except($request->validated(), ['logo']));
        return redirect()->route('dashboard.sponsor.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Sponsor::find($id)) {
            return redirect()->route('dashboard.sponsor.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['latest_countries'] = Sponsor::orderBy('id', 'desc')->take(10)->get();
        $data['sponsor'] = Sponsor::find($id);
        return view('dashboard.sponsor.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SponsorRequest $request, $id)
    {
        if (!Sponsor::find($id)) {
            return redirect()->route('dashboard.sponsor.edit', $id)->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        Sponsor::find($id)->update(array_except($request->validated(), ['logo']));
        return redirect()->route('dashboard.sponsor.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Sponsor::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $sponsor = Sponsor::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }
}
