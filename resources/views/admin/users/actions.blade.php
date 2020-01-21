<?php 
$assigned_roles=$row->roles->pluck('id')->toArray();
$adminrole=in_array(1,$assigned_roles) || in_array(2,$assigned_roles)  ? true : false;
$route =$adminrole ? '.remove_adminrole' : '.ad_adminrole';
$routename=$adminrole ? 'Dismiss From Admin' : 'Make Admin';
$account_display_name =$row->status ==1 ? 'Deactivate Account' : 'Activate Account';
$account_route=$row->status== 1 ? '.deactivate_account': '.activate_account'; 
?>


<div class="dropdown show">
  <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Actions
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> 
<a href="{{ route($routeKey.'.edit',encrypt($row->id)) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i>  Edit</a> 
<a href="{{ route($routeKey.$route,encrypt($row->id)) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i>{{$routename}}</a> 
<a href="{{ route($routeKey.'.edit',encrypt($row->id)) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i> {{$account_display_name}}</a> 
<a href="{{ route($routeKey.'.permission',encrypt($row->id)) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i>  Assign Perrmission</a> 
<a href="{{ route($routeKey.'.destroy',encrypt($row->id)) }}" class="dropdown-item bg-danger text-white btn-delete" ><i class="fa fa-trash"></i> Delete</a>
  </div>
</div>
