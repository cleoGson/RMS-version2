@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Class Setup Details  <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right"  style="color:white; font-size:14px; font-weight:bold; background-color:#50f56712">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('academic.classsetup.index') }}" class="blue">Class setup List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Class Setup Details
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
<div class="card-header" style="color:white; font-size:14px; font-weight:bold; background-color:#506f99">Class  Setups Details
<div class="card-header-actions">
</div>
</div>
<div class="card-body card card-accent-primary">
<div class="jumbotron">
<h1 class="display-3">{{$show->name}}</h1>
<hr class="my-4">
<p>The page shows all curriculum for {{$show->name}}. the specified curricular are Examination curriculum, Grading system, GPA class breakdown and Subjects/courses allocated for each Semester .</p>
<p class="lead">
  <a class="btn btn-primary btn-s" href="{{route('academic.classsetup.curriculumn',encrypt($show->id))}}" role="button"> <i class="fa fa-download"></i>Curriculum</a>
    <a class="btn btn-success btn-s" href="{{route('academic.classsetup.edit',encrypt($show->id))}}" role="button"> <i class="fa fa-edit"></i>Edit</a>
 </p>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 mb-4">
<div class="nav-tabs-boxed">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home" style="color:#306a99; font-size:18px; font-weight:bold;" aria-selected="true"><i class="fa fa-book" style="color:light-blue; font-size:18px;"></i> Subject Curriculum</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile" style="color:#306a99; font-size:18px; font-weight:bold;" aria-selected="false"><i class="fa fa-award" style="color:light-blue; font-size:18px;"></i> Examination Curriculum </a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#feestructure-1" role="tab" aria-controls="feestructure" style="color:#306a99; font-size:18px; font-weight:bold;" aria-selected="false"><i class="fa fa-money" style="color:light-blue; font-size:18px;"></i> Fee Structure </a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#registration-1" role="tab" aria-controls="registration" style="color:#306a99; font-size:18px; font-weight:bold;" aria-selected="false"><i class="fa fa-graduation-cap" style="color:light-blue; font-size:18px;"></i> Grading Curriculum</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#gpa-1" role="tab" aria-controls="gpa" style="color:#306a99; font-size:18px; font-weight:bold;" aria-selected="false"><i class="fa fa-balance-scale" style="color:light-blue; font-size:18px;"></i> GPA Classes</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="home-1" role="tabpanel">
    <table  class="table table-responsive-sm table-bordered table-striped table-hover">
   @foreach($show->subjectCurriculars as $subjcurricular)
    <tr style="color:white; font-size:14px; font-weight:bold; background-color:#506f99"><th>Code </th><th>{{$subjcurricular->name}}</th> <th>Display Name </th> <th>Units</th> <th>Status</th></tr>
   @foreach($subjcurricular->compulsoryCurricularSubjects as $subjects)
    <tr><td>{{$subjects->code}} </td> <td> {{$subjects->name}} </td> <td> {{$subjects->display_name}}</td> <td>{{$subjects->units}}</td> <td> <span class="badge-primary  badge-pill">Compassary </span> </td>
    </tr>
    @endforeach
     @foreach($subjcurricular->optionalCurricularSubjects as $subjects)
    <tr><td>{{$subjects->code}} </td> <td> {{$subjects->name}} </td> <td> {{$subjects->display_name}}</td> <td>{{$subjects->units}}</td> <td> <span class="badge-warning badge-pill">Optional</span> </td>
    </tr>
    @endforeach
  @endforeach
      </table>
</div>
<div class="tab-pane" id="profile-1" role="tabpanel">
 <table  class="table table-responsive-sm table-bordered table-striped table-hover">
   @foreach($show->examinationCurriculars as $examinatioins)
   <tr style="color:white; font-size:14px; font-weight:bold; background-color:#506f99"><th>{{ $examinatioins->name}}</th> <th>Marks</th> <th> Out Of</th> <th>Status</th></tr>
   @foreach($examinatioins->examinationCurriculars as $examinations_data)
    <tr>
    <td>{{$examinations_data->partial_name}}  </td> <td>{{$examinations_data->marks}} </td> <td>{{$examinations_data->out_of}} </td> <td>{!!$examinations_data->status==1 ? '<span class="badge-primary badge-pill">Compassary </span>': '<span class="badge-primary badge-pill">Optional</span>'!!}  </td>
    </tr>
    @endforeach
  @endforeach
    </table>
</div>
<div class="tab-pane" id="feestructure-1" role="tabpanel">
 <table  class="table table-responsive-sm table-bordered table-striped table-hover">
    <tr style="color:white; font-size:14px; font-weight:bold; background-color:#506f99"><th>{{$show->feesStructureAmount->name}}</th> <th>Amount</th> <th> Year</th> <th>Status</th></tr>

   @foreach($show->feesStructureAmount->feesStructures as  $stucture)
    <tr>
    <td>{{$stucture->fees->name}}  </td> <td>{{$stucture->amount}} </td> <td>{{$stucture->years->name}} </td> <td>{!!$stucture->status==1 ? '<span class="badge-primary badge-pill">Compassary </span>': '<span class="badge-primary badge-pill">Optional</span>'!!}  </td>
    </tr>
  @endforeach
    <tr>
    <td>Total  </td> <td colspan='3'>{{array_sum(array_column($show->feesStructureAmount->feesStructures->toArray(),'amount'))}}</td> 
    </tr>
    </table>
</div>

<div class="tab-pane" id="registration-1" role="tabpanel">
   <table  class="table table-responsive-sm table-bordered table-striped table-hover">
    <tr style="color:white; font-size:14px; font-weight:bold; background-color:#506f99"><th>Grade</th> <th>Minimum marks</th> <th> Maximum Marks</th> <th>Grade Point </th> <th>Remarks </th></tr>
   @foreach($show->gradings->gradeCurricular as $grades_data)
     <tr>
    <td>  {{$grades_data->grades->name}}  </td> <td>{{$grades_data->minimum_marks}} </td> <td>{{$grades_data->maximum_marks}} </td> <td>{{$grades_data->grade_point}}</td> <td> <span class="badge-primary badge-pill"> {{$grades_data->grades->remarks}} </span>  </td> 
    </tr>
  @endforeach
    <tr>
    <td>  {{$grades_data->grades->name}}  </td> <td>{{$grades_data->minimum_marks}} </td> <td>{{$grades_data->maximum_marks}} </td> <td>{{$grades_data->grade_point}}</td> <td> <span class="badge-primary badge-pill"> {{$grades_data->grades->remarks}} </span>  </td> 
    </tr>
  </table>
</div>
<div class="tab-pane" id="gpa-1" role="tabpanel">
<table  class="table table-responsive-sm table-bordered table-striped table-hover">
<tr style="color:white; font-size:14px; font-weight:bold; background-color:#506f99"><th>Class</th> <th> From</th> <th>To</th> </tr>
  @foreach($show->gpa->gpaCurricular as $gpa)
   <tr>
    <td>  {{$gpa->name}}  </td> <td>{{$gpa->from}} </td> <td>{{$gpa->to}} </td> 
    </tr>
  @endforeach
</table>
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
                           
       
