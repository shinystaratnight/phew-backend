<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Website\Auth\RegisterNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  protected function credentials(Request $request)
  {
    $credentials = $request->has('username') ? [$this->username() => $request->username, 'password' => $request->password] : $request->only($this->username(), 'password');
    //$credentials['is_active'] = 1;
    return $credentials;
  }

  public function username()
  {
    $username = request()->username;
    switch ($username) {
      case filter_var($username, FILTER_VALIDATE_EMAIL):
        $username = 'email';
        break;
      case is_numeric($username):
        $username = 'mobile';
        break;
      default:
        $username = 'email';
        break;
    }
    return $username;
  }

  protected function validateLogin(Request $request)
  {
    $username = $this->username() == 'mobile' ? ['username' => 'required|numeric'] : ['username' => 'required|email'];
    $request->validate([
      'password' => 'required|string'
    ] + $username);
  }
  /**
   * Get the post register / login redirect path.
   *
   * @return string
   */
  public function redirectPath()
  {
      if (auth()->user()->role()->exists()) {
          $this->redirectTo = 'dashboard/';
          return $this->redirectTo;
      }else{
      $this->redirectTo = '/';
    }
    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
  }
  /**
   * Show the application's login form.
   *
   * @return \Illuminate\Http\Response
   */
  public function showLoginForm()
  {
    $locale = app()->getLocale();
    if (request()->is("$locale/dashboard/*") || request()->is("$locale/dashboard") || request()->is("$locale/dashboard/") || request()->is("dashboard/*") || request()->is("dashboard") || request()->is("dashboard/")) {
      return view("dashboard.auth.login");
    }
    return view("site.pages.auth.login");
  }

  //To Confirmation Email
  public function confirm($code)
  {
    try {
      if (!$code)
        return redirect()->route('website.home')->withFalse(trans('dash.auth.code_not_match'));
      $user = User::where('code', $code)->first();
      if (!$user) {
        return redirect()->route('website.home')->withFalse(trans('dash.auth.code_not_true'));
      }
      $user->update(['is_active' => 1, 'code' => null, 'email_verified_at' => now()]);
      auth()->login($user);

      $admins = User::where('type', 'admin')->get();
      \Notification::send($admins, new RegisterNotification(['broadcast'], trans('site.notification.admin_messages.new_account', ['username' => $user->fullname])));

      \DB::commit();
    } catch (\Exception $e) {
      \DB::rollback();
      return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
    }
    return redirect()->route('website.home')->withTrue(trans('site.messages.account_has_been_successfully_activated'));
  }

  public function logout(Request $request)
  {
    $redirect = 'website.home';
    if (auth()->check()) {
      if (auth()->user()->type == 'admin' && auth()->user()->role()->exists()) {
        $redirect = 'dashboard.login';
      }else {
        $redirect = 'website.home';
      }
    }
    $this->guard()->logout();
    $request->session()->invalidate();
    session()->flash('info', trans('dash.messages.logged_out_successfully'));
    return redirect()->route($redirect);
  }
}
