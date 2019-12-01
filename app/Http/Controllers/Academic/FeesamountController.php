<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Feesamount;
use App\Model\Fees;
use App\Model\Academicyear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\FeesamountRequest;

class FeesamountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.feesamounts.actions';
            return $dataTables->eloquent(Feesamount::with(['createdBy','updatedBy','fees','years','approvedBy'])->select('feesamounts.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.feesamount';
                    $routeKey = 'academic.feesamount';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('fees_id', function ($row) {
                    return $row->fees_id ? $row->fees->name : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                 ->editColumn('year_id', function ($row) {
                    return $row->year_id ? $row->years->name : '';
                })
                  ->editColumn('status', function ($row) {
                    return $row->status == 1 ? "Active" : 'Not Active';
                })
                  ->editColumn('approved', function ($row) {
                    return $row->approved == 1 ? "Approved" : 'Not Approved';
                })
                  ->editColumn('approved_by', function ($row) {
                    return $row->approved_by ? $row->approvedBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                ->make(true);
         }
         return view('academics.feesamounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $fees =Fees::pluck('name','id')->toArray(); 
         $academicYears=Academicyear::pluck('name','id')->toArray();
        return view('academics.feesamounts.create',compact(['fees','academicYears']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeesamountRequest $request)
    {
        $feesamount = Feesamount::create([
            'amount'=>request('amount'),
            'fees_id'=>request('fees_id'),
            'created_by'=>auth()->id(),
            'year_id'=>request('year_id'), 
            'status'=>1,
            'approved'=>1,
            'approved_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Fees amount  has  successfully added.')->persistent();
        return redirect()->route('academic.feesamount.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Feesamount  $feesamount
     * @return \Illuminate\Http\Response
     */
    public function show(Feesamount $feesamount)
    {
         alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Feesamount  $feesamount
     * @return \Illuminate\Http\Response
     */
    public function edit(Feesamount $feesamount)
    {
         $fees =Fees::pluck('name','id')->toArray(); 
         $academicYears=Academicyear::pluck('name','id')->toArray();
         $show=$feesamount;
        return view('academics.feesamounts.edit',compact(['fees','academicYears','show']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Feesamount  $feesamount
     * @return \Illuminate\Http\Response
     */
    public function update(FeesamountRequest $request, Feesamount $feesamount)
    {
        $feesamount->updated_by = auth()->id();
        $feesamount->update(request(['amount','fees_id','year_id','status']));
        alert()->success('success', 'Fees amount  has  successfully Updated.')->persistent();
        return redirect()->route('academic.feesamount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Feesamount  $feesamount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feesamount $feesamount)
    {
       $feesamount->delete();
        alert()->success('success', 'Fees amount  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.feesamount.index');
    }
}
