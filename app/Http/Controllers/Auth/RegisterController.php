<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Auth\RegisterRequest;
use App\Notifications\Website\Auth\RegisterNotification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'username' => ['required', 'string', 'max:255'],
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'mobile' => ['required', 'numeric', 'unique:users'],
        //     'password' => ['required', 'string', 'min:6', 'confirmed'],
        //     'nationality_id' => ['required', 'numeric', 'exists:nationalities,id'],
        //     'gender' => ['required', 'in:male,female'],
        // ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // يرجى تشغيل الـ GPS
        $session_country = session('gps');
        if (!isset($session_country['country_id'])) {
            return redirect()->route('website.home')->withFalse(trans('site.messages.please_turn_on_the_GPS_locator'));
        }
        if ($session_country['country_id'] == 0) {
            return redirect()->route('website.home')->withFalse(trans('site.messages.please_turn_on_the_GPS_locator'));
        }
        $data['country'] = \App\Models\Country::findOrFail($session_country['country_id']);
        $data['nationalities'] = \App\Models\Nationality::oldest('ordering')->get()->pluck('name', 'id');
        $data['cities'] = \App\Models\City::where('country_id', $data['country']->id)->listsTranslations('name', 'id')->get()->pluck('name', 'id');
        return view('site.pages.auth.register', $data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create($data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user = User::create(array_except($request->validated() + ['code' => /*str_random(60) mt_rand(100000, 999999)*/'111111', 'is_active' => true], ['avatar','policy','g-recaptcha-response']));
            $user->user_setting()->create(['advertising_messages_alerts' => true, 'store_message_alerts' => true]);
            //$user->notify(new RegisterNotification(['mail']));

            /* start function send activation code*/
            //
            /* end function send activation code*/

            // $admins = User::where('type', 'admin')->get();
            // \Notification::send($admins, new RegisterNotification(['broadcast']));

            auth()->login($user);

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->route('website.register')
                ->withFalse(trans('dash.messages.something_went_wrong_please_try_again'));
        }
        // return view('site.pages.auth.activation',compact('user'))
        //     ->withTrue(trans('site.messages.registered_successfully_please_check_mail_to_activate_the_account'));
        return redirect()->route('website.home');
    }
}
