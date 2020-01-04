<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Model\Student;
use App\Model\Country;
use App\Model\Disability;
use App\Setting\Bloodgroup;
use App\Model\Course;
use Illuminate\Http\Request;
use App\Model\AcademicyearStudent;
use App\Model\Attachment;
use Yajra\DataTables\DataTables;
use PDF;
use Crypt;
use App\Model\Familymember;
use App\User;
use App\Http\Requests\Student\StudentRequest;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
        $template = 'students.students.actions';
        return $dataTables->eloquent(Student::with(['citizens','countries','disability','createdBy','updatedBy'])->select('students.*'))
            ->editColumn('action', function ($row) use ($template) {
                $gateKey = 'student.student';
                $routeKey = 'student.student';
                return view($template, compact('row', 'gateKey', 'routeKey'));
            })
            ->editColumn('address', function ($row) {
                return $row->address ? strip_tags($row->address) : '';
            })->addColumn('full_name', function ($row) {
                return  $row->firstname.' '.$row->middlename.' '.$row->lastname;
             })
            ->editColumn('created_by', function ($row) {
                return $row->created_by ? $row->createdBy->email : '';
            })
            ->editColumn('updated_by', function ($row) {
                return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
            })
            ->make(true);
     }
         return view('students.students.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::get();
        $disability = Disability::pluck('name','id')->toArray();
        $bloodgroups =Bloodgroup::pluck('name','id')->toArray();
        $courses =Course::get()->pluck('course_name','id')->toArray();
        $birthcountries=  $countries->pluck('name','id')->toArray();
        $citizenship =  $countries->pluck('citizenship','id')->toArray();
        return view('students.students.create',compact(['disability','birthcountries','citizenship','bloodgroups','courses']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $email= !is_null(request('email'))  ?  request('email') : strtolower(request('firstname')).'.'.strtolower(request('middlename')).date('Ymdhms').'@student.com';
         $studentnumber ='10090089'.date('Ymdhms');
         $birth_date = date("Y-m-d", strtotime(request('birth_date')));
         $profile=null;
        if($request->hasFile('photo')) {
        $extension = $request->file('photo')->getClientOriginalExtension();
        //filename to store
        $filenametostore = date('Ymdhms').microtime(true).'.'.$extension;
        //Upload File
        $request->file('photo')->storeAs('public/profile', $filenametostore);
        $profile = 'storage/profile/'.$filenametostore;
        }
         $student = Student::create([
            'firstname'=>request('firstname'),
            'middlename'=>request('middlename'),
            'lastname'=>request('lastname'),
            'sex'=>request('sex'),
            'marital_status'=>request('marital_status'), 
            'birth_date'=>$birth_date,
            'disability'=>request('disability'),
            'birth_place'=>request('birth_place'),
            'email'=>$email, 
             'photo'=>$profile,
            'address'=>request('address'), 
            'phone_no'=>request('phone_no'), 
            'student_number'=>$this->studentGeneratedNumber(),
            'birth_country'=>request('birth_country'),
            'course'=>request('course'),
            'blood_group'=>request('blood_group'),
            'citizenship'=>request('citizenship'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Student status  has  successfully added.')->persistent();
        return redirect()->route('student.student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  Crypt::encypt($student)
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $show =$student;
        return view('students.students.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $countries=Country::get();
        $courses =Course::get()->pluck('course_name','id')->toArray();
        $bloodgroups =Bloodgroup::pluck('name','id')->toArray();
        $disability = Disability::pluck('name','id')->toArray();
        $birthcountries= $countries->pluck('name','id')->toArray();
        $citizenship = $countries->pluck('citizenship','id')->toArray();
        return view('students.students.edit',
        [
            'disability'=>$disability,
            'birthcountries'=>$birthcountries,
            'courses'=> $courses,
            'citizenship'=>$citizenship,
            'bloodgroups'=>$bloodgroups,
            'show'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->updated_by = auth()->id();
        $student->birth_date =date("Y-m-d", strtotime(request('birth_date')));
        $student->update(request([
            'firstname',
            'middlename',
            'lastname',
            'sex',
            'marital_status', 
            'disability',
            'birth_place',
            'address', 
            'photo',
            'phone_no', 
            'birth_country',
            'blood_grroup',
            'course',
            'citizenship',
        ]));
        alert()->success('success', 'Student status  has  successfully Updated.')->persistent();
        return redirect()->route('student.student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        alert()->success('success', 'Student status  has  successfully Deleted.')->persistent();
        return redirect()->route('student.student.index');
    }

         public function studentGeneratedNumber()
    {
             $number = "STUDENT-".date('Y');
       
            $student_number = Student::withTrashed()->where('student_number', 'like', '%'.$number.'%')->count();
            $student_number += 1;
            if ($student_number >= 0 && $student_number < 10) {
                $assigned_number =$number."-000" . $student_number;
            } else if ($student_number >= 10 && $student_number < 100) {
                $assigned_number =$number."-00" . $student_number;
            } else if ($student_number >= 100 && $student_number < 10000) {
                $assigned_number =$number."-0" . $student_number;
            } else {
                $assigned_number =$number.'-'. $student_number;
            }
            return $assigned_number;
    }
    public function copyToUser(Student $student)
    {
         if(!User::where("email",$student->email)->exists()){
            $user = new User();  
            $user->email= $student->email;
            $user->username= $student->student_number;
            $user->password= '$2y$10$hYn98f2N.XEuW9SD3jE8Tu6ElWLD5dmPmQLqsU5ULFFxO89/0kO9.';
            $user->verifiedstatus=1;
            $user->userable_type="App/Model/Student";
            $user->userable_id=$student->id;
            $user->password_changed_at= now();
            $user->image='profile/avatar.png';
            $user->status=1;
            $user->center_id= $student->center_id??1;
            $user->created_by=auth()->user()->id;
            $user->created_at= now();
            $user->save();
         }
        alert()->success('success', 'User Account created');
        return redirect()->back();
    }

    public function  studentRelatives(DataTables $dataTables,$studentid){
         $type="App/Model/Student";
         $typeid=$studentid;
             if (request()->wantsJson()) {
            $template = 'generals.familymembers.actions';
            return $dataTables->eloquent(Familymember::with(['disability','relationship','createdBy','updatedBy'])->where([['memberable_type','=',$type, 
           ],[ 'memberable_id','=',$typeid->id]])->select('familymembers.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'general.familymember';
                    $routeKey = 'general.familymember';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('firstname', function ($row) {
                    return $row->firstname ? strip_tags($row->firstname) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? $row->updatedBy->email : '';
                })
                ->make(true);
        }
      }

     public function  studentRegistrations(DataTables $dataTables,$studentid){
       
      if (request()->wantsJson()) {
            return $dataTables->eloquent(AcademicyearStudent::with(['createdBy','student','createdBy','years','studentStatus','class','classSetup','classSection'])->where('student_id',$studentid->id)->select('academicyear_students.*'))
                    ->editColumn('student_id', function ($row) {
                    return $row->student_id ? $row->student->firstname."  ".$row->student->middlename." ".$row->student->lastname." (".$row->student->student_number." )" : '';
                })
                    ->editColumn('year_id', function ($row) {
                    return $row->year_id ? $row->years->name : '';
                })
                      ->editColumn('studentstatus_id', function ($row) {
                    return $row->studentstatus_id ? $row->studentStatus->name : '';
                })
                      ->editColumn('class_id', function ($row) {
                    return $row->class_id ? $row->class->name : '';
                })
                      ->editColumn('classsection_id', function ($row) {
                    return $row->classsection_id ? $row->classSection->name : '';
                })
                    ->editColumn('classsetup_id', function ($row) {
                    return $row->classsetup_id ? $row->classSetup->name : '';
                })
              
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->createdBy->email)) : '';
                })
                ->make(true);
         }
         
     }

      public function  studentAttachments(DataTables $dataTables,$studentid){
         $type="App/Model/Student";
         $typeid=$studentid;
        if (request()->wantsJson()) {
            $template = 'generals.attachments.actions';
            return $dataTables->eloquent(Attachment::with(['createdBy','updatedBy','attachmentType'])
            ->where([['attachable_type','=',$type, 
           ],[ 'attachable_id','=',$typeid->id]])->select('attachments.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'general.attachment';
                    $routeKey = 'general.attachment';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                  ->editColumn('attachment_type', function ($row) {
                    return $row->attachment_type ? strip_tags($row->attachmentType->name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                ->make(true);
         }

      }


}
