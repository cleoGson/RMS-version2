@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        User Account Details  <i class="fas fa-list fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}" class="blue">Users List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                             User Account Details
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
          <div class="card-body card card-accent-primary">

            <table class="table table-responsive-sm table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <th>
                      
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                            <tr>
                                <th>verified Account</th>
                            <td>  {{ $user->verifiedstatus ==1 ? "Yes" : '' }} </td></tr> 
                            <tr><th>User Type</th>
                            <td>  {{ $user->userable_type ?? '' }} </td></tr>
                            <tr><th>Password Changed</th>
                            <td>  {{ $user->password_changed_at ?? ''}} </td></tr>
                            <tr><th>status</th>
                            <td>  {{ $user->status ==1 ? 'Active' : '' }}  </td></tr> 
                            <tr><th>Created By:</th>
                            <td>  {{ $user->creator->username ?? '' }}  </td></tr> 
                            <tr><th>Updated By:</th>
                            <td>  {{ $user->updator->username ?? ''}} </td></tr>
                    <tr>
                        <th>
                        username
                        </th>
                        <td>
                            {{ $user->username ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Roles
                        </th>
                        <td>
                            @foreach($user->roles()->pluck('name') as $role)
                                <span class="label label-info label-many">{{ $role }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
               <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <a href="{{route('admin.users.index')}}" class="btn btn-default">
                            Back to List <i class="fas fa-list fa-fw"></i>
                        </a>
                    </div>
          </div>
            </div>
            </div>
        </div>
        </div>
            
    </section>
</section>
@endsection