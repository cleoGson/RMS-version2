@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Create User  <i class="fas fa-plus-circle fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}" class="blue">User List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Create User Account
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

        <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.role.fields.title') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group">
                <fieldset>
                    <br />
                    Attached permissions
                    <hr/>

                        @php($inroledata=[])
                    <br />
                    <ul style = "-moz-column-count: 3;-moz-column-gap: auto;-webkit-column-count: 3;-webkit-column-gap: auto;column-count: 5;column-gap: auto;list-style-type:none;">
                       @foreach($permissions as $key=>$value)
                                       <h5 style = "font-size:14px;text-transform:uppercase;"><b></b></h5>
                                    
                                        @if(in_array($key,$inroledata))
                                            <li><input type="checkbox" class="permission" name="permission[]" value="{{ $key }}" checked> {{ $value }}</li>
                                        @else
                                            <li><input type="checkbox" class="permission" name="permission[]" value="{{ $key }}"> {{ $value }}</li>
                                        @endif
                        @endforeach
                        <hr style = "width:100%;"/>
                        </ul>    
            </fieldset>
                </div>
                <div class="row">
               <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>

                        <a href="{{route('admin.roles.index')}}" class="btn btn-primary">
                            Back to List <i class="fas fa-fast-forward"></i>
                        </a>
                    </div>
          </div>
            </div>
        </form>
         </div>
        </div>
        </div>
            
    </section>
</section>
@endsection
