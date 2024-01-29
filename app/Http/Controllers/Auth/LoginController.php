<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCodeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use JanisKelemen\Setting\Facades\Setting;

class LoginController extends Controller {
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
    
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 60; // Default is 1

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);
    }
    
    protected function authenticated(Request $request, $user) {

        if (Setting::get('twofa_by_email') != 0) {
            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCodeNotification());
        }
    }

    // #CHANGE LOGOUT URL
    public function logout(Request $request) {

        Auth::logout();
        return redirect()->route('admin.dashboard');
    }

}
