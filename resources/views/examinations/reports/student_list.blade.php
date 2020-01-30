@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                         Individual Results for {{$classdetails->name}}  {{$yeardetails->name}} <i class="fas fa-file fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                          <li class="breadcrumb-item">
                            <a href="{{ route('examination.individualreport.index') }}" class="blue">Result Posting</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue"> 
                      Student List </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
          <div class="card-body card card-accent-primary">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="list_student">
<thead>
<tr>
         <th>Full Name</th>
         <th>Year</th>
         <th>Class</th>
         <th>Student Number</th>
         <th>View</th>
         <th>Action</th>
</tr>
</thead>
<tfoot>
    
          <th>Full Name</th>
          <th>Student Number</th>
         <th>Year</th>
         <th>Class</th>
         <th>View</th>
        <th>Action</th>
</tfoot>
</table>
<?php 
$classid=$classdetails->id;
$yearid=$yeardetails->id;
?>




</div>
</div>

@endsection

@section('scripts')
    <script>
        $(function () {
            var id1 = <?php echo  $yearid; ?>;
            var id2 = <?php echo $classid; ?>;
            var url = '/examination/list_student/'+id2+'/'+id1;
            var start = '';
            var end = '';
            var orign = '/examination/list_student/'+id2+'/'+id1;
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
     
        '<tr>'+
            '<td>Student Name :</td>'+
            '<td colspan="3">'+d.student_id+'</td>'+
        '</tr>'+
          '<tr>'+
            '<td>Year :</td>'+
            '<td colspan="3">'+d.year_id+'</td>'+
        '</tr>'+ 
         '<tr>'+
            '<td>Class :</td>'+
            '<td colspan="3">'+d.class_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Student Number :</td>'+
            '<td colspan="3">'+d.student_number+'</td>'+
        '</tr>'+
    '</table>';
}      


            var table = $('#list_student').DataTable({
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
                    {data: 'student_number', name: 'student_number'},
                    {data: 'year_id', name: 'year_id'},
                    {data: 'class_id', name: 'class_id'},
                    {
                      className:      'details-control',
                        orderable:      false,
                        searchable: false,
                        data:           null,
                        defaultContent: "<button class='btn btn-primary'> <i class='fa fa-eye'></i> View</button>"
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
        

        $('#list_student tbody').on('click', 'td.details-control', function () {
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
                           