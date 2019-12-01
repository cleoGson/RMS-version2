<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;

use App\Model\Course;
use Illuminate\Http\Request;
use  App\Http\Requests\Student\CourseRequest;
use App\Model\Level;
use App\Model\Department;
use App\Model\Durationunit;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'students.courses.actions';
            return $dataTables->eloquent(course::with(['createdBy','updatedBy','levels','departments','durationunits'])->select('courses.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'student.course';
                    $routeKey = 'student.course';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('description', function ($row) {
                    return $row->description ? strip_tags($row->description) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                  ->editColumn('department_id', function ($row) {
                    return $row->department_id ? $row->departments->name : '';
                })
                   ->editColumn('duration_unit', function ($row) {
                    return $row->duration_unit ? $row->durationunits->name : '';
                })
                ->editColumn('level_id', function ($row) {
                    return $row->level_id ? ucfirst(strtolower($row->levels->name)) : '';
                })
                ->make(true);
         }
         return view('students.courses.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('name','id')->toArray();
        $levels =Level::pluck('name','id')->toArray();
        $durationunits =Durationunit::pluck('name','id')->toArray();
        return view('students.courses.create',compact(['departments','levels','durationunits']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = course::create([
       'duration'=>request('duration'),
       'description'=>request('description'),
       'department_id'=>request('department_id'),
       'duration_unit'=>request('duration_unit'),
       'level_id'=>request('level_id'),
       'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Course status  has  successfully added.')->persistent();
        return redirect()->route('student.course.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
      alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
         $departments = Department::pluck('name','id')->toArray();
         $levels =Level::pluck('name','id')->toArray();
         $show=$course;
         $durationunits =Durationunit::pluck('name','id')->toArray();
        return view('students.courses.edit',compact(['departments','levels','show','durationunits']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $course->updated_by = auth()->id();
        $course->update(request(['duration','description','department_id','duration_unit','level_id']));
        alert()->success('success', 'Course status  has  successfully Updated.')->persistent();
        return redirect()->route('student.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
          $course->delete();
        alert()->success('success', 'Course status  has  successfully Deleted.')->persistent();
        return redirect()->route('student.course.index');
    }
}
