<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Package\{PackageRequest, PricePackageRequest};
use App\Models\{Country, Package};
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['packages'] = Package::latest()->paginate(200);
        return view('dashboard.package.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $package = Package::create($request->validated());
        return redirect()->route('dashboard.package.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
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
    public function edit(Request $request, $id)
    {
        if (!Package::find($id)) {
            return redirect()->route('dashboard.package.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['countries'] = Country::get()->pluck('name', 'id');
        $data['package'] = Package::find($id);

        if ($request->type == 'set_price') {
            return view('dashboard.package.edit_price', $data);
        }

        return view('dashboard.package.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
        if (!Package::find($id)) {
            return redirect()->route('dashboard.package.edit', $id)->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $package_data = array_except($request->validated(), ['countries']);
        $package = Package::find($id);
        $package->update($package_data);
        if ($request->countries) {
            $package->countries()->sync($request->countries);
        }
        return redirect()->route('dashboard.package.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_price(PricePackageRequest $request, $id)
    {
        if (!Package::find($id)) {
            return redirect()->route('dashboard.package.edit', $id)->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $package = Package::findOrFail($id);
        if ($request->country_list) {
            $package->countries()->sync($request->country_list);
        }
        return redirect()->route('dashboard.package.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Package::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $package = Package::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }
}
