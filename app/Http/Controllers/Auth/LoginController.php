<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
 
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
         $this->middleware('guest:applicants')->except('logout');
    }


        public function showApplicantLoginForm()
    {
        return view('auth.login', ['url' => 'applicant']);
    }

    public function applicantLogin(Request $request)
    {
      
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]); 

        if (Auth::guard('applicants')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('applicant/applicantdashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    
}
