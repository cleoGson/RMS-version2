 @foreach($all_results as $semester_result)
<div class="row">
<div class="col-md-6">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend class="w-auto">Student Details</legend>
<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr><th>Student Name:</th><td>{{$studentDetails->student->full_name}}</td></tr>
<tr><th>Student Number:</th><td>{{$studentDetails->student->student_number}}</td></tr>
<tr><th>Results for: </th><td>{{$semester_result['semester_name']}}</td> </tr>
<tr><th>Class:</th><td>{{$studentDetails->class->name}}</td></tr>
<!-- <tr><th>Class Section:</th><td>{{$studentDetails->classSection->name}}</td></tr> -->
<tr><th>Department:</th><td>{{$studentDetails->department->name}}</td></tr>
<tr><th>Year:</th><td>{{$studentDetails->years->name}}</td></tr>
</table>
</fieldset>
</div>
</div>

<div class="col-md-4">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend class="w-auto">Grade Point Chart</legend>

<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr><th>Letter grade:</th><th>Marks Interval</th><th>Grade Point</th><th>Remarks</th></tr>
@foreach($grading_curricular as $grading_chart)
 <tr><th>{{$grading_chart['grade']}}</th><th>{{$grading_chart['max_marks']}} - {{$grading_chart['min_marks']}}</th><th>{{$grading_chart['grade_point']}}</th><th>{{$grading_chart['remarks']}}</th></tr>
@endforeach
</table>
</fieldset>
</div>
</div>

<div class="col-md-2">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend  class="w-auto">Photo</legend>
<div class="text-center">
                      <div class="client-avatar">
                      <img  width="200" height="200" src="https://d19m59y37dris4.cloudfront.net/admin/1-4-5/img/avatar-2.jpg" 
                     class='img-fluid rounded-circle'  >
                         <div class="status bg-green"></div>
                      </div>
                      <div class="client-title">
                        <h4 class="btn  btn-primary" style="height=20">Continue</h4>
                      </div>
                    </div>
   </fieldset>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
 <div class="table table-responsive">

<fieldset class="border p-2">
   <legend class="w-auto">Examination Result:{{$semester_result['semester_name']}}</legend>
<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%">
<tr><th>#:</th><th>Subject:</th>
@foreach($semester_result['examination_list'] as $keynames=>$valuenames)
<th>{{$valuenames}}</th>
@endforeach
<th>Total Marks</th>
<th>Grade</th>
<th>Point</th>
<th>Remarks</th>
</tr>
@php($count=1)
@foreach($semester_result['examinations'] as $result_details)
<tr><th>{{$count}}</th><th>{{$result_details['subject_name']}}</th>
@foreach($result_details['exam_marks'] as $results_list_data)
<th> {{$results_list_data['marks']}}</th>
@endforeach
<th>{{$result_details['total_marks']}}</<th><th>{{$result_details['grade']}}</th><th>{{$result_details['point']}}</th><th>{{$result_details['remarks']}}</th></tr>
@php($count++)
@endforeach
</table>
</fieldset>
</div>

</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend class="w-auto">Total Marks & GPA</legend>
<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr><th>Total marks:</th><td>  <?php 
$total_marks_per_semister = array_sum(array_column($semester_result['examinations'],'total_marks'));
$total_point_per_semister = array_sum(array_column($semester_result['examinations'],'point'));
$number_of_subject =  $semester_result['subject_number']; 
$average_marks=$total_marks_per_semister/$number_of_subject;
?>
{{$total_marks_per_semister}} 
</td></tr>
<tr><th>Average Marks:</th><td>{{$average_marks}}</td></tr>
<tr><th>GPA:</th><td>{{$total_point_per_semister/$number_of_subject}}</td></tr>
<tr><th>Letter Grade:</th><td>
<?php
   foreach($grading_curricular as $gradingpackage){
                    if(($average_marks >= $gradingpackage['min_marks']) && ($average_marks <= $gradingpackage['max_marks'] ) ){
                      $grade_required= $gradingpackage['grade'];
                      break;
                    }
            }
            ?>
            {{$grade_required}}
</td></tr>
</table>
</fieldset>
</div>
</div>

<div class="col-md-6">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend class="w-auto">Position in Merit List</legend>

<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr><th>Class</th> <th>Position</th></tr>
 <tr><th>Class</th><th>5.0 out Of 50</th></tr>
<tr><th>Performance Remarks</th><th>Average </th></tr>
</table>
</fieldset>
</div>
</div>
</div>
 <div class="row">
<div class="col-md-12 form-group text-right">
<div class="pull-right">
    <button type="submit" class="btn btn-success"><i class="fa fa-file"></i>
        Print Result
    </button>
</div>
</div>
</div>
@endforeach