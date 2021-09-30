<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Website\Auth\ResetPasswordRequest;
use App\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request, $token = null)
    {
        $data['token'] = $token;
        if ($request->mobile) {
            $view = 'auth.passwords.reset_mobile';
            $data['mobile'] = $request->mobile;
        }else{
            $view = 'auth.passwords.reset';
            $data['email'] = $request->email;
        }
        return view($view,$data);
    }

    public function redirectPath()
    {
        if (auth()->user()->role()->exists()) {
          $this->redirectTo='dashboard/';
          return $this->redirectTo;
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    public function resetMobile(ResetPasswordRequest $request)
    {
        $user = User::where(['mobile' => $request->mobile , 'code' => $request->code])->whereNotNull('email_verified_at')->first();
        if (! $user) {
          return back()->with('false', trans('app.auth.mobile_not_true_or_account_not_verified'));
        }
        $user->update(['is_active' => true,'password' => $request->password , 'code' => null]);
        return redirect(route('website.login'))->with('true', trans('app.auth.success_reset_password'));
    }

    protected function resetPassword($user, $password)
    {

        $user->password = $password;
        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }
}
