@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
      <div class="card-header" style="color:white; font-size:14px; font-weight:bold; background-color:#506f99">

<i class="fa fa-align-justify"></i>List of User Logs 
  </div>
<div class="card-body card card-accent-primary">
                        <table id="logsdata" class="table table-striped table-bordered" width="100%">
                            <thead>
                            <tr>
                            <th>Full Name </th>
                            <th>Last Login</th>
                            <th>ast Logout</th>
                            <th>IP Address</th>
                            <th>Browser</th>
                            <th>Platform Family </th>
                            <th>Device Model</th>
                            <th>Browser Engine</th>
                            <th>Device Family</th>
                            <th>Browser Name</th>
                            <th>Browser Family</th>
                            <th>Platform Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                            </thead>
                        </table>
                        </div>

</div>
</div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var url = 'logsdata';
            var orign = 'logsdata';
            var table = $('#logsdata').DataTable({
                serverSide: true,
                processing: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ajax: {
                    url: url,
                    data: function (d) {
                        d.status = $('select[name=status]').val()
                    },
                },
                columns: [
                    {data: 'users.name', name: 'users.name'},
                    {data: 'last_login', name: 'last_login'},
                    {data: 'last_logout', name: 'last_logout'},
                    {data: 'ip_address', name: 'ip_address'},
                    {data: 'browser', name: 'browser'},
                    {data: 'platform_family', name: 'platform_family'},
                    {data: 'device_model', name: 'device_model'},
                    {data: 'browser_engine', name: 'browser_engine'},
                    {data: 'device_family', name: 'device_family'},
                    {data: 'browser_name', name: 'browser_name'},
                    {data: 'browser_family', name: 'browser_family'},
                    {data: 'platform_name', name: 'platform_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ], dom: 'lBfrtip<"actions">',
                columnDefs: [],
                "iDisplayLength": 25,
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
        });
    </script>
 @stop
         