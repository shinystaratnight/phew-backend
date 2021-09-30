<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use App\Http\Requests\Dashboard\Auth\UpdateProfileData;
use App\Http\Requests\Dashboard\Auth\UpdatePassword;

class AuthController extends Controller
{
    public function signin_view()
    {
        return view('dashboard.auth.login');
    }

    public function signin(Request $request)
    {
        if ($request->email && $request->password) {
            if (auth()->attempt(['email' => $request->email, 'password' => $request->password, 'type' => 'admin'], true)) {
                return redirect()->route('dashboard.home');
            } else {
                $request->session()->flash('warning', trans('dashboard.email_or_password_invalid'));
                return redirect()->route('dashboard.login')
                    ->with('message', trans('dash.messages.data_invalid'))
                    ->with('class', 'danger');
            }
        } else {
            return redirect()->route('dashboard.login')
                ->with('message', trans('dash.messages.data_not_completed'))
                ->with('class', 'danger');
        }
    }

    public function signout()
    {
        auth()->logout();
        return redirect()->route('dashboard.login')
            ->with('message', trans('dash.messages.logged_out_successfully'))
            ->with('class', 'success');
    }

    public function profile()
    {
        return view('dashboard.auth.profile');
    }

    public function update(UpdateProfileData $request)
    {
        User::find(auth()->id())->update(array_except($request->validated(), ['avatar']));
        return redirect()->route('dashboard.admin.profile')->with('class', 'success')->with('message', trans('dash.messages.updated_successfully'));
    }

    public function update_password(UpdatePassword $request)
    {
        if (Hash::check($request->old_password, auth()->user()->getAuthPassword())) {
            User::find(auth()->id())->update(['password' => $request->password]);
            return redirect()->route('dashboard.admin.profile')->with('class', 'success')->with('message', trans('dash.messages.updated_password_successfully'));
        } else {
            return back()->with('message', trans('dash.messages.wrong_password'))->with('class', 'danger');
        }
    }
}
