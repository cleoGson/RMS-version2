

@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>List of Examination Result 

  
  <a href="{{ route('examination.examinationresult.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add Result  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body">
<div class="row">
<div class="col-sm-2">
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
    {!! Form::select('semester_id',[''=>'Select Semester']+$semesters,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="classsetup_id">Class setup</label>
    {!! Form::select('classsetup_id',[''=>'Setup']+$classsetups,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="classsetup_id">Class setup</label>
    {!! Form::select('classsetup_id',[''=>'Setup']+$classsetups,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label for="classsetup_id">Class setup</label>
    {!! Form::select('classsetup_id',[''=>'Setup']+$classsetups,null, ['id'=>'project-type','class'=>'form-control']) !!}
</div>
</div>
</div>
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="examinationresult">
<thead>
<tr>
         <th> </th>
         <th>Class</th>
         <th>Classsection</th>
         <th>Examination  nature</th>
         <th>Student</th>
         <th>Academicyear student</th>
         <th>Examination type</th>
         <th>Semester</th>
         <th>Year</th>
         <th>Subject</th>
         <th>Marks</th>
         <th>Remarks</th>
         <th>View</th>
         <th>Action</th>
</tr>
</thead>
<tfoot>
          <th> </th>
          <th>Class</th>
         <th>Classsection</th>
         <th>Examination  nature</th>
         <th>Student</th>
         <th>Academicyear student</th>
         <th>Examination type</th>
         <th>Semester</th>
         <th>Year</th>
         <th>Subject</th>
         <th>Marks</th>
         <th>Remarks</th>
         <th>View</th>
        <th>Action</th>
</tfoot>
</table>
</div>
</div>

@endsection

@section('scripts')
    <script>
        $(function () {
            var url = '/examination/examinationresult';
            var start = '';
            var end = '';
            var orign = '/examination/examinationresult';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
      '<tr>'+
            '<td>Student :</td>'+
            '<td colspan="3">'+d.student_id+'</td>'+
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
                    {data: 'academicyear_student_id', name: 'academicyear_student_id'},
                    {data: 'class_id', name: 'class_id'},
                    {data: 'classsection_id', name: 'classsection_id'},
                    {data: 'student_id', name: 'student_id'},
                    {data: 'classsection_id', name: 'classsection_id'},
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

        });
    </script>
   
@stop
                           