@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Edit student  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('student.student.index') }}" class="blue">student List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Edit student
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
                <?php 
                $id=encrypt($show->id);
                ?>
                    {!! Form::model($show,['method'=>'PATCH','route'=>['student.student.update', $id],'files'=>true]); !!}
                    @include('students.students.form')
                    <div class="row">
                        <div class="col-md-12 form-group text-right">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>

                                <a href="{{route('student.student.index')}}" class="btn btn-primary">
                            Back to List <i class="fas fa-fast-forward"></i>
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