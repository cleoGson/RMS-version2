<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Gradecurricular;
use App\Model\Grademark;
use App\Model\Academicyear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\GradeCurricularRequest;

class GradecurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.gradecurricular.actions';
            return $dataTables->eloquent(Gradecurricular::with(['creator','updator','approvedBy','years'])->select('gradecurriculars.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.gradecurricular';
                    $routeKey = 'academic.gradecurricular';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                   ->addColumn('grade_mark', function ($row) {
               return $row->gradeCurricular->map(function ($gradMarks) {
                    return   ucfirst(strtoupper($gradMarks->grade_marks));
                        
             })->implode(', ');
               })
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Non Active';
                })
                ->editColumn('approved', function ($row) {
                    return $row->approved == 1 ? 'Active' : 'Non Active';
                })
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                   ->editColumn('approved_by', function ($row) {
                    return $row->approved_by ? $row->approvedBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('academics.gradecurricular.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gradeMarks =Grademark::pluck('name','id')->toArray(); 
        $academicYears=Academicyear::pluck('name','id')->toArray();
        $selectedGrades=[];
        return view('academics.gradecurricular.create',compact(['academicYears','gradeMarks','selectedGrades']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeCurricularRequest $request)
    {
        $gradecurricular = Gradecurricular::create([
            'name'=>request('name'),
            'created_by'=>auth()->id(),
            'year_id'=>request('year_id'), 
            'status'=>1,
            'approved'=>1,
            'approved_by'=>auth()->id(),
        ]);
        $grademarks_lists = $request->input('grademarks_id');
        $gradecurricular->gradeCurricular()->sync($grademarks_lists);
        alert()->success('success', 'Department  has  successfully added.')->persistent();
        return redirect()->route('academic.gradecurricular.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Gradecurricular  $gradecurricular
     * @return \Illuminate\Http\Response
     */
    public function show(Gradecurricular $gradecurricular)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Gradecurricular  $gradecurricular
     * @return \Illuminate\Http\Response
     */
    public function edit(Gradecurricular $gradecurricular)
    {
        $gradeMarks =Grademark::pluck('name','id')->toArray(); 
        $academicYears=Academicyear::pluck('name','id')->toArray();
        $selectedGrades=$gradecurricular->gradeCurricular->pluck('id')->toArray();
        return view('academics.gradecurricular.edit',
        ['show'=>$gradecurricular,
        'academicYears'=> $academicYears,
        'selectedGrades'=>$selectedGrades,
        'gradeMarks'=>$gradeMarks]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Gradecurricular  $gradecurricular
     * @return \Illuminate\Http\Response
     */
    public function update(GradeCurricularRequest $request, Gradecurricular $gradecurricular)
    {
        $gradecurricular->updated_by = auth()->id();
        $gradecurricular->update(request(['name','year_id']));
        $grademarks_lists = $request->input('grademarks_id');
        $gradecurricular->gradeCurricular()->sync($grademarks_lists);
        alert()->success('success', 'Department  has  successfully Updated.')->persistent();
        return redirect()->route('academic.gradecurricular.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Gradecurricular  $gradecurricular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gradecurricular $gradecurricular)
    {
        $gradecurricular->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.gradecurricular.index');
    }
}
