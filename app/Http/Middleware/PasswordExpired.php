<?php

namespace App\Http\Middleware;
use Carbon\Carbon;
use Closure;

class PasswordExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      
        $user = $request->user();
        if($user->userable_type=='App\Staff'){
         $password_changed_at = new Carbon(($user->password_changed_at) ? $user->password_changed_at : $user->created_at);
        if(is_null($user->password_changed_at)){
          alert()->success('Welcome Your Login For The 1st Time, Please Change Your Password.  ', 'Change Password', 'success')->persistent('Click');            
         return redirect()->route('change-form');    
        }
        elseif (Carbon::now()->diffInDays($password_changed_at) >= config('systemconfigurations.password_expires_days')) {
        alert()->success('Your password has been expired, Please Change Your Password.  ', 'Change Password', 'success')->persistent('Click');    
        return redirect()->route('change-form');
        }  
        } 
        return $next($request);
  
    }
    
}
