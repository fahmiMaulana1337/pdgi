<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo;

    protected function redirectTo(){
        if(Auth()->user()->role=="1")
        {
            return route('isSuperAdmin');
        }
        elseif(Auth()->user()->role == "2")
        {
            return route('isAdmin');
        }
        elseif(Auth()->user()->role == "3")
        {
            return route('isUser');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $email =$request->input('email');
        $password =$request->input('password');

        if(auth()->attempt(array('email'=>$email, 'password'=>$password)))
        {
            
            if(auth()->user()->role == "1")
            {
                return redirect()->route('isSuperAdmin');
            }
            elseif(auth()->user()->role == "2")
            {
                return redirect()->route('isAdmin');
            }
            elseif(auth()->user()->role == "3")
            {
                return redirect()->route('isUser');
            }
        }
        else
        {
            return Redirect::back()->withErrors(
                [
                    'email' => 'email salah',
                    'password'=>'password salah'
                ]
            );
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

}
