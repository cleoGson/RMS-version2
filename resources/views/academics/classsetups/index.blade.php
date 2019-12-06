

@extends('layouts.admin')
@section('content')

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>List of classsetups 

  
  <a href="{{ route('academic.classsetup.create') }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Add New  <i class="fas fa-plus-circle fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body">
<div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="classsetup">
<thead>
<tr>
<th>Name</th>
<th>class</th> 
<th>classsection</th>
<th>Grade Curricular</th>
<th>Curricular</th>
<th>Minimum Capacity</th>
 <th>Maximum Capacity</th>
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
<th>classsection</th>
<th>Grade Curricular</th>
<th>Curricular</th>
<th>Minimum Capacity</th>
 <th>Maximum Capacity</th>
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
        '</tr>'+
        '<td>Class Section:</td>'+
            '<td colspan="3">'+d.classsections.name+'</td>'+
        '</tr>'+
         '<td>Grading System:</td>'+
            '<td colspan="3">'+d.gradings.name+'</td>'+
        '</tr>'+
        '<td>Curricular:</td>'+
            '<td colspan="3">'+d.curricular.name+'</td>'+
        '</tr>'+
         '<td> Year:</td>'+
            '<td colspan="3">'+d.years.name+'</td>'+
        '</tr>'+
         '<td>Minimum Capacity:</td>'+
            '<td colspan="3">'+d.minimum_capacity+'</td>'+
        '</tr>'+
        '<td>Maximum Capacity:</td>'+
            '<td colspan="3">'+d.maximum_capacity+'</td>'+
        '</tr>'+
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
        '</tr>'
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
                    {data: 'classsections.name', name: 'classsection_id'},
                    {data: 'grade_curricular', name: 'grade_curricular'},
                    {data: 'curricular_id', name: 'curricular_id'},                    {data: 'minimum_capacity', name: 'minimum_capacity'}, 
                    {data: 'maximum_capacity', name: 'maximum_capacity'},
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
                           