<?php 
$assigned_roles=$row->roles->pluck('id')->toArray();
$adminrole=in_array(1,$assigned_roles) || in_array(2,$assigned_roles)  ? true : false;
$route =$adminrole ? '.remove_adminrole' : '.ad_adminrole';
$routename=$adminrole ? 'Dismiss From Admin' : 'Make Admin';
$account_display_name =$row->status ==1 ? 'Deactivate Account' : 'Activate Account';
$status_route=$row->status== 1 ? '.account_deactivation': '.account_activation'; 
?>
<div class="dropdown show">
  <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Actions
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> 
<a href="{{ route($routeKey.'.edit',encrypt($row->id)) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i>  Edit</a> 
<a href="{{ route($routeKey.$route,encrypt($row->id)) }}" class="dropdown-item bg-blue text-black" > <i class="fa fa-edit"></i>{{$routename}}</a> 
<a href="{{ route($routeKey.$status_route,encrypt($row->id)) }}" class="dropdown-item bg-green text-black" > <i class="fa fa-edit"></i> {{$account_display_name}}</a> 
<a href="{{ route($routeKey.'.permission',encrypt($row->id)) }}" class="dropdown-item bg-maroon text-black" > <i class="fa fa-edit"></i>  Assign Perrmission</a> 
<a href="{{ route($routeKey.'.password_reset',encrypt($row->id)) }}" class="dropdown-item bg-yellow text-black"  onclick="return confirm('Your are about to reset password, the action cannot be revesed')"> <i class="fa fa-edit"></i>Reset Password</a> 
<a href="{{ route($routeKey.'.email_send_password',encrypt($row->id)) }}" class="dropdown-item bg-indigo text-white"  onclick="return confirm($row->email.' Password  will be regenerated  and emailed to this email ,Please be aware that the action cannot be revesed.')"> <i class="fa fa-edit"></i>Generate,update & Email Password</a> 
<a href="{{ route($routeKey.'.destroy',encrypt($row->id)) }}" class="dropdown-item bg-danger text-black btn-delete" ><i class="fa fa-trash"></i> Delete</a>
  </div>
</div>
