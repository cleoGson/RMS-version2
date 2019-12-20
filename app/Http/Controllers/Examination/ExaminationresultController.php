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

use App\Http\Requests\Examination\ExaminationresultRequest;
use DB;
use Crypt;
use App\Model\Semester;

use App\Http\Requests\Examination\EventRequest;

class ExaminationresultController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {   
        if (request()->wantsJson()) {
            $template = 'examinations.results.actions';
            return $dataTables->eloquent(Examinationresult::with(['createdBy','updatedBy','classsections','years'])->select('examinationresults.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'examination.examinationresult';
                    $routeKey = 'examination.examinationresult';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
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
         $classsections=Classsection::pluck('name','id')->toArray();
         $classes=Classroom::pluck('name','id')->toArray();
         $classsetups=Classsetup::pluck('name','id')->toArray();
         $semesters=Semester::pluck('name','id')->toArray();
         return view('examinations.results.index',compact(['years','classsections','classes','classsetups',
         'semesters']));
    }

    public function individualResult(DataTables $dataTables, Request $request){

         $classes=Classroom::pluck('name','id')->toArray();
          $years=Academicyear::pluck('name','id')->toArray();
          foreach($classes as $key=>$value){
            $student_data=AcademicyearStudent::with(['student'])->where([['class_id','=',$key],['year_id','=',1]]);
           $studentsprovider[$key]=array('students'=>$student_data->get(),
                                    'number_student'=>$student_data->count(),
                                    'year'=>2019,
                                    'class_id'=>$key,
                                    'class_name'=>$value,
                                    'year_id'=>1,
                                    'classsetup_name'=>!is_null($student_data->first()) ? $student_data->first()->classSetup->name : "",
                                    'classsetup_id'=>!is_null($student_data->first()) ? $student_data->first()->classSetup->id : 0,

                                    
                                );
          }
     return view('examinations.results.individual',compact(['studentsprovider','years'])); 

    }

    public function classDetails(Datatables $dataTables,$class_id,$classsetup_id,$year_id){

              $classid=$class_id;
              $classsetupid=$classsetup_id;
              $yearid=$year_id;
              $classsetup=Classsetup::findOrFail($classsetupid);
              $class =Classroom::findOrFail($classid);
              $years=Academicyear::findOrFail($yearid);
               $classsections=Classsection::pluck('name','id')->toArray();
              $data=Examinationresult::with(['classsections','examinationsType','academicyearStudent','years','examinationNature','semesters','subjects','classes'])->where([['class_id','=',$classid],['year_id','=',$yearid]]);
              if (request()->wantsJson()) {
               $template = 'examinations.results.actions';
                 return $dataTables->eloquent($data->select('examinationresults.*'))
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
              $semesters=Semester::pluck('name','id')->toArray();
              $students =  $student_data=AcademicyearStudent::with('student')->where([['class_id','=',$classid],['year_id','=',$yearid]])->get()->pluck('student_details','id')->toArray();
             return view('examinations.results.posting',compact(['classsetup','class','years','classsections','semesters','students']));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DataTables $dataTables,Request $request)
    {
           if (request()->wantsJson()) {
            $template = 'students.academicyearStudents.actionsreg';
            $query=AcademicyearStudent::with(['createdBy','createdBy','years','studentStatus','class','classSetup','classSection']);
            if ($request->class_id) {
                $query = $query->whereClassId($request->class_id);
            }
            if ($request->year_id) {
                $query = $query->whereYearId($request->year_id);
            }
             if ($request->classsetup_id) {
                $query = $query->whereClasssetupId($request->classsetup_id);
            }
            return $dataTables->eloquent($query->select('academicyear_students.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'student.academicyearStudent';
                    $routeKey = 'student.academicyearStudent';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
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
     
          if(!is_null($request->class_id) && !is_null($request->classsection_id) && !is_null($request->semester_id) && !is_null($request->classsetup_id)){
        $this->validate($request,[
            'class_id'=>'required|exists:classrooms,id',
            'classsection_id'=>'required|exists:classsections,id',
            'semester_id'=>'required|exists:semesters,id',
            'classsetup_id'=>'required|exists:classsetups,id',
            'year_id'=>'required|exists:academicyears,id',
         ]);
        }
            $examinations=null;
            $subjects=null;
                if(!is_null($request->classsetup_id) && !is_null($request->semester_id)){
                 $examinations=$this->getSubjects($request->classsetup_id,$request->semester_id);
                 $subjects =$this->getExaminations($request->classsetup_id,$request->semester_id);
              }
              
         $years=Academicyear::pluck('name','id')->toArray();
         $classsections=Classsection::pluck('name','id')->toArray();
         $classes=Classroom::pluck('name','id')->toArray();
         $grades=Gradecurricular::pluck('name','id')->toArray();
         $curricular=Curricular::pluck('name','id')->toArray();
         $feesstructure=Feesstructure::pluck('name','id')->toArray();
         $nature=Examinationnature::pluck('name','id')->toArray();
         $semesters=Semester::pluck('name','id')->toArray();
         $classsetups=Classsetup::pluck('name','id')->toArray();
         return view('examinations.results.create',compact(['semesters','classsetups','years','classsections','classes','grades','curricular','feesstructure','examinations','subjects'])); 
    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $this->validate($request, [
            'student_id' => 'required|numeric|exists:academicyear_students,id',
            'examination_type'=>'required|integer|exists:examinationtypes,id',
            'classsetup_id'=>'required|integer|exists:classsetups,id',
            'semester_id' => 'required|numeric|exists:semesters,id',
            'subject'=>['required','integer','exists:subjects,id',new ResultPostingRule($request->semester_id,$request->class_id,$request->student_id,$request->examination_type,"Oops Sorry Your can not upload the Results for same student twice")],
            'marks' => ['required', 'string',new MarksvalidatorRule($request->semester_id,$request->classsetup_id,$request->examination_type,"marks must be less or equal to:")],
            'remarks'=>'nullable|string'
        ]);
        $data=[
         'examination_nature'=>1,
         'academicyear_student_id'=>request('student_id'),
         'examinationtype_id'=>request('examination_type'),
         'semester_id'=>request('semester_id'),
         'class_id'=>request('class_id'),
         'year_id'=>request('year_id'),
         'subject_id'=>request('subject'),
         'marks'=>request('marks'),
         'remarks'=>request('remarks'),
         'created_by'=>auth()->id(),
        ];
        $examinationresult = Examinationresult::create($data);
        alert()->success('success', 'examinationresult  has  successfully added.')->persistent();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function show(Examinationresult $examinationresult)
    {
     alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function edit(Examinationresult $examinationresult)
    {
      $years=Academicyear::pluck('name','id')->toArray();
        $classsections=Classsection::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $grades=Gradecurricular::pluck('name','id')->toArray();
        $curricular=Curricular::pluck('name','id')->toArray();
        $feesstructure=Feesstructure::pluck('name','id')->toArray();
        $nature=Examinationnature::pluck('name','id')->toArray();
        return view('examinations.results.edit',[
            'show'=>$examinationresult,
            'years'=>$years,
            'classsections'=>$classsections,
            'classes'=>$classes,
            'grades'=>$grades,
            'curricular'=>$curricular,
            'feesstructure'=>$feesstructure
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function update(ExaminationresultRequest $request, Examinationresult $examinationresult)
    {
        
        $examinationresult->updated_by = auth()->id();

        $examinationresult->update(request([
              'name',
              'class_id',
              'classsection_id',
              'grade_curricular',
              'minimum_capacity',
              'maximum_capacity',
              'examination_nature',
              'curricular_id',
              'feesstructure_id',
              'year_id',
            ]));
        alert()->success('success', 'Examination result  has  successfully Updated.')->persistent();
        return redirect()->route('examination.examinationresult.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examinationresult $examinationresult)
    {
        $examinationresult->delete();
        alert()->success('success', 'examinationresult  has  successfully Deleted.')->persistent();
        return redirect()->route('examination.examinationresult.index');
    }

    public function dependantData($semester,$classsetup){
               $data =array(
                   'examination'=>$this->getExaminations($classsetup,$semester),
                   'subjects'=>$this->getSubjects($classsetup,$semester),
               );
               return $data;         
    }

   public function getSubjects($id,$id2) 
    {
       if(is_null($id )|| is_null($id2)){
         return null;
          }
        $setup_data=Classsetup::findOrFail($id);
        $semisters=$setup_data->subjectCurriculars->pluck('semester_id','id')->toArray();
        $exam_curricular_id=(!is_null($semisters) & in_array($id2,$semisters)) ? $semisters[$id2] :null;
        if(!is_null($exam_curricular_id)){
        $subjectCurricular=Curricular::findOrFail($exam_curricular_id);
        $subjects=$subjectCurricular->curricularSubjects->pluck('name','id')->toArray();
        return $subjects;
        }
        return null;
    }

     public function getExaminations($id,$id2) 
    {
       
        if(is_null($id) || is_null($id2)){
         return  null;
          }
         $setup_data=Classsetup::findOrFail($id);
         $semisters=$setup_data->examinationCurriculars->pluck('semester_id','id')->toArray();
         $exam_curricular_id=(!is_null($semisters) & in_array($id2,$semisters)) ? $semisters[$id2] :null;
         if(!is_null($exam_curricular_id)){
         $examinations=Examinationcurricular::findOrFail($exam_curricular_id);
         $examinationtype=$examinations->examinationCurriculars->pluck('full_name','examinationtype_id')->toArray();
         return $examinationtype;
         }
         return null;

    }

}
