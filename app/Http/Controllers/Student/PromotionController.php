<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Model\AcademicyearStudent;
use App\Model\Academicyear;
use App\Model\Classsetup;
use App\Model\Studentstatus;
use App\Model\Classroom;
use App\Model\Classsection;
use App\Model\Student;
use App\Http\Requests\Academic\ClassroomRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PromotionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'students.promotions.actionsreg';
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
        $years=Academicyear::pluck('name','id')->toArray();
        $classsetups=Classsetup::pluck('name','id')->toArray();
        $studentstatus=Studentstatus::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $classesections=Classsection::pluck('name','id')->toArray();
         return view('students.promotions.index',compact(['years','classsetups','classesections','studentstatus','classes']));
     
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DataTables $dataTables)
    {
         if (request()->wantsJson()) {
        $template = 'students.promotions.actionsreg';
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
      return redirect()->route('student.promotion.index');
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
     * @param  \App\Model\AcademicyearStudent  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return redirect()->route('student.promotion.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AcademicyearStudent  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        if (request()->wantsJson()) {
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
        $years=Academicyear::pluck('name','id')->toArray();
        $classsetups=Classsetup::pluck('name','id')->toArray();
        $studentstatus=Studentstatus::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $show=$promotion;
        $classesections=Classsection::pluck('name','id')->toArray();
        return view('students.promotions.edit',compact(['years','classsections','classsetups',
        'studentstatus','classes','show']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AcademicyearStudent  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
         $promotion->updated_by = auth()->id();
         $promotion->reporting_date = date('Y-m-d');
         $promotion->update(request([  'student_id',
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
     * @param  \App\Model\AcademicyearStudent  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        alert()->success('success', 'Student status  has  successfully Deleted.')->persistent();
        return redirect()->route('student.academicyearStudent.index');
    }
}
