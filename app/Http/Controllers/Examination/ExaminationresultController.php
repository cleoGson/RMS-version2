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
use App\Model\Curricular;
use App\Model\Feesstructure;
use App\Model\Examinationnature;
use App\Model\Classsetup;
use App\Http\Requests\Examination\ExaminationresultRequest;
use DB;
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
            return $dataTables->eloquent(Examinationresult::with(['createdBy','updatedBy','classes','classsections','years','gradings','curricular'])->select('examinationresults.*'))
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
         return view('examinations.results.index',compact(['years','classsections','classes','classsetups','semesters',]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
         $years=Academicyear::pluck('name','id')->toArray();
         $classsections=Classsection::pluck('name','id')->toArray();
         $classes=Classroom::pluck('name','id')->toArray();
         $grades=Gradecurricular::pluck('name','id')->toArray();
         $curricular=Curricular::pluck('name','id')->toArray();
         $feesstructure=Feesstructure::pluck('name','id')->toArray();
         $nature=Examinationnature::pluck('name','id')->toArray();
        $semesters=Semester::pluck('name','id')->toArray();
         $classsetups=Classsetup::pluck('name','id')->toArray();
         return view('examinations.results.create',compact(['semesters','classsetups','years','classsections','classes','grades','curricular','feesstructure'])); 
    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExaminationresultRequest $request)
    {
        $examinationresult = examinationresult::create([
         'classsection_id'=>request('classsection_id'),
         'examination_nature'=>request('examination_nature'),
         'student_id'=>request('student_id'),
         'academicyear_student_id'=>request('academicyear_student_id'),
         'examinationtype_id'=>request('examinationtype_id'),
         'semester_id'=>request('semester_id'),
         'year_id'=>request('year_id'),
         'subject_id'=>request('subject_id'),
         'marks'=>request('marks'),
         'remarks'=>request('remarks'),
         'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'examinationresult  has  successfully added.')->persistent();
        return redirect()->route('examination.examinationresult.index');
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

   public function getSubjects($id) 
    {
       if(is_null($id)){
         return json_encode($id);
          }
        $setup_data=Classsetup::findOrFail($id);
        $semisters=$setup_data->subjectCurriculars->pluck('semester_id','id')->toArray();
        $exam_curricular_id=(!is_null($semisters) & in_array(1,$semisters)) ? $semisters[1] :null;
        if(!is_null($exam_curricular_id)){
        $subjectCurricular=Curricular::findOrFail($exam_curricular_id);
        $subjects=$subjectCurricular->curricularSubjects->pluck('name','id')->toArray();
        return json_encode($subjects);
        }
        return json_encode($exam_curricular_id);
    }

     public function getExaminations($id) 
    {
        if(is_null($id)){
         return json_encode($id);
          }
         $setup_data=Classsetup::findOrFail($id);
         $semisters=$setup_data->examinationCurriculars->pluck('semester_id','id')->toArray();
         $exam_curricular_id=(!is_null($semisters) & in_array(1,$semisters)) ? $semisters[1] :null;
         if(!is_null($exam_curricular_id)){
         $examinations=Examinationcurricular::findOrFail($exam_curricular_id);
         $examinationtype=$examinations->examinationCurriculars->pluck('full_name','examinationtype_id')->toArray();
         return json_encode($examinationtype);
         }
         return json_encode($exam_curricular_id);
    }
}
