<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\Dashboard\Permission\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['roles'] = Role::where('id', '>', 1)->get();
        return view('dashboard.permission.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['latest_roles'] = Role::orderBy('id', 'desc')->take(10)->get();
        return view('dashboard.permission.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = Role::create($request->validated());
        return redirect()->route('dashboard.permission.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
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
        if (!Role::find($id)) {
            return redirect()->route('dashboard.permission.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['role'] = Role::find($id);
        return view('dashboard.permission.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        if (!Role::find($id)) {
            return redirect()->route('dashboard.permission.edit', $id)->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        Role::find($id)->update($request->validated());
        return redirect()->route('dashboard.permission.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Role::find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $permission = Role::find($id)->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }
}
