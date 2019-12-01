<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;

use App\Model\Durationunit;
use Illuminate\Http\Request;
use  App\Http\Requests\Student\DurationunitRequest;
use Yajra\DataTables\DataTables;

class DurationunitController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'students.durationunits.actions';
            return $dataTables->eloquent(Durationunit::with(['createdBy','updatedBy'])->select('durationunits.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'student.durationunit';
                    $routeKey = 'student.durationunit';
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
         return view('students.durationunits.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.durationunits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DurationunitRequest $request)
    {
        $durationunit = Durationunit::create([
            'name'=>request('name'),
            'range_from'=>request('range_from'),
            'out_of'=>request('out_of'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Duration unit  has  successfully added.')->persistent();
        return redirect()->route('student.durationunit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Durationunit  $durationunit
     * @return \Illuminate\Http\Response
     */
    public function show(Durationunit $durationunit)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Durationunit  $durationunit
     * @return \Illuminate\Http\Response
     */
    public function edit(Durationunit $durationunit)
    {
       return view('students.durationunits.edit',['show'=>$durationunit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Durationunit  $durationunit
     * @return \Illuminate\Http\Response
     */
    public function update(DurationunitRequest $request, Durationunit $durationunit)
    {
        $durationunit->updated_by = auth()->id();
        $durationunit->update(request(['name','display_name','range_from',
        'out_of']));
        alert()->success('success', 'Duration unit  has  successfully Updated.')->persistent();
        return redirect()->route('student.durationunit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Durationunit  $durationunit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Durationunit $durationunit)
    {
        $durationunit->delete();
        alert()->success('success', 'Duration unit  has  successfully Deleted.')->persistent();
        return redirect()->route('student.durationunit.index');
    }
}
