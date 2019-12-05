<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Examinationcurricular;
use App\Model\Examinationmarks;
use App\Model\Academicyear;
use App\Model\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\ExaminationcurricularRequest;

class ExaminationcurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
     if (request()->wantsJson()) {
            $template = 'academics.examinations.curriculars.actions';
            return $dataTables->eloquent(Examinationcurricular::with(['createdBy','updatedBy','years'])->select('examinationcurriculars.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.examinationcurricular';
                    $routeKey = 'academic.examinationcurricular';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                  ->addColumn('examination_curricular', function ($row) {
               return $row->examinationCurriculars->map(function ($examinationCurricular) {
                    return 
                         
                        ucfirst(strtoupper($examinationCurricular->full_name));
                        
                })->implode(', ');
               })
                
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Non Active';
                })
                ->editColumn('approved', function ($row) {
                    return $row->approved == 1 ? 'Active' : 'Non Active';
                })
                 ->editColumn('approved_by', function ($row) {
                    return $row->approved_by  ? $row->approvedBy->email : "" ;
                })
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                ->make(true);
         }
         return view('academics.examinations.curriculars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exammarks =Examinationmarks::get()->pluck('full_name','id')->toArray(); 
        $years=Academicyear::pluck('name','id')->toArray();
        $semesters=Semester::pluck('name','id')->toArray();
        $selectedexammarks=[];
        return view('academics.examinations.curriculars.create',compact(['years','semesters','exammarks','selectedexammarks']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExaminationcurricularRequest $request)
    {
        $examinationcurricular = Examinationcurricular::create([
            'name'=>request('name'),
            'created_by'=>auth()->id(),
            'semester_id'=>request('semester_id'),
            'year_id'=>request('year_id'), 
            'status'=>1,
            'approved'=>1,
            'approved_by'=>auth()->id(),
        ]);
        $examination_curricular = $request->input('examinationmark_id');
        $examinationcurricular->examinationCurriculars()->sync($examination_curricular);
        alert()->success('success', 'Examination curricular  has  successfully added.')->persistent();
        return redirect()->route('academic.examinationcurricular.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Examinationcurricular  $examinationcurricular
     * @return \Illuminate\Http\Response
     */
    public function show(Examinationcurricular $examinationcurricular)
    {
      alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Examinationcurricular  $examinationcurricular
     * @return \Illuminate\Http\Response
     */
    public function edit(Examinationcurricular $examinationcurricular)
    {
        $exammarks =Examinationmarks::get()->pluck('full_name','id')->toArray(); 
        $years=Academicyear::pluck('name','id')->toArray();
        $semesters=Semester::pluck('name','id')->toArray();

        $selectedexammarks=$examinationcurricular->examinationCurriculars->pluck('id')->toArray();
        return view('academics.examinations.curriculars.edit',
        ['show'=>$examinationcurricular,
        'years'=> $years,
        'selectedexammarks'=>$selectedexammarks,
        'semesters'=>$semesters,
        'exammarks'=>$exammarks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Examinationcurricular  $examinationcurricular
     * @return \Illuminate\Http\Response
     */
    public function update(ExaminationcurricularRequest $request, Examinationcurricular $examinationcurricular)
    {
        $examinationcurricular->updated_by = auth()->id();
        $examinationcurricular->update(request(['name','semester_id', 'status', 'year_id']));
        $examination_curricular = $request->input('examinationmark_id');
        $examinationcurricular->examinationCurriculars()->sync($examination_curricular);
        alert()->success('success', 'Examinatiion curricular  has  successfully Updated.')->persistent();
        return redirect()->route('academic.examinationcurricular.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Examinationcurricular  $examinationcurricular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examinationcurricular $examinationcurricular)
    {
        $examinationcurricular->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.examinationcurricular.index');
    }
}
