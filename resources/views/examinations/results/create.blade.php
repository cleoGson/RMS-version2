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
          <div class="card-body">

<div class="row">
<div class="col-sm-2">
<div class="form-group">
<label for="cvv">Class setup</label>
    {!! Form::select('project_type',[''=>'All']+$classsections,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="cvv">Class setup</label>
    {!! Form::select('project_type',[''=>'All']+$classsections,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="cvv">Class setup</label>
    {!! Form::select('project_type',[''=>'All']+$classsections,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="cvv">Class setup</label>
    {!! Form::select('project_type',[''=>'All']+$classsections,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="cvv">Class setup</label>
    {!! Form::select('project_type',[''=>'All']+$classsections,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="cvv">Class setup</label>
    {!! Form::select('project_type',[''=>'All']+$classsections,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
</div>
  <fieldset class="border p-2">
 <legend  class="w-auto  btn btn-default" style="border-radius:3px; color:#306a99; font-weight:bold; font-size:18px; "> List of Student: </legend>
                 
        {!! Form::open(['route'=>'examination.examinationresult.store','files'=>true]); !!}
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
          
            {!! Form::close()!!}
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
            var url = '/student/academicyearStudent';
            var start = '';
            var end = '';
            var orign = '/student/academicyearStudent';
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
                        d.status = $('select[name=status]').val()
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
            jQuery('select[name="class_id"]').on('change',function(){
               var classId = jQuery(this).val();
               if(classId)
               {
                  jQuery.ajax({
                     url : 'examination/getexamination/' +classId,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="examination_type"]').empty();
                        jQuery.each(data, function(key,value){
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

                                 