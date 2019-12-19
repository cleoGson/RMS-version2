@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                         Examination Result  <i class="fas fa-plus-circle fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('examination.examinationresult.index') }}" class="blue">Examination Result List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                             Examination Result
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
<!-- {!! Form::open(['route'=>'examination.examinationresult.create','method'=>'GET']); !!}       -->
<div class="row">      
<div class="col-sm-1">
<div class="form-group">
<label for="class_id">Class </label>
    {!! Form::select('class_id',[''=>'All']+$classes,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-1">
<div class="form-group">
<label for="classsection_id">Section</label>
    {!! Form::select('classsection_id',[''=>'All']+$classsections,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-1">
<div class="form-group">
<label for="year_id">Year</label>
    {!! Form::select('year_id',[''=>'Select Year']+$years,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for=semester_id>Semester</label>
    {!! Form::select('semester_id',[''=>'Select Semester']+$semesters,null, ['id'=>'semester_id','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-1">
<div class="form-group">
<label for="classsetup_id">Class setup</label>
    {!! Form::select('classsetup_id',[''=>'Setup']+$classsetups,null, ['id'=>'classsetup_id','class'=>'form-control']) !!}
</div>
</div>
@if(!is_null($examinations))
<div class="col-sm-2">
<div class="form-group">
<label for="classsetup_id">Examination</label>
    {!! Form::select('examination_id',[''=>'Select Examination']+$examinations,null, ['id'=>'examination_id','class'=>'form-control']) !!}
</div>
</div>
@endif
@if(!is_null($examinations))
<div class="col-sm-1">
<div class="form-group">
<label for="classsetup_id">Subject Type</label>
    {!! Form::select('subject_id',[''=>'Select Subject']+$subjects,null, ['id'=>'subject_id','class'=>'form-control']) !!}
</div>
</div>
@endif
<div class="col-sm-1">
<div class="form-group">
<label for="classsetup_id"> </br></label>
{!! Form::submit("Filter",['class'=>'form-control btn btn-success']) !!}
</div>
</div>
</div>
<!-- {!! form::close() !!}  -->
  <fieldset class="border p-2">
 <legend  class="w-auto  btn btn-default" style="border-radius:3px; color:#306a99; font-weight:bold; font-size:18px; "> List of Student: </legend>
                 
        <div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="academicyearStudent">
<thead>
<tr>
<th>Student Name </th>
<th>Year</th>
<th>Class </th>
<th>Class Section </th>
<th>Class Setup</th>
<th>Status</th>
<th>View</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Student Name </th>
<th>Year</th>
<th>Class  </th>
<th>Class Section </th>
<th>Class Setup</th>
<th>Status</th>
<th>View</th>
</tr>
</tfoot>
</table>
</div>      
          
          </div>
             </div>
        <br /><br /><br /><br />
        </div>
            
    </section>
</section>
@endsection

@section('scripts')
    <script>
        $(function () {
            var url = '/examination/examinationresult/create';
            var start = '';
            var end = '';
            var orign = '/examination/examinationresult/create';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" class="table table-responsive-sm table-bordered table-striped" cellspacing="0" border="0" style="padding-left:50px;">'+
         '<tr>'+
            '<td>Student:</td>'+
            '<td colspan="3">'+d.student_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Year:</td>'+
            '<td colspan="3">'+d.year_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>student status:</td>'+
            '<td colspan="3">'+d.studentstatus_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Class:</td>'+
            '<td colspan="3">'+d.class_id+'</td>'+
        '</tr>'+
          '<tr>'+
            '<td>Class setup:</td>'+
            '<td colspan="3">'+d.classsetup_id+'</td>'+
        '</tr>'+
           '<tr>'+
            '<td>Class section:</td>'+
            '<td colspan="3">'+d.classsection_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created By:</td>'+
            '<td colspan="3">'+d.created_by+'</td>'+
        '</tr>'+
        '<tr>'+
         '<tr>'+
            '<td>Reporting date:</td>'+
            '<td colspan="3">'+d.reporting_date+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created At:</td>'+
            '<td colspan="3">'+d.created_at+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Updated By:</td>'+
            '<td colspan="3">'+d.updated_by+'</td>'+
        '</tr><tr>'
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}
          
            var table = $('#academicyearStudent').DataTable({
                serverSide: true,
                processing: true,
                "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                ajax: {
                    url: url,
                    data: function (d) {
                        d.class_id = $('select[name=class_id]').val()
                        d.classsetup_id = $('input[name=classsetup_id]').val()
                        d.year_id = $('select[name=year_id]').val()
                    },
                },


                columns: [
                    {data: 'student_id', name: 'student_id'},
                    {data: 'year_id', name: 'year_id'},
                    {data: 'class.name', name: 'class_id'},
                    {data: 'classsection_id', name: 'classsection_id' },
                    {data: 'classsetup_id', name: 'classsetup_id'},
                    {data: 'classsetup_id', name: 'studentstatus_id'},
                    {
                        className:      'details-control',
                        orderable:      false,
                        searchable: false,
                        data:           null,
                        defaultContent: "<button class='btn btn-success'> <i class='fa fa-eye'></i> View</button>"
                     },
                    //{data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                 dom: 'lBfrtip<"actions">',
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
        

        $('#academicyearStudent tbody').on('click', 'td.details-control', function () {
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
    <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="classsetup_id"]').on('change',function(){
               var classId = jQuery(this).val();
               alert(classId);
               if(classId)
               {
                  jQuery.ajax({
                     url : 'examination/subjlist/' +classId,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        
                        jQuery('select[name="examination_type"]').empty();
                        jQuery.each(data, function(key,value){
                            alert(data);
                           $('select[name="examination_type"]').append('<option value="'+ key +'">'+ value +'</option>');
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

                                 