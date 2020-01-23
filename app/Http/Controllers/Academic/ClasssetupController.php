<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Classsetup;
use App\Model\Gradecurricular;
use App\Model\Feesstructure;
use App\Model\Curricular;
use App\Model\Academicyear;
use App\Model\Classroom;
use App\Model\Examinationcurricular;
use App\Exports\ClassSetup as ClassExportCurricular;
use App\Model\Gpacurricular;
use App\Model\Classsection;
use Excel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\ClasssetupRequest;

class ClasssetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {   
        if (request()->wantsJson()) {
            $template = 'academics.classsetups.actions';
            return $dataTables->eloquent(Classsetup::with(['creator','updator','classes','years','gpa','gradings'])->select('classsetups.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.classsetup';
                    $routeKey = 'academic.classsetup';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->addColumn('subject_curricular', function ($row) {
                return $row->subjectCurriculars->map(function ($curricularsubject) {
                    return
                        ucfirst(strtoupper($curricularsubject->name));
                        
             })->implode(', '); })
                ->addColumn('examination_curricular', function ($row) {
                return $row->examinationCurriculars->map(function ($examcurricular) {
                    return
                        ucfirst(strtoupper($examcurricular->name));
                        
             })->implode(', '); })
               ->addColumn('grade_curricular', function ($row) {
               return $row->gradings->gradeCurricular->map(function ($grade) {
                    return 
                         
                        ucfirst(strtoupper($grade->name));
                        
             })->implode(', ');
               })     
                 ->addColumn('gpa_curricular', function ($row) {
               return $row->gpa->gpaCurricular->map(function ($gpac) {
                    return 
                         
                        ucfirst(strtoupper($gpac->gpa_name));
                    
             })->implode(', ');
               })     
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                 ->editColumn('result_system', function ($row) {
                    return $row->result_system ==2 ? 'percentage' : 'Non-percentage';
                })
                  ->editColumn('status', function ($row) {
                    return $row->status ==1 ? 'active' : 'Non-active';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('academics.classsetups.index');
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
        $examcurriculars=Examinationcurricular::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $grades=Gradecurricular::pluck('name','id')->toArray();
        $curricular=Curricular::pluck('name','id')->toArray();
        $feesstructure=Feesstructure::pluck('name','id')->toArray();
        $gpa_curricular=Gpacurricular::pluck('name','id')->toArray();
        $selectedexamcurr=[];
        $selectedsubjectcurr=[];
        return view('academics.classsetups.create',compact(['years',
        'classsections','classes','grades','curricular',
        'selectedexamcurr','selectedsubjectcurr',
        'feesstructure','examcurriculars','gpa_curricular']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasssetupRequest $request)
    {
    
        $classsetup = Classsetup::create([
            'name'=>request('name'),
            'class_id'=>request('class_id'),
            'year_id'=>request('year_id'),
            'grade_curricular'=>request('grade_curricular'),
            'minimum_capacity'=>request('minimum_capacity'),
            'maximum_capacity'=>request('maximum_capacity'),
            'fees_structure'=>request('fees_structure'),
            'result_system'=>request('result_system'),
            'gpa_applicable'=>request('gpa_applicable'),
            'gpa_curricular'=>request('gpa_curricular'),
            'approved_by'=>auth()->id(),
            'created_by'=>auth()->id(),
        ]);
        $subjects = request('subject_curricular');
        $examinations = request('examination_curricular');
        $classsetup->subjectCurriculars()->sync($subjects);
        $classsetup->examinationCurriculars()->sync($examinations);
        alert()->success('success', 'classsetup  has  successfully added.')->persistent();
        return redirect()->route('academic.classsetup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Classsetup  $classsetup
     * @return \Illuminate\Http\Response
     */
    public function show(Classsetup $classsetup)
    {
        $show=$classsetup;
        return view('academics.classsetups.show',compact(['show']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Classsetup  $classsetup
     * @return \Illuminate\Http\Response
     */
    public function edit(Classsetup $classsetup)
    {
        $years=Academicyear::pluck('name','id')->toArray();
        $examcurriculars=Examinationcurricular::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $grades=Gradecurricular::pluck('name','id')->toArray();
        $curricular=Curricular::pluck('name','id')->toArray();
        $feesstructure=Feesstructure::pluck('name','id')->toArray();
        $selectedexamcurr=$classsetup->subjectCurriculars->pluck('id')->toArray();
        $gpa_curricular=Gpacurricular::pluck('name','id')->toArray();
        $selectedsubjectcurr=$classsetup->examinationCurriculars->pluck('id')->toArray();
        return view('academics.classsetups.edit',[
            'show'=>$classsetup,
            'years'=>$years,
            'examcurriculars'=>$examcurriculars,
            'classes'=>$classes,
            'grades'=>$grades,
            'curricular'=>$curricular,
            'selectedexamcurr'=>$selectedexamcurr,
            'selectedsubjectcurr'=> $selectedsubjectcurr,
            'gpa_curricular'=>$gpa_curricular,
            'feesstructure'=>$feesstructure
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Classsetup  $classsetup
     * @return \Illuminate\Http\Response
     */
    public function update(ClasssetupRequest $request, Classsetup $classsetup)
    {
        $classsetup->updated_by = auth()->id();
        $subjects=request('subject_curricular');
        $examinatios = request('examination_curricular');
        $classsetup->update(request([
              'name',
              'class_id',
              'grade_curricular',
              'fees_structure',
              'minimum_capacity',
              'maximum_capacity',
              'gpa_curricular',
              'result_system',
              'gpa_applicable',
              'year_id',
            ]));
        $classsetup->subjectCurriculars()->sync($subjects);
        $classsetup->examinationCurriculars()->sync($examinatios);
        alert()->success('success', 'classsetup  has  successfully Updated.')->persistent();
        return redirect()->route('academic.classsetup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Classsetup  $classsetup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classsetup $classsetup)
    {
       $classsetup->delete();
        alert()->success('success', 'classsetup  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.classsetup.index');
    }

    /**
     * download the specified resource from storage.
     *
     * @param  \App\Model\Classsetup  $classsetup
     * @return \Illuminate\Http\Response
     */
    public function downloadCurriculum(Classsetup $classsetup){
            $show=$classsetup;
             return Excel::download(new ClassExportCurricular($show), 'curriculumn.pdf');
    }
}
