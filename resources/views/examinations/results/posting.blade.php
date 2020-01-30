@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">    
                        Posting Result for  {{$class->name}} Student class of {{$years->name}}  <i class="fas fa-file fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('examination.examinationresult.result') }}" class="blue">Result Posting</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                             Posting  Examination Result
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
            $classId = $class->id;
            $setupId = $classsetup->id;
            $yearId =  $years->id;
            ?>
            <div class="col-md-12 mb-4">
            <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home" aria-selected="true"  style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-file" style="color:green; font-size:18px;"></i> Individual Result Uploading </a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-upload" style="color:green"></i> Upload Result Using Excel</a></li>
             </ul>
            <div class="tab-content">
            <div class="tab-pane active" id="home-1" role="tabpanel">
            {!! Form::open(['route'=>'examination.examinationresult.store','files'=>true]); !!}      
             @include('examinations.results.uploading.individual')
             <div class="row">
             <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">
                            Save Result
                        </button>

                    </div>
            </div>
            </div>
             {!! Form::close() !!}
            </div>

            <div class="tab-pane" id="profile-1" role="tabpanel">
            <div class="row"> 
           <div class="col-md-8">
           @if(!is_null($errors))
           <p class="help-block">  
           <i class="fa fa-warning" style="color:red; font-size:24;">
           </i>
            Please fix the excel  lines as The error  lines indicates then reupload the csv file .
           </p>
           @php($count=1)
             @foreach ($errors->all() as $message) 
            <span class="help-block" style="color:red">
            CSV Line number {{$count}} {{explode('.',$message)[1]}} </br>
             </span>
             @php($count++)
            @endforeach
            @endif
            </br>
            {!! Form::open(['route'=>'examination.examinationresult.import','files'=>true]); !!}  
            {!! Form::hidden('classsetup_id',$setupId) !!} 
            @include('examinations.results.uploading.group')
             <div class="row">
             <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">
                            Upload Result
                        </button>
                    </div>
            </div>
            </div>
             {!! Form::close() !!}
            </div>
            <div class="col-md-4">
            <h4 style="font-size:24; color:black; font-weight:bold"><i class="fa fa-warning red"></i>
            Click download below Button to download the Excel 
            File with Students name and Number, Please do not edit any other 
             column Except for the marks and Remarks, column which are to be filled 
             <h3>Click Download <a href="{{url('examination/export_student',['class_id'=>$classId,'year_id'=>$yearId])}}" class="button ">Download Template  <i class="fa fa-download"></i>  </a> </h3>
            </h4>
            
            </div>
            </div>
            </div>      
            </div>
            </div>
            </div>
            </div>
            </div>

<div class="row"> 
<div class="col-md-12">
<div class="table-responsive">
<fieldset class="border p-2">
   <legend  class="w-auto" style="color:#306a99; font-size:24px; font-weight:bold;">Results for  {{$class->name}} Student class of {{$years->name}}</legend>
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
</fieldset>
</div>
</div>
</div>
</div>
</div>


@endsection

@section('scripts')
    <script>
        $(function () {
            var id1 = <?php echo $classId ?>;
            var id2 = <?php echo $setupId ?>;
            var id3 = <?php echo $yearId ?>;
         
            var url = '/examination/classdetails/'+id1+'/'+id2+'/'+id3;
            var start = '';
            var end = '';
            var orign = '/examination/classdetails/'+id1+'/'+id2+'/'+id3;
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

         $('select[name="semester_id"]').on('change',function(){
               var semesterId = $(this).val();
               if(semesterId)
               {
                  $.ajax({
                     url : '/examination/dependantdata/' +semesterId+'/'+id2,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     { 
                        $('select[name="examination_type"]').empty();
                          $('select[name="examination_type"]').append('<option value="">Select Examination Type</option>');
                        $.each(data['examination'], function(key,value){
                           $('select[name="examination_type"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                        $('select[name="subject"]').empty();
                         $('select[name="subject"]').append('<option value="">Select Subject</option>');
                        $.each(data['subjects'], function(key1,value1){
                           $('select[name="subject"]').append('<option value="'+ key1 +'">'+ value1 +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="state"]').empty();
               }
            });


        });
    </script>
  
       

@stop
                           