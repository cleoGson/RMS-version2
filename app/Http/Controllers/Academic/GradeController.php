<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Grade;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\GradeRequest;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.grades.actions';
            return $dataTables->eloquent(Grade::with(['creator','updator'])->select('grades.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.grade';
                    $routeKey = 'academic.grade';
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
         return view('academics.grades.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('academics.grades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRequest $request)
    {
        $grade = Grade::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
         
        ]);
        alert()->success('success', 'Grade  has  successfully added.')->persistent();
        return redirect()->route('academic.grade.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        return view('academics.grades.edit',['show'=>$grade]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(GradeRequest $request, Grade $grade)
    {
        $grade->updated_by = auth()->id();
        $grade->update(request(['name','display_name']));
        alert()->success('success', 'Grade  has  successfully Updated.')->persistent();
        return redirect()->route('academic.grade.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        alert()->success('success', 'Grade  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.grade.index');
    }
}
