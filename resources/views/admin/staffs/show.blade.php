@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                         Staff  Details  <i class="fa fa-eye-o" aria-hidden="true"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.staff.index') }}" class="blue">Staff List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                             Staff Details
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
             <div class="card card-default">
             <div class="card-body card card-accent-primary"> 
             <div class="row">
             <div class="col-lg-4">
                  <div class="client card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" style="color:green" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                      </div>
                    </div>
                    <div class="card-body text-center">
                      <div class="client-avatar">
                      <!-- <img  width="200" height="200" src="https://d19m59y37dris4.cloudfront.net/admin/1-4-5/img/avatar-2.jpg" 
                      > -->
                      <img src="{{ URL::to('/').'/'.$show->photo}}" width='200' height='200' alt='...'  class='img-fluid rounded-circle'/>
                        <div class="status bg-green"></div>
                      </div>
                      <div class="client-title">
                        <h3>Godson F. Kileo</h3>
                        <h4 class="btn  btn-primary" style="height=20">Staff</h4>
                      </div>
                    </div>
                  </div>
                </div>
              <div class="col-lg-8">
                  <div class="client card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" style="color:green" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                      </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="status bg-green"></div>
                         <table class="table table-bordered table-sm table-hover">  
                        <tr><th>Full Name:</th> <td>Godson F. Kileo </td> </tr>
                        <tr><th>Date of Birth:</th> <td>1980-12-21</td> </tr>
                        <tr><th>Age:</th> <td>9 years</td> </tr>
                         <tr><th>Trible:</th> <td>Shona</td> </tr>
                        <tr><th>Status:</th> <td>Continue </td> </tr>
                        <tr><th>Course:</th> <td>Certificate of Secondary Education </td> </tr>
                        <tr><th>Course Duration:</th> <td>7 year </td> </tr>
                        <tr><th>Year of Study:</th> <td>3rd Year </td> </tr>
                         </table>
                      </div>
                      <div class="client-title">
                       </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12 mb-4">
            <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home" aria-selected="true"  style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-book-open" style="color:green; font-size:18px;"></i> Details</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-users" style="color:green"></i> Next of King</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#registration-1" role="tab" aria-controls="registration" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-users" style="color:green"></i> Registration</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#education-1" role="tab" aria-controls="education" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-list" style="color:green"></i> Education History</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#attachment-1" role="tab" aria-controls="attachment" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-file" style="color:green"></i> Attachments</a></li>     
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payment-1" role="tab" aria-controls="payment" aria-selected="false" style="color:#306a99; font-size:18px; font-weight:bold;"><i class="fa fa-users" style="color:green"></i> Referee</a></li>       
  
            </ul>
            <div class="tab-content">
            <div class="tab-pane active" id="home-1" role="tabpanel">
            @include('admin.staffs.tabs.details')
            </div>

            <div class="tab-pane" id="profile-1" role="tabpanel">
            @include('admin.staffs.tabs.parents')
            </div>
            <div class="tab-pane" id="payment-1" role="tabpanel">
            @include('admin.staffs.tabs.payments')
            </div>
            <div class="tab-pane" id="registration-1" role="tabpanel">
            @include('admin.staffs.tabs.registration')
            </div>
            <div class="tab-pane" id="education-1" role="tabpanel">
            @include('admin.staffs.tabs.education')
            </div>
            <div class="tab-pane" id="attachment-1" role="tabpanel">
            @include('admin.staffs.tabs.attachments')
            </div>
          
            </div>
            </div>
            </div>
            </div>
            </div>


                </div>
            </div>
            <br /><br /><br /><br />
        </div>
    </section>
</section>
@endsection

@section('scripts')
    <script>
    var studentid ="<?php echo encrypt($show->id) ?>";
        $(function () {
            var url = '/student/relatives/'+studentid;
            var start = '';
            var end = '';
            var orign = '/student/relatives/'+studentid;
            function format ( d ) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>First name:</td>'+
            '<td colspan="3">'+d.firstname+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Middle name:</td>'+
            '<td colspan="3">'+d.middlename+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Last name:</td>'+
            '<td colspan="3">'+d.lastname+'</td>'+
        '</tr>'+
        '<td>Birth date:</td>'+
            '<td colspan="3">'+d.birth_date+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Email:</td>'+
            '<td colspan="3">'+d.email+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Gender:</td>'+
            '<td colspan="3">'+d.sex+'</td>'+
        '</tr>'+
        '<tr>'+
        '<tr>'+
        '<td>Disability:</td>'+
            '<td colspan="3">'+d.disability.name+'</td>'+
        '</tr>'+
        '<tr>'+

        '<tr>'+
         '<td>Address:</td>'+
            '<td colspan="3">'+d.address+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Phone Number:</td>'+
            '<td colspan="3">'+d.phone_no+'</td>'+
        '</tr>'+
        '<tr>'+
        '<tr>'+
        '<tr>'+
         '<td>Birth Country:</td>'+
            '<td colspan="3">'+d.relationship.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created By:</td>'+
            '<td colspan="3">'+d.created_by+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created At:</td>'+
            '<td colspan="3">'+d.created_at+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Updated By:</td>'+
            '<td colspan="3">'+d.updated_by+'</td>'+
        '</tr>'+
        '<tr>'+
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}
            
            var table = $('#familymember').DataTable({
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
                    {data: 'firstname', name: 'firstname'},
                    {data: 'middlename', name: 'middlename'},
                    {data: 'lastname', name: 'lastname'},
                    {data: 'birth_date', name: 'birth_date'},
                    {data: 'phone_no', name: 'phone_no'},
                    {data: 'email', name: 'email'},
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
        

        $('#familymember tbody').on('click', 'td.details-control', function () {
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

      <script>
        $(function () {
            var studentid ="<?php echo encrypt($show->id) ?>";
            var url = '/student/registration/'+studentid;
            var start = '';
            var end = '';
            var orign = '/student/registration/'+studentid;
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
 <script>
        $(function () {
            var studentid ="<?php echo encrypt($show->id) ?>";
            var url = '/student/attachment/'+studentid;
            var start = '';
            var end = '';
            var orign = '/student/attachment/'+studentid;
            function format ( d ) {
    //alert(JSON.stringify(d));
    // `d` is the original data object for the row
    return '<table cellpadding="5" class="table table-responsive-sm table-bordered table-striped" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>attachment Type:</td>'+
            '<td colspan="3">'+d.attachment_type+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Attachment:</td>'+
            '<td colspan="3">'+d.file+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>name:</td>'+
            '<td colspan="3">'+d.remarks+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created By:</td>'+
            '<td colspan="3">'+d.creat+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Created At:</td>'+
            '<td colspan="3">'+d.created_at+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Updated By:</td>'+
            '<td colspan="3">'+d.updat+'</td>'+
        '</tr>'+
        '<tr>'
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}
            
            var table = $('#attachment').DataTable({
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
                    {data: 'attachment_type', name: 'attachment_type'},
                    {data: 'file', name: 'file'},
                    {data: 'remarks', name: 'remarks'},
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
        

        $('#attachment tbody').on('click', 'td.details-control', function () {
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


   
          
       
