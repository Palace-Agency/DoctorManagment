<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // if ($user->isActive != '1') {
        //     Auth::logout();
        //     return redirect()->route('login')->with('danger', 'Your account is not activated.');
        // }
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dash')->with('success', 'Welcome to the dashboard');
        } elseif($user->hasRole('doctor')) {
            return redirect()->route('cabinet.dash')->with('success', 'Logged in successfully');
        }elseif($user->hasRole('patient')){
            return redirect()->route('client.index')->with('success', 'Logged in successfully');
        }elseif($user->hasRole('employee')){
            return redirect()->route('cabinet.dash')->with('success', 'Logged as employee successfully');
        }
    }
}
