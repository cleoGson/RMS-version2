<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Examinationmarks;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Model\Examinationtype;
use App\Http\Requests\Academic\ExaminationmarksRequest;

class ExaminationmarksController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.examinations.marks.actions';
            return $dataTables->eloquent(Examinationmarks::with(['updatedBy','createdBy','types'])->select('examinationmarks.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.examinationmarks';
                    $routeKey = 'academic.examinationmarks';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('examinationtype_id', function ($row) {
                    return $row->examinationtype_id ? $row->types->name : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->updatedBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->createdBy->email)) : '';
                })
                ->make(true);
         }
         return view('academics.examinations.marks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=Examinationtype::pluck('name','id')->toArray();
        return view('academics.examinations.marks.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExaminationmarksRequest $request)
    {
        $examinationmarks = Examinationmarks::create([
            'created_by'=>auth()->id(),
            'examinationtype_id'=>request('examinationtype_id'), 
            'marks'=>request('marks'),
            'out_of'=>request('out_of')
        ]);
        alert()->success('success', 'Examination Marks  has  successfully added.')->persistent();
        return redirect()->route('academic.examinationmarks.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Examinationmarks  $examinationmarks
     * @return \Illuminate\Http\Response
     */
    public function show(Examinationmarks $examinationmarks)
    {
       alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Examinationmarks  $examinationmarks
     * @return \Illuminate\Http\Response
     */
    public function edit(Examinationmarks $examinationmarks)
    {
        $types=Examinationtype::pluck('name','id')->toArray();
        return view('academics.examinations.marks.edit',['show'=>$examinationmarks,'types'=>$types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Examinationmarks  $examinationmarks
     * @return \Illuminate\Http\Response
     */
    public function update(ExaminationmarksRequest $request, Examinationmarks $examinationmarks)
    {
        dd($examinationmarks);
        $examinationmarks->updated_by = auth()->id();
        $examinationmarks->update(request([
         'examinationtype_id',
         'marks',
         'out_of']));
        alert()->success('success', 'Examination Marks  has  successfully Updated.')->persistent();
        return redirect()->route('academic.examinationmarks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Examinationmarks  $examinationmarks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examinationmarks $examinationmarks)
    {
        $examinationmarks->delete();
        alert()->success('success', 'Examination Marks  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.examinationmarks.index');
    }
}
