

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
<div class="card-body card card-accent-primary">
<div class="table table-responsive">
<table class="table table-responsive-sm table-bordered table-striped table-hover" id="academicyearStudent">
<thead>
<tr>
<th>Student Name </th>
<th>Year</th>
<th>Class </th>
<th>Class Section </th>
<th>Class Setup</th>
<th>Status</th>
<th>View</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Student Name </th>
<th>Year</th>
<th>Class  </th>
<th>Class Section </th>
<th>Class Setup</th>
<th>Status</th>
<th>View</th>
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
    return '<table cellpadding="5" class="table table-responsive-sm table-bordered table-striped" cellspacing="0" border="0" style="padding-left:50px;">'+
         '<tr>'+
            '<td>Student:</td>'+
            '<td colspan="3">'+d.student_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Year:</td>'+
            '<td colspan="3">'+d.year_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>student status:</td>'+
            '<td colspan="3">'+d.studentstatus_id+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Class:</td>'+
            '<td colspan="3">'+d.class_id+'</td>'+
        '</tr>'+
          '<tr>'+
            '<td>Class setup:</td>'+
            '<td colspan="3">'+d.classsetup_id+'</td>'+
        '</tr>'+
           '<tr>'+
            '<td>Class section:</td>'+
            '<td colspan="3">'+d.classsection_id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created By:</td>'+
            '<td colspan="3">'+d.created_by+'</td>'+
        '</tr>'+
        '<tr>'+
         '<tr>'+
            '<td>Reporting date:</td>'+
            '<td colspan="3">'+d.reporting_date+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created At:</td>'+
            '<td colspan="3">'+d.created_at+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Updated By:</td>'+
            '<td colspan="3">'+d.updated_by+'</td>'+
        '</tr><tr>'
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
                            d.class_id = $('select[name=class_id]').val()
                            d.classsection_id = $('select[name=classsection_id]').val()
                            d.year_id = $('select[name=year_id]').val()
                            d.semester_id = $('select[name=classsetup_id]').val()
                            d.classsetup_id = $('select[name=classsetup_id]').val()
                            
                    },
                },


                columns: [
                    {data: 'student_id', name: 'student_id'},
                    {data: 'year_id', name: 'year_id'},
                    {data: 'class_id', name: 'class_id'},
                    {data: 'classsection_id', name: 'classsection_id' },
                    {data: 'classsetup_id', name: 'classsetup_id'},
                    {data: 'studentstatus_id', name: 'studentstatus_id'},
                    {
                        className:      'details-control',
                        orderable:      false,
                        searchable: false,
                        data:           null,
                        defaultContent: "<button class='btn btn-success'> <i class='fa fa-eye'></i> View</button>"
                     },
                    //{data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                 dom: 'lBfrtip<"actions">',
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
              
               // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;
      
      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production
      
      // Output form data to a console     
      $('#example-console-rows').text(rows_selected.join(","));
      
      // Output form data to a console     
      $('#example-console-form').text($(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });     // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;
      
      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production
      
      // Output form data to a console     
      $('#example-console-rows').text(rows_selected.join(","));
      
      // Output form data to a console     
      $('#example-console-form').text($(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
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
                           