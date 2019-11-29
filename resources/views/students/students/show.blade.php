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
                    <ol class="breadcrumb float-sm-right">
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
                <div class="card-body"> 





<div class="row">
<div class="col-md-12 mb-4">
<div class="nav-tabs-boxed">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#home-1" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-book-open" style="color:blue"></i> Details</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-users" style="color:blue"></i>Parents</a></li>
<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#messages-1" role="tab" aria-controls="messages" aria-selected="true"><i class="fa fa-users" style="color:blue"></i>Relative</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane" id="home-1" role="tabpanel">

@include('students.students.tabs.details')

</div>

<div class="tab-pane" id="profile-1" role="tabpanel">

@include('students.students.tabs.parents')
</div>
<div class="tab-pane active" id="messages-1" role="tabpanel">

@include('students.students.tabs.relatives')
</div>
</div>
</div>
</div>
</div>


                </div>
            </div>
            <br /><br /><br /><br />
        </div>
    </section>
</section>
@endsection