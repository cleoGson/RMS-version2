@extends('layouts.admin')
@section('content')
    <section class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                         User Logs
                        </h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard-index') }}">Home</a>
                            </li>

                            <li class="breadcrumb-item active">
                             User Logs Details for:
                            </li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">
              <div class="col-md-12">
                <div class="card">
                
                <table class="table table-striped table-bordered">
                <tr><td>Full Name</td> <td>{{$userlogs->name}} </td>   </tr>
                <tr><td> Check Nmber</td><td>{{$userlogs->check_no}}</td>  </tr>
                <tr><td>Email Adres </td><td> {{$userlogs->email}}</td>  </tr>
                <tr><td>Phone Number </td><td>{{$userlogs->phone_no}}</td> </tr>
                <tr><td>Department </td> <td>{{$userlogs->department->name}} </td> </tr>
              
                </table>
                </div>
                </div>
            <div class="col-md-12">

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
          {!! Form::open(['route'=>'logs-store','files'=>true]); !!}          
           <div >
                 {!! Form::hidden('log_id',$userdetails->id) !!}
                 {!! Form::text('start_date', null, ['class'=>'form-control   form_date  ','tabindex'=>"-1",'required'=>'required','id'=>'start_date', 'placeholder'=>'Start Date']) !!}
                  
                  @if ($errors->has('start_date'))
                     <span class="help-block">
                         <strong>{{ $errors->first('start_date') }}</strong>
                     </span>
                 @endif
                 </div>
          </div>
          <div class="col-lg-4  form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                      <div >
                         {!! Form::text('end_date', null, ['class'=>'form-control   form_date ','tabindex'=>"-1",'id'=>'end_date','required'=>'required','placeholder'=>'End Date']) !!}
                        @if ($errors->has('end_date'))
                           <span class="help-block">
                               <strong>{{ $errors->first('end_date') }}</strong>
                           </span>
                       @endif
                       </div>
          </div>
          <div class="col-lg-2 form-group">
                   <div >
                   <button type="submit" class="btn btn-primary float-right" id="date_range_id">
                            Filter
                        </button>
                        </div>
                        {!! Form::close()!!}
                        </div>
                        <div class="col-lg-2 form-group">
                       <div>
                        <a href="{{route('logs-show', $userdetails->id)}}"class="btn btn-primary float-left" id="refresh_id">
                            <i class="fa fa-sync"> </i> Reload
                        </a> 
                        </div>
                        </div>
                        </div>
                     
                        </div>
                <div class="card">
                <div class = "table-responsive" >
                <table class="table table-striped table-bordered"  id="user_table">
                                    <thead>
                                        <tr>
                                        <th>
                                                <a href="#">
                                                 Id 
                                                </a>

                                                &nbsp;
                                                <i class="fa fa-sort-alpha-asc"></i>
                                            </th>
                                        <th>
                                                <a href="#">
                                                   Model  
                                                </a>

                                                &nbsp;
                                                <i class="fa fa-sort-alpha-asc"></i>
                                            </th>
                                        <th>
                                                <a href="#">
                                                 Event 
                                                </a>

                                                &nbsp;
                                                <i class="fa fa-sort-alpha-asc"></i>
                                            </th>  
                                            <th>
                                                <a href="#">
                                                Time
                                                </a>

                                                &nbsp;
                                                <i class="fa fa-sort-alpha-asc"></i>
                                            </th> 
                                            <th> 
                                            
                                         Event
                                             </th>
                                            <th>
                                                <a href="#">
                                                    Properties
                                                </a>

                                                &nbsp;
                                                <i class="fa fa-sort-alpha-asc"></i>
                                            </th>
                                             
                                        </tr>
                                    </thead>
                              <tbody>
                              @if(!is_null($user_actions))
                                        @foreach(array_reverse($user_actions->toArray()) as $logs)
                                        
                                            <tr>
                                            <td> 
                                               {{$logs['subject_id']}}
                                               </td>
                                            <td> 
                                               {{$logs['subject_type']}}
                                               </td>
                                               <td> 
                                               {{$logs['description']}}  
                                               </td>
                                               <td>{{ $logs['created_at'] }}</td>
                                               <td>
                                                @if($logs['description']== "updated")
                                                <table>
                                                <tr>
                                                <td>
                                                Updated Values:
                                                </td>
                                                </tr>
                                                <tr>
                                                <td>
                                                 Old Values:
                                                </td>
                                                </tr>
                                                </table>
                                                @else
                                                Created Value:
                                                @endif
                                                </td>
                                               <td> 
                                               <table>
                                               
                                                <tr> 
                                                @if(!is_null($logs['properties']) && count($logs['properties']) > 0)  
                                                @foreach($logs['properties']['attributes'] as $key=>$newvalues)
                                               <td>{{$key}}:<br/> {{$newvalues}}</td>
                                                @endforeach
                                                @endif
                                                </tr>
                                                @if($logs['description'] == "updated")
                                                <tr>
                                                @if(!is_null($logs['properties']) && count($logs['properties']) > 0)
                                                @foreach($logs['properties']['old'] as $key=>$oldvalues)
                                                <td> {{$key}}:<br/> {{$oldvalues}}</td>
                                                @endforeach
                                                @endif
                                                </tr>
                                                @endif
                                               </table>
                                               <table>

                                               </table>
                                              
                                               </td>
                                               
                                                </tr>
                                        @endforeach
                                        @else
                                                <tr> 
                                                <td colspan="5">
                                                <i class="fa fa-exclamation-triangle"> </i> No performed Events 
                                                </td>
                                                </tr>
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                           
                                <div class="box-footer">
                                <div class="pull-left"
                                  style="margin-top: 7px;">
                                  
                             </div>
     
                             
                         </div>
                  </div>
             </div>
        <br /><br /><br /><br />
        </div>
     </section>
     
     @endsection
     
    