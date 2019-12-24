@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                          Results for  <i class="fas fa-file fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                          <li class="breadcrumb-item">
                            <a href="{{ route('examination.individualreport.index') }}" class="blue">Result Posting</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue"> 
                      Student List </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
        <div class="card card-accent-primary">
        <div class="row">
            <div class="col-md-12 mb-4">
            <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home" aria-selected="true"  style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-book-open" style="color:green; font-size:18px;"></i> Semester One</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-users" style="color:green"></i> Semester Two</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#registration-1" role="tab" aria-controls="registration" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-users" style="color:green"></i> Full Year</a></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane active" id="home-1" role="tabpanel">
            @include('examinations.reports.tabs_data.semester_one')
            </div>

            <div class="tab-pane" id="profile-1" role="tabpanel">
            @include('examinations.reports.tabs_data.semester_two')
            </div>
            <div class="tab-pane" id="registration-1" role="tabpanel">
             @include('examinations.reports.tabs_data.full_year_result')
            </div>
            </div>
            </div>
            </div>  
</div>
</div>

@endsection
 
                           