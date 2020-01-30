

@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
      <div class="card-header" style="color:white; font-size:14px; font-weight:bold; background-color:#506f99">

<i class="fa fa-align-justify"></i>List of classsetups 

  
  <a href="{{ route('academic.classsetup.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add New  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body card card-accent-primary">
<div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="classsetup">
<thead>
<tr>
<th>Name</th>
<th>class</th> 
<th>Subject Curricular</th>
<th>Examinaation Curricular</th>
<th>Grading</th>
<th>Result System</th>
 <th>GPA Classes</th>
<th>Year</th> 
<th>Status</th>
<th>View</th>
<th>Actions </th>
</tr>
</thead>
<tfoot>
<tr>
<th>Name</th>
<th>class</th> 
<th>Subject Curricular</th>
<th>Examinaation Curricular</th>
<th>Grading</th>
<th>Result System</th>
 <th>GPA Classes</th>
<th>Year</th> 
<th>Status</th>
<th>View</th>
<th>Actions </th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>

@endsection

@section('scripts')
    <script>
        $(function () {
            var url = '/academic/classsetup';
            var start = '';
            var end = '';
            var orign = '/academic/classsetup';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" class="table table-responsive-sm table-bordered table-striped" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>  name:</td>'+
            '<td colspan="3">'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Class:</td>'+
            '<td colspan="3">'+d.classes.name+'</td>'+
        '</tr><tr>'+
         '<td>Grading System:</td>'+
            '<td colspan="3">'+d.grade_curricular+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Subject Curricular:</td>'+
            '<td colspan="3">'+d.subject_curricular+'</td>'+
        '</tr><tr>'+
         '<tr>'+
        '<td>Examination Curricular:</td>'+
            '<td colspan="3">'+d.examination_curricular+'</td>'+
        '</tr><tr>'+
         '<td> Year:</td>'+
            '<td colspan="3">'+d.years.name+'</td>'+
        '</tr><tr>'+
         '<td>Result System:</td>'+
            '<td colspan="3">'+d.result_system+'</td>'+
        '</tr><tr>'+
        '<td>GPA Classes:</td>'+
            '<td colspan="3">'+d.gpa_curricular+'</td>'+
        '</tr><tr>'+
        '<td>Status:</td>'+
            '<td colspan="3">'+d.status+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created By:</td>'+
            '<td colspan="3">'+d.creator.email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created At:</td>'+
            '<td colspan="3">'+d.created_at+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Updated By:</td>'+
            '<td colspan="3">'+d.updator.email+'</td>'+
        '</tr><tr>'
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}
            
            var table = $('#classsetup').DataTable({
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
                    {data: 'name', name: 'name'},
                    {data: 'classes.name', name: 'class_id'},
                    {data: 'subject_curricular', name: 'subject_curricular' },
                    {data: 'examination_curricular', name: 'examination_curricular' },
                    {data: 'grade_curricular', name: 'grade_curricular'},          
                    {data: 'result_system', name: 'result_system'}, 
                    {data: 'gpa_curricular', name: 'gpa_curricular'},
                    {data: 'years.name', name: 'year_id'},
                    
                    
                        {data: 'status', name: 'status'},
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
        

        $('#classsetup tbody').on('click', 'td.details-control', function () {
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
                           