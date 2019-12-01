<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;

use App\Model\AcademicyearStudent;
use App\Http\Requests\Academic\ClassroomRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Model\Academicyear;
use App\Model\Classsetup;
use App\Model\Student;
use App\Model\Studentstatus;
use App\Model\Classsection;
use App\Model\Classroom;

class AcademicyearStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'students.academicyearStudents.actions';
            return $dataTables->eloquent(AcademicyearStudent::with(['createdBy','createdBy'])->select('academicyear_students.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'student.academicyearStudent';
                    $routeKey = 'student.academicyearStudent';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('year_id', function ($row) {
                    return $row->year_id ? $row->years->name : '';
                })
                 ->editColumn('studentstatus_id', function ($row) {
                    return $row->studentstatus_id ? $row->studentstatus_id : '';
                })
                  ->editColumn('class_id', function ($row) {
                    return $row->class_id ? $row->class_id : '';
                })
                   ->editColumn('classsetup_id', function ($row) {
                    return $row->classsetup_id ? $row->classsetup_id : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->createdBy->email)) : '';
                })
                ->make(true);
         }
         return view('students.academicyearStudents.index');
    }

    public function indexRegistration(DataTables $dataTables)
    {   
         if (request()->wantsJson()) {
         $template = 'students.academicyearStudents.actionsreg';
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
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $years=Academicyear::pluck('name','id')->toArray();
        $classsetups=Classsetup::pluck('name','id')->toArray();
        $studentstatus=Studentstatus::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $classesections=Classsection::pluck('name','id')->toArray();

        return view('students.academicyearStudents.create',compact(['years','classsetups','classesections','studentstatus','classes']));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentsList = request('student_id');
        dd($studentsList);
        foreach($studentsList as $studentkey=>$value){
         AcademicyearStudent::create([
             'created_by'=>auth()->id(),
             'student_id'=>$value,
             'year_id'=>request('year_id'),
             'studentstatus_id'=>1,
             'class_id'=>request('class_id'),
             'classsetup_id'=>request('classsetup_id'),
             'reporting_date'=>request('reporting_date')
        ]);
       }
        alert()->success('success', 'Student status  has  successfully added.')->persistent();
        return redirect()->route('student.academicyearStudent.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\AcademicyearStudent  $academicyearStudent
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicyearStudent $academicyearStudent)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AcademicyearStudent  $academicyearStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicyearStudent $academicyearStudent)
    {
         if (request()->wantsJson()) {
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
        $years=Academicyear::pluck('name','id')->toArray();
        $classsetups=Classsetup::pluck('name','id')->toArray();
        $studentstatus=Studentstatus::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $show=$academicyearStudent;
        $classesections=Classsection::pluck('name','id')->toArray();
        return view('students.academicyearStudents.edit',compact(['years','classsections','classsetups',
        'studentstatus','classes','show']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AcademicyearStudent  $academicyearStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicyearStudent $academicyearStudent)
    {
         $academicyearStudent->updated_by = auth()->id();
         $academicyearStudent->reporting_date = date('Y-m-d');
         $academicyearStudent->update(request([  'student_id',
        'year_id',
        'studentstatus_id',
        'class_id',
        'classsetup_id',
        'remarks']));
        alert()->success('success', 'Student status  has  successfully Updated.')->persistent();
        return redirect()->route('student.academicyearStudent.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\AcademicyearStudent  $academicyearStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicyearStudent $academicyearStudent)
    {
        $academicyearStudent->delete();
        alert()->success('success', 'Student status  has  successfully Deleted.')->persistent();
        return redirect()->route('student.academicyearStudent.index');
    }
}
