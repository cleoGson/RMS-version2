 <?php 
 $gpa_applicable=$setup_data->gpa_applicable; 
 ?>
 @foreach($all_results as $semester_result)
<div class="row">
<div class="col-md-10">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend class="w-auto">Student Details</legend>
<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr style="font-weight:bold; background-color:#ABC;"><th>Student Name:</th><td>{{$studentDetails->student->full_name}}</td></tr>
<tr style="font-weight:bold; background-color:#ABC;"><th>Student Number:</th><td>{{$studentDetails->student->student_number}}</td></tr>
<tr style="font-weight:bold; background-color:#ABC;"><th>Results for: </th><td>{{$semester_result['semester_name']}}</td> </tr>
<tr style="font-weight:bold; background-color:#ABC;"><th>Class:</th><td>{{$studentDetails->class->name}}</td></tr>
<tr style="font-weight:bold; background-color:#ABC;"><th>Result System:</th><td>{{$setup_data->result_system == 2 ? 'Percentage' : 'Non Percentage'}}</td></tr>
<tr style="font-weight:bold; background-color:#ABC;"><th>GPA:</th><td>{{$setup_data->gpa_applicable == 1 ? 'Applicable' : 'Not Applicable'}}</td></tr>
<tr style="font-weight:bold; background-color:#ABC;"><th>Department:</th><td>{{$studentDetails->department->name}}</td></tr>
<tr style="font-weight:bold; background-color:#ABC;"><th>Year:</th><td>{{$studentDetails->years->name}}</td></tr>
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
<tr style="font-weight:bold; background-color:#ABC;"><th>#:</th>
<th>Code</th>
<th>Subject:</th>
@if($gpa_applicable)
<th> Units </th>
@endif
@foreach($semester_result['examination_list'] as $keynames=>$valuenames)
<th>{{$valuenames}}</th>
@endforeach
<th>Total Marks</th>
@if($setup_data->result_system == 2)
<th>Average</th>
@endif
<th>Grade</th>
@if($gpa_applicable)
<th>Point</th>
<th>GPA</th>
@endif
<th>Remarks</th>
</tr>
@php($count=1)
@foreach($semester_result['examinations'] as $result_details)
<tr style="font-weight:bold; background-color:#ABC;" ><th>{{$count}}</th>
<th >{{$result_details['subject_code']}}</th>
<th >{{$result_details['subject_name']}}</th>
@if($gpa_applicable)
<th >{{$result_details['subject_units']}}</th>
@endif
@foreach($result_details['exam_marks'] as $results_list_data)
<th > {{$results_list_data['marks']}}</th>
@endforeach
<th >{{$result_details['total_marks']}}</<th>
@if($setup_data->result_system == 2)
<th >{{$result_details['average_marks']}}</th>
@endif
<th >{{$result_details['grade']}}</th>

@if($gpa_applicable)
<th >{{$result_details['total_units']}}</th>
<th >   </th>
@endif
<th >{{$result_details['remarks']}}</th>
</tr>
@php($count++)
@endforeach
<?php 
$number_of_subject =  $semester_result['subject_number']; 
$number_of_examination =$semester_result['examination_number'];
if($setup_data->result_system == 2){
$additional_column=1;
}else{
$additional_column=1;
}
if($gpa_applicable){
   $gpa_rows=0;
}
else{
   $gpa_rows=-1;
}
$total_column=3+$number_of_examination+$additional_column+  $gpa_rows;

$units_per_semester=array_sum(array_column($semester_result['examinations'],'subject_units'));
$total_point_per_semister = array_sum(array_column($semester_result['examinations'],'total_units'));
if($setup_data->result_system == 1){
$total_marks_per_semister = array_sum(array_column($semester_result['examinations'],'total_marks'));
}else{
$total_marks_per_semister = array_sum(array_column($semester_result['examinations'],'average_marks')); 
}

$average_marks=$total_marks_per_semister/$number_of_subject;
$gpa_calculated=$total_point_per_semister/$units_per_semester;

 foreach($gpa_grading as $gpa_data){
 if(($gpa_calculated >= $gpa_data['from']) && ($gpa_calculated <= $gpa_data['to'] ) ){
                      $gpa_required= $gpa_data['name'];
                      break;
                    } 

 }

   foreach($grading_curricular as $gradingpackage){
                    if(($average_marks >= $gradingpackage['min_marks']) && ($average_marks <= $gradingpackage['max_marks'] ) ){
                      $grade_required= $gradingpackage['grade'];
                      $grade_remarks=$gradingpackage['remarks'];
                      break;
                    }
            }
      

?>

<tr style="font-weight:bold; background-color:#ABC;"> <td colspan="<?=$total_column?>" style="text-align:right; font-weight:bold">Sub- Total </td>
@if($setup_data->result_system == 2)
<td>{{array_sum(array_column($semester_result['examinations'],'total_marks'))}}</td>
@endif
<td>{{$total_marks_per_semister}}</td>
<td>{{$grade_required}} </td> 
@if($gpa_applicable)
<td>{{$total_point_per_semister}}</td>
<td>{{$gpa_calculated}}</td>
<td> {{$gpa_required}}</td>
@else
<td> {{$grade_remarks}}</td>
@endif
<tr>
</table>
</fieldset>
</div>

</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend class="w-auto">Grade Point Chart</legend>

<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr style="font-weight:bold; background-color:#ABC;"><th>Letter grade:</th><th>Marks Interval</th><th>Grade Point</th><th>Remarks</th></tr>
@foreach($grading_curricular as $grading_chart)
 <tr style="font-weight:bold; background-color:#ABC;"><th>{{$grading_chart['grade']}}</th><th>{{$grading_chart['max_marks']}} - {{$grading_chart['min_marks']}}</th><th>{{$grading_chart['grade_point']}}</th><th>{{$grading_chart['remarks']}}</th></tr>
@endforeach
</table>
</fieldset>
</div>
</div>
<div class="col-md-6">
<div class="table table-responsive">
<fieldset class="border p-2">
   <legend class="w-auto">GPA Classes</legend>

<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr style="font-weight:bold; background-color:#ABC;"><th>Class</th> <th>GPA from</th> <th> GPA To </th></tr>
 @foreach($gpa_grading  as  $gpa_details)
 <tr style="font-weight:bold; background-color:#ABC;"> <td> {{$gpa_details['name']}} </td> <td>{{$gpa_details['from']}} </td> <td>{{$gpa_details['to']}}</td> </tr>
 @endforeach
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