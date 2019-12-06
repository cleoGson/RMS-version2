

@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>List of grademarks 

  
  <a href="{{ route('academic.grademark.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add New  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body">
<div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="grademark">
<thead>
<tr>
<th>Name</th>
<th>Display Name</th>
<th>Grade</th> 
<th>Minimum Marks</th>
<th>Maximum Marks</th>
<th>Grade Point</th>
<th>View</th>
<th>Actions </th>
</tr>
</thead>
<tfoot>
<tr>
<th>Name</th>
<th>Display Name</th>
<th>Grade</th> 
<th>Minimum Marks</th>
<th>Maximum Marks</th>
<th>Grade Point</th>
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
            var url = '/academic/grademark';
            var start = '';
            var end = '';
            var orign = '/academic/grademark';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" class="table table-responsive-sm table-bordered table-striped" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>grademark name:</td>'+
            '<td colspan="3">'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Display name:</td>'+
            '<td colspan="3">'+d.display_name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Grade:</td>'+
            '<td colspan="3">'+d.grades.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Minimum Marks:</td>'+
            '<td colspan="3">'+d.minimum_marks+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Maximum Marks:</td>'+
            '<td colspan="3">'+d.maximum_marks+'</td>'+
        '</tr>'+
         '<td>Maximum Marks:</td>'+
            '<td colspan="3">'+d.grade_point+'</td>'+
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
        '</tr>'
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}
            
            var table = $('#grademark').DataTable({
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
                    {data: 'display_name', name: 'display_name'},
                    {data: 'grades.name',name: 'grade_id'},
                    {data: 'minimum_marks',name: 'minimum_marks'},
                    {data: 'maximum_marks',name: 'maximum_marks'},
                     {data: 'grade_point',name: 'grade_point'},
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
        

        $('#grademark tbody').on('click', 'td.details-control', function () {
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
                           