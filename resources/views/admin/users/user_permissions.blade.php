@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
            Assign Specific  Permission to  {{$user->username}}
                    </h1>
                </div>

               <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}" class="blue">Users List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Edit User
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
            <div class="row">
                    <div class="col-md-4">
                        <h3>Username :</h3> {{ $user->username }}
                    </div>
                   
                    <div class="col-md-8">
                        <h3>Email Address : </h3>{{ $user->email }}
                        <h3>Attached Roles</h3>
                        @if($user->roles)
                            @foreach($user->roles as $role)
                                <center><p>{{ $role->display_name }}</p> </center>
                                @endforeach
                            @else
                            <h4> No role attached to this user</h4>
                        @endif
                    </div>
                </div>
                   <div class="row">
                    <div class="col-md-12">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.users.process_permission') }}">
                        {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="form-group">
                                <h3 class="text-center">Attach Permissions</h3>
                                <div class="form-group row">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                @foreach($permissions as $permission)
                                    <div class="col-md-3">
                                     
                                      @if(isset($role))
                                        @if($role->permissions)
                                            @if(in_array($permission->id ,$extrapermission))
                                                @foreach($extrapermission as $perm=>$value)
                                                    @if($permission->id == $value)
                                                        <input class="permission_ids" type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" checked="checked">
                                                        {{ $permission->display_name  }}<br/>
                                                        @endif
                                                    @endforeach
                                                @else
                                                <input class="permission_ids" type="checkbox" name="permission_ids[]" value="{{ $permission->id }}"> {{ $permission->display_name  }}<br/>
                                            @endif
                                        @else
                                            <input type="checkbox" class="permission_ids" name="permission_ids[]" value="{{ $permission->id }}"> {{ $permission->display_name  }}<br/>
                                        @endif
                                        @endif
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            <div class="col-md-12 form-group text-right">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                    
                                <a href="{{route('admin.users.index')}}" class="btn btn-warning">
                                    Cancel
                                </a>
                            </div>
                             </div>
                        </form>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                @endsection



                                 



