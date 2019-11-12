<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Model\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\SubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.subjects.actions';
            return $dataTables->eloquent(Subject::with(['creator','updator'])->select('subjects.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.subject';
                    $routeKey = 'academic.subject';
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
         return view('academics.subjects.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academics.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $subject = Subject::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Subject  has  successfully added.')->persistent();
        return redirect()->route('academic.subject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
     return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('academics.subjects.edit',['show'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->updated_by=auth()->id();
        $subject->update(request(['name','display_name']));
        alert()->success('success', 'Subject  has  successfully Updated.')->persistent();
        return redirect()->route('academic.subject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        alert()->success('success', 'Subject  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.subject.index');
    }
}
