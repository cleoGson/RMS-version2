

@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>List of Registered Students 

  <a href="{{ route('student.academicyearStudent.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add New  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body">
<div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="academicyearStudent">
<thead>
<tr>

<th>Level</th>
<th>Department Name </th>
<th>Description </th>
<th>Duration</th>
<th>Duration Unit</th>
<th>View</th>
<th>Actions </th>
</tr>
</thead>
<tfoot>
<tr>
<th>Level</th>
<th>Department Name </th>
<th>Description </th>
<th>Duration</th>
<th>Duration Unit</th>
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
            var url = '/student/academicyearStudent';
            var start = '';
            var end = '';
            var orign = '/student/academicyearStudent';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
         '<tr>'+
            '<td>Department:</td>'+
            '<td colspan="3">'+d.department_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Level:</td>'+
            '<td colspan="3">'+d.level_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Description:</td>'+
            '<td colspan="3">'+d.description+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Duration:</td>'+
            '<td colspan="3">'+d.duration+'</td>'+
        '</tr>'+
          '<tr>'+
            '<td>Duration Unit:</td>'+
            '<td colspan="3">'+d.duration_unit+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created By:</td>'+
            '<td colspan="3">'+d.created_by+'</td>'+
        '</tr>'+
        '<tr>'+
         '<tr>'+
            '<td>Duration Unit:</td>'+
            '<td colspan="3">'+d.duration_unit+'</td>'+
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
                    {data: 'level_id', name: 'level_id'},
                    {data: 'department_id', name: 'department_id'},
                    {data: 'description', name: 'description'},
                    {data: 'duration', name: 'duration'},
                     {data: 'duration_unit', name: 'duration_unit'},
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
   
@stop
                           