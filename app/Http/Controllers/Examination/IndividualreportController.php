<?php

namespace App\Http\Controllers\Examination;
use App\Http\Controllers\Controller;
use App\Model\Examinationnaature;
use App\Model\Examinationresult;
use App\Model\Examinationcurricular;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Model\Academicyear;
use App\Model\Classsection;
use App\Model\Classroom;
use App\Model\Gradecurricular;
use App\Model\AcademicyearStudent;
use App\Model\Curricular;
use App\Model\Feesstructure;
use App\Rules\MarksvalidatorRule;
use App\Rules\ResultPostingRule;
use App\Model\Examinationnature;
use App\Model\Classsetup;
use App\Exports\AcademicyearStudentExport;
use App\Imports\ExaminationresultImports;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Examination\ExaminationresultRequest;
use DB;
use Crypt;
use App\Model\Semester;

class IndividualreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request){
        if(!is_null($request->year_id)){
        $this->validate($request,[
            'year_id'=>'required|exists:academicyears,id',
        ]);
        }
         $classes=Classroom::pluck('name','id')->toArray();
          $years=Academicyear::pluck('name','id')->toArray();
          $year_id = !is_null($request->year_id) ?  $request->year_id : Academicyear::whereStatus('open')->first()->id;
          $year_data=Academicyear::findOrFail($year_id);
          foreach($classes as $key=>$value){
            $student_data=AcademicyearStudent::with(['student'])->where([['class_id','=',$key],['year_id','=', $year_id]]);
           $studentsprovider[$key]=array('students'=>$student_data->get(),
                                    'number_student'=>$student_data->count(),
                                    'year'=>$year_data->name,
                                    'class_id'=>$key,
                                    'class_name'=>$value,
                                    'year_id'=> $year_id,
                                    'classsetup_name'=>!is_null($student_data->first()) ? $student_data->first()->classSetup->name : "",
                                    'classsetup_id'=>!is_null($student_data->first()) ? $student_data->first()->classSetup->id : 0,

                                );
          }
     return view('examinations.reports.index',compact(['studentsprovider','years'])); 

    }



     public function studentsLists(DataTables $dataTables,$classid,$yearid){        
     if (request()->wantsJson()) {
                $students =  $student_data=AcademicyearStudent::with(['createdBy','student','createdBy','years','studentStatus','class','classSetup','classSection'])
                ->where([['class_id','=',$classid],['year_id','=',$yearid]]);
               $template = 'examinations.reports.actions';
                 return $dataTables->eloquent($students->select('academicyear_students.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'examination.individualreport';
                    $routeKey = 'examination.individualreport';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                }) 
                  ->editColumn('student_id', function ($row) {
                    return $row->student_id ? $row->student->firstname."  ".$row->student->middlename." ".$row->student->lastname : '';
                })
                    ->editColumn('year_id', function ($row) {
                    return $row->year_id ? $row->years->name : '';
                })
                
                  ->addColumn('student_number', function ($row) {
                return  $row->student->student_number;
            
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
                ->make(true);
            }   
                 $classdetails=Classroom::findOrFail($classid);
                 $yeardetails=Academicyear::findOrFail($yearid);
                 return view('examinations.reports.student_list',compact('classdetails','yeardetails'));
             }



    public function resultSheets($studentid,$yearid,$classsetup_id){
        $yeardetails=Academicyear::findOrFail($yearid);
        $classsetup_id=Classsetup::findOrFail($classsetup_id);
        dd($classsetup_id);
        return view('examinations.reports.result_sheet',compact(['yeardetails']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
