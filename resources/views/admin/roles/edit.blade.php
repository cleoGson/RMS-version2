@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Edit Roles  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roles.index') }}" class="blue">Roles List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Edit Roles
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
        <form action="{{ route('admin.roles.update', [$role->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.role.fields.title') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}" readonly required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                @if($errors->has('permission'))
                        
                        <em class="invalid-feedback">
                            {{ $errors->first('permission') }}
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

                        @php($inroledata=$role->permissions->pluck('id')->toArray())
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
                            Update
                        </button>

                        <a href="{{route('admin.roles.index')}}" class="btn btn-primary">
                            Back to List <i class="fas fa-list fa-fw"></i>
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
