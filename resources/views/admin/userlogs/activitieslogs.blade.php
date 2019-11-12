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
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        
            <div class="col-md-12">
            <div class="card-header">
            <div class="row">
            <div class="col-md-12">
            <span class="form-label">Filter Activity Logs </span>
            </div>
            </div>
            <hr/>
            <div class="row">
          <div class="col-lg-4  form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">           
           <div >
                 {!! Form::text('start_date', null, ['class'=>'form-control   dateTimepicker  ','tabindex'=>"-1",'required'=>'required','id'=>'start_date', 'placeholder'=>'Start Date']) !!}
                  
                  @if ($errors->has('start_date'))
                     <span class="help-block">
                         <strong>{{ $errors->first('start_date') }}</strong>
                     </span>
                 @endif
                 </div>
          </div>
          <div class="col-lg-4  form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                      <div >
                         {!! Form::text('end_date', null, ['class'=>'form-control   dateTimepickertwo ','tabindex'=>"-1",'id'=>'end_date', 'placeholder'=>'End Date']) !!}
                        @if ($errors->has('end_date'))
                           <span class="help-block">
                               <strong>{{ $errors->first('end_date') }}</strong>
                           </span>
                       @endif
                       </div>
          </div>
          <div class="col-lg-2 form-group">
                   <div >
                   <button type="button" class="btn btn-primary float-right" id="date_range_id">
                            Filter
                        </button>
                        </div>
                        </div>
                <div class="col-lg-2 form-group">
                   <div>
                        <button type="button" class="btn btn-primary float-left" id="refresh_id">
                            <i class="fa fa-sync"> </i> Reload
                        </button> 
                        </div>
                        </div>
                        </div>
                        </div>
                <div class="card">
                <div class = "table-responsive">
                <div class="card-body">
                        <table id="logsdata" class="table table-striped table-bordered" width="100%">
                            <thead>
                            <tr>
                            <th>Description </th>
                            <th>Affected ID</th>
                            <th>Affected Model</th>
                            <th>Causer Id</th>
                            <th>Causer Type</th>
                            <th>Created At</th>
                            <th>Properties </th>  
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
            var url = 'activitylogsdata';
            var orign = 'activitylogsdata';
            var table = $('#logsdata').DataTable({
                serverSide: true,
                processing: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25,100,"All"]],
                ajax: {
                    url: url,
                    data: function (d) {
                        d.start_date=$('#start_date').val()
                        d.end_date=$('#end_date').val()
                    },
                },
                columns: [
                    {data: 'description', name: 'description'},
                    {data: 'subject_id', name: 'subject_id'},
                    {data: 'subject_type', name: 'subject_type'},
                    {data: 'causer_id', name: 'causer_id'},
                    {data: 'causer_type', name: 'causer_type'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'properties', name: "properties"},      
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
            $("#refresh_id").click(function() {
                     $('#start_date').val('');
                     $('#end_date').val(''); 
                     table.ajax.reload();
                });

            $("#date_range_id" ).click(function() {
                var startDate=$('#start_date').val();
                var endDate=$('#end_date').val();
               
                if((startDate == "") || (endDate=="")){
                    alert("Please fill all dates");
                    table.ajax.reload();    

                }else{
                    if(startDate > endDate){
                        alert("End Date must be greater than start date");
                        table.ajax.reload();    
                    }
                    else
                    {
               table.ajax.reload();    
                    }
                   
                }
                });
        });
    </script>
 @stop
         
     
    