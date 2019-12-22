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
                $students =  $student_data=AcademicyearStudent::join('students','academicyear_students.student_id','=','students.id')
                ->where([['class_id','=',$classid],['year_id','=',$yearid]])
                ->select('academicyear_students.id','students.firstname','students.middlename','students.lastname','students.student_number');
               $template = 'examinations.results.actions';
                 return $dataTables->eloquent($students)
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'examination.examinationresult';
                    $routeKey = 'examination.examinationresult';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                }) 
                  ->editColumn('remarks', function ($row) {
                    return $row->remarks ? strip_tags($row->remarks) : '';
                })
                  ->editColumn('classsection_id', function ($row) {
                    return $row->classsection_id ?  $row->classsections->name : '';
                })
                   ->editColumn('academicyear_student_id', function ($row) {
                    return $row->academicyear_student_id ?  $row->academicyearStudent->student_details : '';
                })
                
                   ->editColumn('examinationtype_id', function ($row) {
                    return $row->examinationtype_id ?  $row->examinationsType->name : '';
                })
                   ->editColumn('year_id', function ($row) {
                    return $row->year_id ?  $row->years->name : '';
                })
                   ->editColumn('semester_id', function ($row) {
                    return $row->semester_id ?  $row->semesters->name : '';
                })
                    ->editColumn('examination_nature', function ($row) {
                    return $row->examination_nature ?  $row->examinationNature->name : '';
                })
                    ->editColumn('subject_id', function ($row) {
                    return $row->subject_id ?  $row->subjects->name : '';
                })
                    ->editColumn('class_id', function ($row) {
                    return $row->class_id ?  $row->classes->name : '';
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
