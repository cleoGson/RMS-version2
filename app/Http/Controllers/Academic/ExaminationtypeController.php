<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Examinationtype;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\EventRequest;

class ExaminationtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.fees.actions';
            return $dataTables->eloquent(Fees::with(['createdBy','updatedBy'])->select('fees.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.fees';
                    $routeKey = 'academic.fees';
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
         return view('academics.fees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academics.fees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeesRequest $request)
    {
        $fees = Fees::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'fees  has  successfully added.')->persistent();
        return redirect()->route('academic.fees.index');
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
         $fees =Fees::pluck('name','id')->toArray(); 
         $academicYears=Academicyear::pluck('name','id')->toArray();
         $show=$feesamount;
         return view('academics.feesamounts.edit',compact(['fees','academicYears','show']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Examinationtype  $examinationtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examinationtype $examinationtype)
    {
        $feesamount->updated_by = auth()->id();
        $feesamount->update(request(['amount','fees_id','year_id','status']));
        alert()->success('success', 'Fees amount  has  successfully Updated.')->persistent();
        return redirect()->route('academic.feesamount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Examinationtype  $examinationtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examinationtype $examinationtype)
    {
        $feesamount->delete();
        alert()->success('success', 'Fees amount  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.feesamount.index');
    }
}
