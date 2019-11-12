

@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>List of Almanacs 

  
  <a href="{{ route('academic.almanac.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add New  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body">
<div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="almanac">
<thead>
<tr>
<th>event</th>
<th>Description</th>
<th>start date</th>
<th>end date</th>
<th>center</th>
<th>year</th>
<th>View</th>
<th>Actions </th>
</tr>
</thead>
<tfoot>
<tr>
<th>event</th>
<th>Description</th>
<th>start date</th>
<th>end date</th>
<th>center</th>
<th>year</th>
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
            var url = '/academic/almanac';
            var start = '';
            var end = '';
            var orign = '/academic/almanac';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Event:</td>'+
            '<td colspan="3">'+d.events.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Display name:</td>'+
            '<td colspan="3">'+d.description+'</td>'+
        '</tr>'+
        '<td>Display name:</td>'+
            '<td colspan="3">'+d.start_date+'</td>'+
        '</tr>'+
        '<td>Display name:</td>'+
            '<td colspan="3">'+d.end_date+'</td>'+
        '</tr>'+
        '<td>Display name:</td>'+
            '<td colspan="3">'+d.centers.name+'</td>'+
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
            
            var table = $('#almanac').DataTable({
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
                   
                    {data: 'events.name', name: 'event_id'},
                    {data: 'description', name: 'description'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'centers.name', name: 'center_id'},
                    {data: 'years.name', name: 'year_id'},
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
        

        $('#almanac tbody').on('click', 'td.details-control', function () {
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
                           