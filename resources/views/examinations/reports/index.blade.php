@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                         Student Summary List  <i class="fas fa-file fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item active" class="blue"> 
                       Student Summary List
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
{!! Form::open(['route'=>'examination.individualreport.index','method'=>'GET']); !!}   
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
  <a  class="list_of_students" onClick="return studentsListDetails($class_id,$year_id)" href="#" >
     {{$studentdata['class_name']}}
  </a>
        @else
      {{$studentdata['class_name']}}   
        @endif
  </td>
 
  <td> @if($std_number > 0 ) 
  <a class="list_of_students" onClick="return studentsListDetails($class_id,$year_id)" href="#" >{{$std_number}}</a>
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
<div class="card-body card card-accent-primary">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="examinationresult">
<thead>
<tr>
         <th>Class</th>
         <th>Classsection</th>
         <th>Student</th>
         <th>Examination  nature</th>
         <th>Semester</th>
         <th>Year</th>
         <th>Subject</th>
        <th>Examination type</th>
         <th>Marks</th>
         <th>Remarks</th>
         <th>View</th>
         <th>Action</th>
</tr>
</thead>
<tfoot>
    
          <th>Class</th>
         <th>Classsection</th>
         <th>Student</th>
         <th>Examination  nature</th>
         <th>Semester</th>
         <th>Year</th>
         <th>Subject</th>
        <th>Examination type</th>
         <th>Marks</th>
         <th>Remarks</th>
         <th>View</th>
        <th>Action</th>
</tfoot>
</table>
</div>
</div>
</div>

@endsection


@section('scripts')
    <script>
        $(function () {
           
            var start = '';
            var end = '';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
      '<tr>'+
            '<td>Student :</td>'+
            '<td colspan="3">'+d.academicyear_student_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Class :</td>'+
            '<td colspan="3">'+d.class_id+'</td>'+
        '</tr>'+
        
        '<tr>'+
            '<td>Class section:</td>'+
            '<td colspan="3">'+d.classsection_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Examination Type:</td>'+
            '<td colspan="3">'+d.examinationtype_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Semester:</td>'+
            '<td colspan="3">'+d.semester_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Year:</td>'+
            '<td colspan="3">'+d.year_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Subject:</td>'+
            '<td colspan="3">'+d.subject_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Examination nature:</td>'+
            '<td colspan="3">'+d.examination_nature+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Marks:</td>'+
            '<td colspan="3">'+d.marks+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Remarks:</td>'+
            '<td colspan="3">'+d.remarks+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created By:</td>'+
            '<td colspan="3">'+d.created_by+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created At:</td>'+
            '<td colspan="3">'+d.created_at+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Updated By:</td>'+
            '<td colspan="3">'+d.updated_by+'</td>'+
        '</tr>'
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}          

 $('.list_of_students').on('click', function studentsListDetails(id,id2) {
              alert("here");
              alert(id2);
              var url = '/examination/list_student'+id+'/'+id2;
              var orign = '/examination/list_student'+id+'/'+id2;
              var table = $('#examinationresult').DataTable({
                serverSide: true,
                processing: true,
                "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                ajax: {
                    url: url,
                    data: function (d) {
                        d.status = $('select[name=status]').val()
                    },
                },
                   columns: [
                    {data: 'class_id', name: 'class_id'},
                    {data: 'classsection_id', name: 'classsection_id'},
                    {data: 'academicyear_student_id', name: 'academicyear_student_id'},
                    {data: 'examinationtype_id', name: 'examinationtype_id'},
                    {data: 'semester_id', name: 'semester_id'},
                    {data: 'year_id', name: 'year_id'},
                    {data: 'subject_id', name: 'subject_id'},
                    {data: 'examination_nature', name: 'examination_nature'},
                    {data: 'marks', name: 'marks'},
                    {data: 'remarks', name: 'remarks'},
                    {
                        className:      'details-control',
                        orderable:      false,
                        searchable: false,
                        data:           null,
                        defaultContent: "<button class='btn btn-success'> <i class='fa fa-eye'></i> View</button>"
                     },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ], dom: 'lBfrtip<"actions">',
                columnDefs: [],
                "iDisplayLength": 15,
                "aaSorting": [],
                buttons: [
                    {
                        extend: 'copy',
                        text: window.copyButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        text: window.csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: window.excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: window.pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: window.printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ]
            });
            
         } );

        $('#examinationresult tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

        });
    </script>
   
@stop
                           