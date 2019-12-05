<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Feesstructure;
use App\Model\Feesamount;
use App\Model\Academicyear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\FeesstructureRequest;

class FeesstructureController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.feesstructure.actions';
            return $dataTables->eloquent(Feesstructure::with(['createdBy','updatedBy','years'])->select('feesstructures.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.feesstructure';
                    $routeKey = 'academic.feesstructure';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Non Active';
                })
                ->addColumn('feesamount_id', function ($row) {
               return $row->feesStructures->map(function ($feestructure) {
                    return ucfirst(strtoupper($feestructure->fee_name));
                        
             })->implode(', ');
               })
                ->editColumn('approved', function ($row) {
                    return $row->approved == 1 ? 'Active' : 'Non Active';
                })
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                   ->editColumn('approved_by', function ($row) {
                    return $row->approved_by ? $row->approvedBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                ->make(true);
         }
         return view('academics.feesstructure.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feesamounts = Feesamount::get()->pluck('fee_name','id')->toArray();
        $years=Academicyear::pluck('name','id')->toArray();
        $feesselected=[];
        return view('academics.feesstructure.create',compact(['years','feesamounts','feesselected']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeesstructureRequest $request)
    {
        $feesstructure = Feesstructure::create([
            'name'=>request('name'),
            'created_by'=>auth()->id(),
            'year_id'=>request('year_id'), 
            'status'=>1,
            'approved'=>1,
            'approved_by'=>auth()->id(),
        ]);
        $feeamount_lists = $request->input('feeamount_id');
        $feesstructure->feesStructures()->sync($feeamount_lists);
        alert()->success('success', 'Department  has  successfully added.')->persistent();
        return redirect()->route('academic.feesstructure.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Feesstructure  $feesstructure
     * @return \Illuminate\Http\Response
     */
    public function show(Feesstructure $feesstructure)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Feesstructure  $feesstructure
     * @return \Illuminate\Http\Response
     */
    public function edit(Feesstructure $feesstructure)
    {
       $feesamounts = Feesamount::get()->pluck('fee_name','id')->toArray();
        $years=Academicyear::pluck('name','id')->toArray();
        $feesselected=$feesstructure->feesStructures->pluck('id')->toArray();
        return view('academics.feesstructure.edit',
        ['show'=>$feesstructure,
        'years'=>$years,
        'feesamounts'=>$feesamounts,
        'feesselected'=>$feesselected
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Feesstructure  $feesstructure
     * @return \Illuminate\Http\Response
     */
    public function update(FeesstructureRequest $request, Feesstructure $feesstructure)
    {
        $feesstructure->updated_by = auth()->id();
        $feesstructure->update(request(['name','semester_id','year_id','status']));
        $feeamount_lists = $request->input('feeamount_id');
        $feesstructure->feesStructures()->sync($feeamount_lists);
        alert()->success('success', 'Fee Stucture  has  successfully Updated.')->persistent();
        return redirect()->route('academic.feesstructure.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Feesstructure  $feesstructure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feesstructure $feesstructure)
    {
        $feesstructure->delete();
        alert()->success('success', 'Curriculum  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.feesstructure.index');
    }
}
