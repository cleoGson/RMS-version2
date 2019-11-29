<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i>Students Detail 
  
  <a href="{{ route('student.student.edit',$show->id) }}" class="float-right">
                         
  <button class="btn btn-success  bold ">  Update Details  <i class="fa fa-pencil-square-o fa-fw"></i> </button>
                   </a>
                   </div>
<div class="card-body">
                     <div class="row">
                     <div class="col-md-8">
                     <center>
                     
                      picture will be here
                     </center>
                    
                     </div>
                     </div>
                        <table class="table table-bordered table-sm table-hover">
                                <tr><td><b>Full Name:</b>  </td><td> <b>{{$show->full_name}}</b></td></tr>
                                <tr><td><b>Gender:</b>  </td><td> <b>{{$show->sex}}</b></td></tr>
                                <tr><td><b>Date of Birth:</b>  </td><td> <b>{{$show->birth_date}}</b></td></tr>
                                <tr><td><b>Disability:</b>  </td><td> <b>{{$show->disability}}</b></td></tr>
                                <tr><td><b>Birth place:</b>  </td><td> <b>{{$show->birth_place}}</b></td></tr>
                                <tr><td><b>Email:</b>  </td><td> <b>{{$show->email}}</b></td></tr>
                                <tr><td><b>Address:</b>  </td><td> <b>{{$show->address}}</b></td></tr>
                                <tr><td><b>Phone Number</b>phone_no:</b>  </td><td> <b>{{$show->phone_no}}</b></td></tr>
                                <tr><td><b>Student Number:</b>  </td><td> <b>{{$show->student_number}}</b></td></tr>
                                <tr><td><b>Birth Country:</b>  </td><td> <b>{{$show->countries->name}}</b></td></tr>
                                <tr><td><b>Blood Group:</b>  </td><td> <b>{{$show->blood_group}}</b></td></tr>
                                <tr><td><b>citzenship:</b>  </td><td> <b>{{$show->citizens->citizenship}}</b></td></tr>

                    </table>

    </div>
    </div>