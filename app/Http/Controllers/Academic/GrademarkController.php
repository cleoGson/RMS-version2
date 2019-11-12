<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Grademark;
use App\Model\Grade;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\GradeMarkRequest;

class GrademarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.grademarks.actions';
            return $dataTables->eloquent(Grademark::with(['creator','updator','grades'])->select('grademarks.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.grademark';
                    $routeKey = 'academic.grademark';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('grade_id', function ($row) {
                    return $row->grade_id ? $row->grades->name : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('academics.grademarks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades=Grade::pluck('name','id')->toArray();
        return view('academics.grademarks.create',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeMarkRequest $request)
    {
        $grademark = Grademark::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
            'grade_id'=>request('grade_id'), 
            'minimum_marks'=>request('minimum_marks'),
            'maximum_marks'=>request('maximum_marks'),
            'grade_point'=>request('grade_point'),
        ]);
        alert()->success('success', 'Grade Marks  has  successfully added.')->persistent();
        return redirect()->route('academic.grademark.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Grademark  $grademark
     * @return \Illuminate\Http\Response
     */
    public function show(Grademark $grademark)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Grademark  $grademark
     * @return \Illuminate\Http\Response
     */
    public function edit(Grademark $grademark)
    {
        $grades=Grade::pluck('name','id')->toArray();
        return view('academics.grademarks.edit',['show'=>$grademark,'grades'=>$grades]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Grademark  $grademark
     * @return \Illuminate\Http\Response
     */
    public function update(GradeMarkRequest $request, Grademark $grademark)
    {
        $grademark->updated_by = auth()->id();
        $grademark->update(request(['name','display_name','grade_id','minimum_marks','maximum_marks','grade_point']));
        alert()->success('success', 'Grade Marks  has  successfully Updated.')->persistent();
        return redirect()->route('academic.grademark.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Grademark  $grademark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grademark $grademark)
    {
        $grademark->delete();
        alert()->success('success', 'Grade Marks  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.grademark.index');
    }
}
