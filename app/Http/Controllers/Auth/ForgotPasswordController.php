<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    // protected function credentials(Request $request)
    // {
    //   $credentials = $request->has('username') ? [$this->username() => $request->username, 'password' => $request->password] : $request->only($this->username(), 'password');
    //   $credentials['is_active'] = 1;
    //   return $credentials;
    // }

    public function username($request)
    {
      $username = $request->username;
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

    protected function validateEmail(Request $request)
    {
      $username = $this->username($request) == 'mobile' ? ['username' => 'required|numeric'] : ['username' => 'required|email'];
      $request->validate($username);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        if ($this->username($request) == 'mobile') {
            $this->sendCodeToMobile($request);
            return redirect(route('password.reset_view')."?mobile=$request->username")->with('true', trans('app.auth.success_send'));
            die;
        }
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $request['email'] = $request->username;
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        return $response == Password::RESET_LINK_SENT
                            ? $this->sendResetLinkResponse($request, $response)
                            : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function sendCodeToMobile($request)
    {
        $user = User::where('mobile',$request->username)->whereNotNull('email_verified_at')->first();
        if (! $user) {
          return redirect()->route('password.email')->with('false', trans('app.auth.mobile_not_true_or_account_not_verified'));
          // ->json(['status' => 'false','data'=> null ,'message'=>trans('app.auth.mobile_not_true')]);
        }
        $code=119911;//mt_rand(100000,999999);
        $user->update(['is_active'=> 0 , 'code' => $code]);
        // Send Code To Mobile;

        // ===================
        // dd(route('password.reset_view'));
        return true;

    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return back()->with('true', trans("passwords.sent"));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
    }
}
