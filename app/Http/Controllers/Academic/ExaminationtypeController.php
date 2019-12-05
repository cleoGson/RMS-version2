<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Examinationtype;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\ExaminationtypeRequest;

class ExaminationtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.examinations.types.actions';
            return $dataTables->eloquent(Examinationtype::with(['createdBy','updatedBy'])->select('examinationtypes.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.examinationtype';
                    $routeKey = 'academic.examinationtype';
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
         return view('academics.examinations.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academics.examinations.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExaminationtypeRequest $request)
    {
        $examinationtype = Examinationtype::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'fees  has  successfully added.')->persistent();
        return redirect()->route('academic.examinationtype.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Examinationtype  $examinationtype
     * @return \Illuminate\Http\Response
     */
    public function show(Examinationtype $examinationtype)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Examinationtype  $examinationtype
     * @return \Illuminate\Http\Response
     */
    public function edit(Examinationtype $examinationtype)
    {
         $show=$examinationtype;
         return view('academics.examinations.types.edit',compact(['show']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Examinationtype  $examinationtype
     * @return \Illuminate\Http\Response
     */
    public function update(ExaminationtypeRequest $request, Examinationtype $examinationtype)
    {
        $examinationtype->updated_by = auth()->id();
        $examinationtype->update(request(['name','display_name']));
        alert()->success('success', 'Examination type  has  successfully Updated.')->persistent();
        return redirect()->route('academic.examinationtype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Examinationtype  $examinationtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examinationtype $examinationtype)
    {
        $examinationtype->delete();
        alert()->success('success', 'Examination type  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.examinationtype.index');
    }
}
