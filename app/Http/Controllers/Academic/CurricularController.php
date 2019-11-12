<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Model\Curricular;
use App\Model\Semester;
use App\Model\Academicyear;
use App\Model\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\Academic\CurricularRequest;
class CurricularController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.curricular.actions';
            return $dataTables->eloquent(Curricular::with(['creator','updator'])->select('curriculars.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.curricular';
                    $routeKey = 'academic.curricular';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('academics.curricular.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::pluck('name','id')->toArray();
        $years=Academicyear::pluck('name','id')->toArray();
        $semesters=Semester::pluck('name','id')->toArray();
        return view('academics.curricular.create',compact(['years','semesters','subjects']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurricularRequest $request)
    {
       $curricular = Curricular::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'year_id'=>request('year_id'),
            'semester_id'=>request('semester_id'),
            'status'=>1,
            'created_by'=>auth()->id(),
        ]);
        $subjects_lists = $request->input('subjects_id');
        $curricular->curricularSubjects()->sync($subjects_lists);
        alert()->success('success', 'Curriculum  has  successfully added.')->persistent();
        return redirect()->route('academic.curricular.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function show(Curricular $curricular)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function edit(Curricular $curricular)
    {
        $subjects = Subject::pluck('name','id')->toArray();
        $years=Academicyear::pluck('name','id')->toArray();
        $semesters=Semester::pluck('name','id')->toArray();
        return view('academics.curricular.edit',
        ['show'=>$curricular,
        'years'=>$years,
        'semesters'=>$semesters,
        'subjects'=>$subjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function update(CurricularRequest $request, Curricular $curricular)
    {
        $curricular->updated_by = auth()->id();
        $curricular->update(request(['name','display_name','semester_id','year_id','status']));
        $subjects_lists = $request->input('subjects_id');
        $curricular->curricularSubjects()->sync($subjects_lists);
        alert()->success('success', 'Curriculum  has  successfully Updated.')->persistent();
        return redirect()->route('academic.curricular.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curricular $curricular)
    {
       $curricular->delete();
        alert()->success('success', 'Curriculum  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.curricular.index');
    }
}
