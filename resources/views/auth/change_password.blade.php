
@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Change Password  <i class="fas fa-plus-circle fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                     
                        <li class="breadcrumb-item active" class="blue">
                           Change Password
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
        <form action="{{ route('auth.change_password') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            {{ Form::inputPassword('current_password') }}
            {{ Form::inputPassword('new_password') }}
            {{ Form::inputPassword('new_password_confirmation') }}
            
            
            <div class="row">
         <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>

                        <a href="{{ url('/') }}" class="btn btn-primary">
                            Back 
                            <i class="fas fa-fast-forward"></i>
                        </a>
                    </div>
          </div>
            </div>            
        </form>

        </div>
             </div>
        <br/>
        <br /><br /><br />
        </div>
            
    </section>
</section>
@endsection
