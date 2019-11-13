<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Model\Student;
use App\Model\Country;
use App\Model\Disability;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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
        return $dataTables->eloquent(Student::with(['citizens','countries','disability','creator','updator'])->select('students.*'))
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
                return $row->created_by ? $row->creator->email : '';
            })
            ->editColumn('updated_by', function ($row) {
                return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
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
        $birthcountries=  $countries->pluck('name','id')->toArray();
        $citizenship =  $countries->pluck('citizenship','id')->toArray();
        return view('students.students.create',compact(['disability','birthcountries','citizenship']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email= !is_null(request('email'))  ?  request('email') : strtolower(request('firstname')).'.'.strtolower(request('middlename')).date('Ymdhms').'@student.com';
         $studentnumber ='10090089'.date('Ymdhms');
         $birth_date = date("Y-m-d", strtotime(request('birth_date')));
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
            'address'=>request('address'), 
            'phone_no'=>request('phone_no'), 
            'student_number'=>$studentnumber,
            'birth_country'=>request('birth_country'),
            'citzenship'=>request('citzenship'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Student status  has  successfully added.')->persistent();
        return redirect()->route('student.student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
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
        $disability = Disability::pluck('name','id')->toArray();
        $birthcountries= $countries->pluck('name','id')->toArray();
        $citizenship = $countries->pluck('citizenship','id')->toArray();
        return view('students.students.edit',
        [
            'disability'=>$disability,
            'birthcountries'=>$birthcountries,
            'citizenship'=>$citizenship,
            'show'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
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
            'phone_no', 
            'birth_country',
            'citzenship',
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
}
