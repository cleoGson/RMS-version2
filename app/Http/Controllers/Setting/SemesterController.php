<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\SemesterRequest;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.semesters.actions';
            return $dataTables->eloquent(Semester::with(['creator','updator'])->select('semesters.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.semester';
                    $routeKey = 'setting.semester';
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
         return view('settings.semesters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.semesters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemesterRequest $request)
    {
        $semester = Semester::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Semester  has  successfully added.')->persistent();
        return redirect()->route('setting.semester.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        return view('settings.semesters.edit',['show'=>$semester]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(SemesterRequest $request, Semester $semester)
    {
        $this->validate($request, [
            'name'=> 'required',
            'display_name'  => 'required',
        ]);
        $semester->updated_by = auth()->id();
        $semester->update(request(['name','display_name']));
        alert()->success('success', 'Semester  has  successfully Updated.')->persistent();
        return redirect()->route('setting.semester.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();
        alert()->success('success', 'Semester  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.semester.index');
    }
}
