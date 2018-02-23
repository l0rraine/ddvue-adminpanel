<?php

namespace DDVue\AdminPanel\app\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LdapLoginController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('DDVue.AdminPanel.home');
        $this->middleware('guest')->except('logout');
    }


    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'email' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function guard()
    {
        return \Auth::guard('ddvue_ldap');
    }
}
