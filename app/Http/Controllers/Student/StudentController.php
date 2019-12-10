<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Model\Student;
use App\Model\Country;
use App\Model\Disability;
use App\Setting\Bloodgroup;
use App\Model\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;
use Crypt;
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
             $number = "%STUDENT-".date('Y'). '%';
       
            $student_number = Student::withTrashed()->where('student_number', 'like', $number)->count();
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
}
