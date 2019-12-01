<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;

use App\Model\Level;
use Illuminate\Http\Request;
use  App\Http\Requests\Student\LevelRequest;
use Yajra\DataTables\DataTables;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'students.levels.actions';
            return $dataTables->eloquent(Level::with(['createdBy','updatedBy'])->select('levels.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'student.level';
                    $routeKey = 'student.level';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? $row->updatedBy->email : '';
                })
                ->make(true);
         }
         return view('students.levels.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelRequest $request)
    {
        $level = Level::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Education level  has  successfully added.')->persistent();
        return redirect()->route('student.level.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
      alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('students.levels.edit',['show'=>$level]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(LevelRequest $request, Level $level)
    {
        $level->updated_by = auth()->id();
        $level->update(request(['name','display_name']));
        alert()->success('success', 'Education level  has  successfully Updated.')->persistent();
        return redirect()->route('student.level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();
        alert()->success('success', 'Education level  has  successfully Deleted.')->persistent();
        return redirect()->route('student.level.index');
    }
}
