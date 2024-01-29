<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller {
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

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules() {
        return [
            'token' => 'required',
            'email' => 'required|email|min:5|max:150',
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5',
            'password' => [
                'max:' . config('cms.password_max_chars'),
                'required',
                'confirmed',
                        Password::min(config('cms.password_min_chars'))
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
            ],
        ];
    }

}
