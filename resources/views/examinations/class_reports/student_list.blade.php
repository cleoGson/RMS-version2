@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Class Results for {{$classdetails->name}}  {{$yeardetails->name}} <i class="fas fa-file fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

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
            <div class="card card-default">
@foreach($data_all_data  as $student_result)

<fieldset class="border p-2">
   <legend class="w-auto">Examination Result:{{$student_result['semester_name']}}</legend>
<div class="card-body card card-accent-primary">
<div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" >
<thead>
<tr>
         <th>Full Name</th>
         <th>Student Number</th>
 @foreach($student_result['subject_list'] as $keynames=>$valuenames)
<th>
<center>{{$valuenames}} </center>
<table>
<tr>
 @foreach($student_result['examination_list'] as $keyexamination=>$valueexamination)
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px" >{{$valueexamination}} </td>
@endforeach
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px" > Total </td>
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px" > Grade</td>
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px"> Point</td>
</tr>
</table>
</th>
@endforeach
<th>Total Marks</th>
<th>Average</th>
<th>Grade</th>
<th>Point</th>
<th>Remarks</th>
</tr>
</thead>
<tbody>
@foreach($student_result['result'] as $result)
<tr>
<td>{{ $result['full_name']}}</td>
<td>{{ $result['student_number']}}</td>
 @foreach($result['examinations'] as $examination_results)
<td>
<table>
<tr>
 @foreach($examination_results['exam_marks'] as $examination_marks)
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px">{{$examination_marks['marks']}}</td>
@endforeach
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px"> {{$examination_results['total_marks']}} </td>
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px"> {{$examination_results['grade']}} </td>
<td style="white-space: nowrap; 
                    overflow: nowrap; width:70px; height:30px"> {{$examination_results['point']}} </td>
</tr>
</table>
</th>
@endforeach
<?php 
$general_total_marks=array_sum(array_column($result['examinations'], 'total_marks'));
$total_number_of_subject =$result['subject_number'];
$general_average=$general_total_marks/$total_number_of_subject;
     foreach($grading_curricular as $gradingpackage){
                    if(($general_average >= $gradingpackage['min_marks']) && ($general_average <= $gradingpackage['max_marks'] ) ){
                      $grade_required= $gradingpackage['grade'];
                      $grade_point = $gradingpackage['grade_point'];
                      $grade_remark= $gradingpackage['remarks'];
                      break;
                    }
            }
?>
<td>{{$general_total_marks}}</td>
<td>{{$general_average}}</td>
<td>{{$grade_required}}</td>
<td>{{$grade_point}}</td>
<td>{{$grade_remark}}</td>


</tr>

@endforeach
</tbody>
<tfoot>
<th>Full Name</th>
<th>Student Number</th>
@foreach($student_result['subject_list'] as $keynames=>$valuenames)
<th>{{$valuenames}}</th>
@endforeach
<th>Total Marks</th>
<th>Average</th>
<th>Grade</th>
<th>Point</th>
<th>Remarks</th>
</tfoot>
</table>
 </div>
</div>
@endforeach
</fieldset>

</div>

@endsection
      