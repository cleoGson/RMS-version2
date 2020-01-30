@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                     Student Promotion  <i class="fas fa-plus-circle fa-fw"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                                         <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">

                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('student.promotion.index') }}" class="blue">Student  Promotion</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                         Student Promotion
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
             <div class="col-lg-6">
                  <div class="client card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" style="color:green" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                      </div>
                    </div>
                    <div class="card-body text-center">
                   <fieldset class="border p-2">
                  <legend  class="w-auto btn btn-default" style="border-radius:3px; color:#306a99; font-weight:bold; font-size:18px; "><i class="fa fa-arrow-down"></i>Promote From: </legend>
                      {!! Form::open(['route'=>'student.promotion.store','files'=>true,'id'=>"frm-example"] ); !!}
                      @include('students.promotions.form')
                     <div class="row">
                    <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">
                            Filter  Student(s)
                        </button>
                    </div>
                    </div>
                    </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
              <div class="col-lg-6">
                  <div class="client card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" style="color:green" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                      </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="status bg-green"></div>
                  <fieldset class="border p-2">
                  <legend  class="w-auto btn btn-default" style="border-radius:3px; color:#306a99; font-weight:bold; font-size:18px; "> <i class="fa fa-arrow-right"></i> Promote To:</legend>
                     {!! Form::open(['route'=>'student.promotion.store','files'=>true,'id'=>"frm-example"] ); !!}
                      @include('students.promotions.form')
                       </fieldset>
                      </div>
                      <div class="client-title">
                       </div>
                    </div>
                  </div>
                </div>
            </div>

  <fieldset class="border p-2">
 <legend  class="w-auto  btn btn-default" style="border-radius:3px; color:#306a99; font-weight:bold; font-size:18px; "> List of Student: </legend>
                 
<table id="example" class="table  table-bordered display" cellspacing="0" width="100%">
   <thead>
      <tr>
         <th></th>
         <th>First Name</th>
         <th>Middle Name</th>
         <th>Last Name</th>
         <th>Date of Birth</th>
         <th>Phone Number</th>
         <th>Email</th>
         <th>Student Number</th>
         <th></th>
      </tr>
   </thead>
   <tfoot>
      <tr>
         <th></th>
         <th>First Name</th>
         <th>Middle Name</th>
         <th>Last name</th>
         <th>Date of Birth</th>
         <th>Phone Number</th>
         <th>Email</th>
         <th>Student Number</th>
         <th></th>
      </tr>
   </tfoot>
</table>
</fieldset>
<hr>

<p>Press <b>Submit</b> and check console for URL-encoded form data that would be submitted.</p>

 <div class="row">
         <div class="col-md-12 form-group text-right">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">
                            Promote Student(s)
                        </button>

                        <a href="{{route('student.promotion.index')}}" class="btn btn-primary">
                            Back to List <i class="fas fa-list fa-fw"></i>
                        </a>
                    </div>
</div>
</div>

<p><b>Selected rows data:</b></p>
<pre id="example-console-rows"></pre>

<p><b>Form data as submitted to the server:</b></p>
<pre id="example-console-form"></pre>

 {!! Form::close()!!}


          </div>
             </div>
        <br /><br /><br /><br />
        </div>
            
    </section>
</section>
@endsection

@section('scripts')

<script>
$(document).ready(function() {
            var url = '/student/promotion/create';
            var start = '';
            var end = '';
            var orign = '/student/promotion/create';
           
            function format ( d ) {
    return '<table cellpadding="5" class="table  table-bordered" cellspacing="0" border="0" style="padding-left:50px;">'+
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
        '<tr>'+
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
        '<td>Disability:</td>'+
            '<td colspan="3">'+d.disability.name+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Birth Place:</td>'+
            '<td colspan="3">'+d.birth_place+'</td>'+
        '</tr>'+
        '<tr>'+
         '<td>Address:</td>'+
            '<td colspan="3">'+d.address+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Phone Number:</td>'+
            '<td colspan="3">'+d.phone_no+'</td>'+
        '</tr>'+
        '<tr>'+
         '<td>Birth Country:</td>'+
            '<td colspan="3">'+d.countries.name+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>Citizenship:</td>'+
            '<td colspan="3">'+d.citizens.name+'</td>'+
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
        '<tr>'
        +'<td>Updated At:</td>'+
            '<td  colspan="3">'+d.updated_at+'</td>'+
        '</tr>'+
    '</table>';
}
   var table = $('#example').DataTable({
       serverSide: true,
       processing: true,
      "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
      'ajax': url,
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']],
      columns: [
                    {data: 'id', name: 'id'},        
                    {data: 'firstname', name: 'firstname'},
                    {data: 'middlename', name: 'middlename'},
                    {data: 'lastname', name: 'lastname'},
                    {data: 'birth_date', name: 'birth_date'},
                    {data: 'phone_no', name: 'phone_no'},
                    {data: 'email', name: 'email'},
                    {data: 'email', name: 'email'},
                    {
                        className:      'details-control',
                        orderable:      false,
                        searchable: false,
                        data:           null,
                        defaultContent: "<button class='btn btn-success'> <i class='fa fa-eye'></i> View</button>"
                     },
                 
                ], dom: 'lBfrtip<"actions">',
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
   });   

//collapse table view
    $('#example tbody').on('click', 'td.details-control', function () {
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




                                 