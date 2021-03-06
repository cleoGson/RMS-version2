@extends('layouts.admin')
@section('content')
@can('users_manage')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
          <div class="card-header" style="color:white; font-size:14px; font-weight:bold; background-color:#506f99">

       User Lists <i class="fa fa-users" aria-hidden="true"></i>
    </div>

    <div class="card-body card card-accent-primary">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User" id="userAccount" width="100%">
                <thead>
                    <tr>
                      <th>Online</th>
                        <th>
                           Email
                        </th>
                        <th>
                            User name
                        </th>
                        <th>
                        Account for
                        </th>
                        <th>
                            Account Status
                        </th>
                        <th width="10">
                            Role(s)
                        </th>
                        <th> 
                        Specific Permission
                        </th>
                        <th>
                           pessword Changed at
                        </th>
                         <th>
                           View
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                  <tfoot>
                    <tr>
                      <th>
                        Online
                      </th>
                        <th>
                           Email
                        </th>
                        <th>
                            User name
                        </th>
                        <th>
                        Account For
                        </th>
                        <th>
                            Account Status
                        </th>
                        <th width="10">
                            Role(s)
                        </th>
                        <th> 
                        Specific Permission
                        </th>
                        <th>
                           pessword Changed at
                        </th>
                         <th>
                           View
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
 <script>
        $(function () {
            var url = '/admin/users';
            var start = '';
            var end = '';
            var orign = '/admin/users';
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" class="table table-responsive-sm table-bordered table-striped" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Email:</td>'+
            '<td colspan="3">'+d.email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Username:</td>'+
            '<td colspan="3">'+d.username+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Account for:</td>'+
            '<td colspan="3">'+d.account_for+'</td>'+
        '</tr>'+
          '<tr>'+
            '<td>User Roles:</td>'+
            '<td colspan="3">'+d.user_roles+'</td>'+
        '</tr>'+
          '<tr>'+
            '<td>User Permission:</td>'+
            '<td colspan="3">'+d.user_permission+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>verified:</td>'+
            '<td colspan="3">'+d.verifiedstatus+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>Account Status:</td>'+
            '<td colspan="3">'+d.status+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created At:</td>'+
            '<td colspan="3">'+d.status+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Updated By:</td>'+
            '<td colspan="3">'+d.email+'</td>'+
        '</tr><tr>'
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}
            
            var table = $('#userAccount').DataTable({
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
                    {data : 'is_online', name: 'is_online'},
                    {data: 'email', name: 'email'},
                    {data: 'username', name: 'username'},
                    {data: 'account_for', name: 'account_for'},
                    {data: 'status', name: 'status'},
                    {data: 'user_roles', name: 'user_roles'},
                    {data: 'user_permission', name: 'user_permission'},
                    {data: 'password_changed_at', name: 'password_changed_at'},
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
        

        $('#userAccount tbody').on('click', 'td.details-control', function () {
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


@endsection