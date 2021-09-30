<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Auth;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Dashboard\Admin\AdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admins'] = User::where('type', 'admin')->latest()->get();
        return view('dashboard.admins.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['roles'] = Role::get()->pluck('name', 'id');
        $this->data['last_admins'] = User::orderBy('id', 'desc')->where('type', 'admin')->take(10)->get();
        return view('dashboard.admins.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        DB::beginTransaction();
        try {
            $admin = User::create(array_except($request->validated(), ['avatar']) + ['type' => 'admin']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('dashboard.admin.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))
                ->with('class', 'warning')
                ->withInput($request->validated());
        }
        return redirect()->route('dashboard.admin.index')->with('class', 'success')->with('message', trans('dash.messages.added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!User::where('type', 'admin')->find($id)) {
            return redirect()->route('dashboard.admin.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $this->data['admin'] = User::where('type', 'admin')->find($id);
        $this->data['roles'] = Role::get()->pluck('name', 'id');
        $this->data['last_admins'] = User::orderBy('id', 'desc')->where('type', 'admin')->take(10)->get();
        return view('dashboard.admins.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        if (!User::where('type', 'admin')->find($id)) {
            return redirect()->route('dashboard.admin.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        DB::beginTransaction();
        try {
            $admin = User::find($id)->update(array_except($request->validated(), ['avatar']));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('dashboard.admin.edit', $id)
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))
                ->with('class', 'warning')
                ->withInput($request->validated());
        }
        return redirect()->route('dashboard.admin.index')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!User::where('type', 'admin')->find($id)) {
            $response = ['status' => 'false', 'message' => trans('dash.messages.try_2_access_not_found_content')];
            return $response;
        }
        $user = User::where('type', 'admin')->find($id);
        $user->forceDelete();
        return ['status' => 'true', 'message' => trans('dash.messages.deleted_successfully')];
    }

    public function chat()
    {
        return view('dashboard.admins.chat');
    }
}
