

@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>List of Countries 

  
  <a href="{{ route('setting.country.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add New  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body">
<div class="table table-responsive">
<table width="100%" class="table table-responsive-sm table-bordered table-striped table-hover" id="country">
<thead>
<tr>
<th>Name</th>
<th>Display Name</th>
<th>code</th>
<th>Monetary</th>
<th>monetary Short Name</th>
<th>monetary Symbol</th>
<th>View</th>
<th>Actions </th>
</tr>
</thead>
<tfoot>
<tr>
<th>Name</th>
<th>Display Name</th>
<th>code</th>
<th>Monetary</th>
<th>monetary Short Name</th>
<th>monetary Symbol</th>
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
            var url = '/setting/country';
            var start = '';
            var end = '';
            var orign = '/setting/country';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Country name:</td>'+
            '<td colspan="3">'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>code:</td>'+
            '<td colspan="3">'+d.code+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>monetary:</td>'+
            '<td colspan="3">'+d.monetary+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>monetary_short_name:</td>'+
            '<td colspan="3">'+d.monetary_short_name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>monetary_sign:</td>'+
            '<td colspan="3">'+d.monetary_sign+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Display name:</td>'+
            '<td colspan="3">'+d.display_name+'</td>'+
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
            
            var table = $('#country').DataTable({
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
                    {data: 'code', name: 'code'},
                    {data: 'monetary', name: 'monetary'},
                    {data: 'monetary_short_name', name: 'monetary_short_name'},
                    {data: 'monetary_sign', name: 'monetary_sign'},
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
        

        $('#country tbody').on('click', 'td.details-control', function () {
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
                           