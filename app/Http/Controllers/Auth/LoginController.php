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

protected function hasTooManyLoginAttempts(Request $request)
    {
    
    
      $login_attemp= $this->limiter()->tooManyAttempts($this->throttleKey($request), 10, 30);
      $number_of_attemps=$this->limiter()->hit($this->throttleKey($request));
      if($number_of_attemps < 11){ 
         $message="Attention!! Your have  $number_of_attemps  login attempts, maximum allowed attempt is 10, else Your account will be locked";
         \Session::flash('message',$message);
          return redirect()->route('login');
           return  $login_attemp;
         }
      else if($number_of_attemps = 11){  
          $user_name=explode('|',$this->throttleKey($request));
          $user_detail=User::whereEmail($user_name[0])->first();
          if(!is_null($user_detail)){
          $user_detail->status=0;
          $user_detail->save();
          $message="Your have reach maximum login attemp which is $number_of_attemps your account has been Locked!! please consult  your System Administrator";
          \Session::flash('message',$message);
          return redirect()->route('login');
         }
     
      } 
     else{  
        $message="Attention!! Your   account has been locked, Please contact Your administrator";
         \Session::flash('message',$message);
          return redirect()->route('login');
         }
       


    }

    
}
