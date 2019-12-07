<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Examinationnature;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\ExaminationnatureRequest;

class ExaminationnatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.examinations.natures.actions';
            return $dataTables->eloquent(Examinationnature::with(['createdBy','updatedBy'])->select('examinationnatures.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.examinationnature';
                    $routeKey = 'academic.examinationnature';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                ->make(true);
         }
         return view('academics.examinations.natures.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academics.examinations.natures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExaminationnatureRequest $request)
    {
        $examinationnature = Examinationnature::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'fees  has  successfully added.')->persistent();
        return redirect()->route('academic.examinationnature.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Examinationnature  $examinationnature
     * @return \Illuminate\Http\Response
     */
    public function show(Examinationnature $examinationnature)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Examinationnature  $examinationnature
     * @return \Illuminate\Http\Response
     */
    public function edit(Examinationnature $examinationnature)
    {
         $show=$examinationnature;
         return view('academics.examinations.natures.edit',compact(['show']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Examinationnature  $examinationnature
     * @return \Illuminate\Http\Response
     */
    public function update(ExaminationnatureRequest $request, Examinationnature $examinationnature)
    {
        $examinationnature->updated_by = auth()->id();
        $examinationnature->update(request(['name','display_name']));
        alert()->success('success', 'Examination type  has  successfully Updated.')->persistent();
        return redirect()->route('academic.examinationnature.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Examinationnature  $examinationnature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examinationnature $examinationnature)
    {
        $examinationnature->delete();
        alert()->success('success', 'Examination type  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.examinationnature.index');
    }
}

