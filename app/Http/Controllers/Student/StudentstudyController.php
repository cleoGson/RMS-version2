<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentstudyRequest;
use App\Model\Studentstudy;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentstudyController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'students.statuses.actions';
            return $dataTables->eloquent(Studentstatus::with(['creator','updator'])->select('studentstatuses.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'student.studentstatus';
                    $routeKey = 'student.studentstatus';
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
         return view('students.statuses.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentstatus = Studentstatus::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Student status  has  successfully added.')->persistent();
        return redirect()->route('student.studentstatus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Studentstudy  $studentstudy
     * @return \Illuminate\Http\Response
     */
    public function show(Studentstudy $studentstudy)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Studentstudy  $studentstudy
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentstudy $studentstudy)
    {
        return view('students.statuses.edit',['show'=>$studentstatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Studentstudy  $studentstudy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentstudy $studentstudy)
    {
        $studentstatus->updated_by = auth()->id();
        $studentstatus->update(request(['name','display_name']));
        alert()->success('success', 'Student status  has  successfully Updated.')->persistent();
        return redirect()->route('student.studentstatus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Studentstudy  $studentstudy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentstudy $studentstudy)
    {
        $studentstatus->delete();
        alert()->success('success', 'Student status  has  successfully Deleted.')->persistent();
        return redirect()->route('student.studentstatus.index');
    }
}
