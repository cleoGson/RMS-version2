@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Edit gradecurricular  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('academic.gradecurricular.index') }}" class="blue">gradecurricular List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Edit gradecurricular
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    {!! Form::model($show,['method'=>'PATCH','route'=>['academic.gradecurricular.update',$show->id],'files'=>true]); !!}
                    @include('academics.gradecurricular.form')
                    <div class="row">
                        <div class="col-md-12 form-group text-right">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                <a href="{{route('academic.gradecurricular.index')}}" class="btn btn-default">
                            Back to List <i class="fas fa-list fa-fw"></i>
                              </a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close()!!}
                </div>
            </div>
            <br /><br /><br /><br />
        </div>
    </section>
</section>
@endsection