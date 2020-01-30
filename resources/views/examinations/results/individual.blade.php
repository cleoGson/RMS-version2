@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                         Select Class to upload Result  <i class="fas fa-file fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item active" class="blue"> 
                      Select Class to upload Result
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
<div class="row">
  <?php 
                              if (isset($_GET['year_id'])) { 
                                      $year_id=$_GET['year_id'];   
                                }else{
                                    $year_id=null;
                                }
                                $year_selected =array($year_id);
                                ?>
<div class="col-sm-2">
{!! Form::open(['route'=>'examination.examinationresult.result','method'=>'GET']); !!}   
<div class="form-group">
<label for="year_id">Year</label>

{!! Form::select('year_id',$years, $year_selected, ['id'=>'year_id','class'=>'form-control select2-single']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="year_id"></br></label>
    <button class="form-control btn btn-success">Filter</buutton>
</div>
{!!  Form::close()!!}
</div>

</div>
<div class="table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" width="100%"> 
<tr>
<th> Class</th>
<th> Student </th>
<th> Year </th>
<th> Curricullum</th>
<?php 
$total=0;
?>
 

  @foreach($studentsprovider as $studentdata)
     <?php 
        $std_number= $studentdata['number_student'];
        $class_id=$studentdata['class_id'];
        $classsetup_id=$studentdata['classsetup_id'];
        $year_id =$studentdata['year_id'];
        $total+= $std_number;
  ?>
  <tr>
  <td> 
  @if($std_number > 0 ) 
  <a href="{{url('examination/classdetails',['class_id'=>$class_id,'classsetup_id'=>$classsetup_id,'year_id'=>$year_id])}}" >
     {{$studentdata['class_name']}}
  </a>
        @else
      {{$studentdata['class_name']}}   
        @endif
  </td>
 
  <td> @if($std_number > 0 ) 
  <a href="{{url('examination/classdetails',['class_id'=>$class_id,'classsetup_id'=>$classsetup_id,'year_id'=>$year_id])}}" >{{$std_number}}</a>
        @else
     {{$std_number}}   
        @endif
</td> 
<td> {{$studentdata['year']}}</td>
 <td>{{$studentdata['classsetup_name']}}</td>  
  </tr>
  @endforeach
  <tr>
<td> Total Number of Students </td>
<td colspan=3>{{$total}} </td>
</tr>

</table>
</div>
</div>
</div>

@endsection

@section('scripts')
    <script>
        $(function () {
         

        });
    </script>
   
@stop
                           