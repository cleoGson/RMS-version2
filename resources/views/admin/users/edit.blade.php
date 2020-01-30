@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Edit Account Details  
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
             {!! Form::model($show,['method'=>'PATCH','route'=>['admin.users.update',encrypt($show->id)],'files'=>true]); !!}
              @include('admin.users.form')
        <div class="row">
         <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>

                        <a href="{{route('admin.users.index')}}" class="btn btn-primary">
                            Back to List <i class="fas fa-fast-forward"></i>
                        </a>
                    </div>
          </div>
            </div>
            {!! Form::close()!!}
        
        </div>
        </div>
        </div>
            
    </section>
@endsection
