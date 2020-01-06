@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Class set up Details  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('student.student.index') }}" class="blue">student List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Class set up Details
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


                <div class="card">
<div class="card-header"> Setup Details
<div class="card-header-actions">
</div>
</div>
<div class="card-body card card-accent-primary">
<div class="jumbotron">
<h1 class="display-3">{{$show->name}}</h1>
<p class="lead">This shows the details for the setup.</p>
<hr class="my-4">
<p>The page shows all curricullum for the above  mentioned class. the specified curricular are Examination curriculum, Grading system, and Subjects/courses allocated for each Semester .</p>
<p class="lead">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 mb-4">

<fieldset class="border p-2">
   <legend  class="w-auto badge-info">Subject Curriculum</legend>
     <ul class="list-group">
   @foreach($show->subjectCurriculars as $subjcurricular)
  <li class="list-group-item d-flex justify-content-between align-items-center">
   {{$subjcurricular->name}}
    <span class="badge-primary badge-pill"></span>
  </li>
  @endforeach
   
</ul>

</fieldset>
</br>

<fieldset class="border p-2">
   <legend  class="w-auto badge-info">Grading Curriculum</legend>
   <ul class="list-group">
   @foreach($show->gradings->gradeCurricular as $grades)
  <li class="list-group-item d-flex justify-content-between align-items-center">
   {{$grades->name}}
    <span class="badge-primary badge-pill"></span>

  </li>
  @endforeach
   
</ul>
</fieldset>
</br>


<fieldset class="border p-2">
   <legend  class="w-auto badge-info" >Examination Curriculum</legend>
  <ul class="list-group">
   @foreach($show->examinationCurriculars as $examinatioins)
  <li class="list-group-item d-flex justify-content-between align-items-center">
   {{$examinatioins->name}}
    <span class="badge-primary badge-pill"></span>
  </li>
  @endforeach
   
</ul>
</fieldset>
</br>

</div>
</div>

<div class="row">
<div class="col-md-12 mb-4">
<div class="nav-tabs-boxed">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-book-open" style="color:blue"></i> Details</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-users" style="color:blue"></i> Next of King</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#registration-1" role="tab" aria-controls="registration" aria-selected="false"><i class="fa fa-users" style="color:blue"></i>Registration</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#education-1" role="tab" aria-controls="education" aria-selected="false"><i class="fa fa-users" style="color:blue"></i>Education History</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="home-1" role="tabpanel">
 details 1
</div>

<div class="tab-pane" id="profile-1" role="tabpanel">

details 2
</div>
<div class="tab-pane" id="registration-1" role="tabpanel">
details 3
</div>
<div class="tab-pane" id="education-1" role="tabpanel">
details 4
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
        $(function () {
            var url = '/general/familymember';
            var start = '';
            var end = '';
            var orign = '/general/familymember';
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
   
@stop
                           
       
