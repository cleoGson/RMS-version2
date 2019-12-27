<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Gpacurricular;
use App\Model\Gparange;
use App\Model\Academicyear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\GpacurricularRequest;

class GpacurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.gpacurricular.actions';
            return $dataTables->eloquent(Gpacurricular::with(['creator','updator','approvedBy','years'])->select('gpacurriculars.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.gpacurricular';
                    $routeKey = 'academic.gpacurricular';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                   ->addColumn('gpa_range', function ($row) {
               return $row->gpaCurricular->map(function ($gpaClass) {
                    return   ucfirst(strtoupper($gpaClass->name)).' ( '.$gpaClass->to.' - '.$gpaClass->from.' ) ';
                        
             })->implode(', ');
               })
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Non Active';
                })
                ->editColumn('approved', function ($row) {
                    return $row->approved == 1 ? 'Active' : 'Non Active';
                })
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                   ->editColumn('approved_by', function ($row) {
                    return $row->approved_by ? $row->approvedBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('academics.gpacurricular.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gparanges =Gparange::pluck('name','id')->toArray(); 
        $academicYears=Academicyear::pluck('name','id')->toArray();
        $selectedGpa=[];
        return view('academics.gpacurricular.create',compact(['academicYears','gparanges','selectedGpa']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GpacurricularRequest $request)
    {
        $gpacurricular = Gpacurricular::create([
            'name'=>request('name'),
            'created_by'=>auth()->id(),
            'year_id'=>request('year_id'), 
            'status'=>1,
            'approved'=>1,
            'approved_by'=>auth()->id(),
        ]);
        $gparanges_lists = $request->input('gparange_id');
        $gpacurricular->gpaCurricular()->sync($gparanges_lists);
        alert()->success('success', 'GPA curricular  has  successfully added.')->persistent();
        return redirect()->route('academic.gpacurricular.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Academic\Gpacurricular  $gpacurricular
     * @return \Illuminate\Http\Response
     */
    public function show(Gpacurricular $gpacurricular)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Academic\Gpacurricular  $gpacurricular
     * @return \Illuminate\Http\Response
     */
    public function edit(Gpacurricular $gpacurricular)
    {
        $gparanges =Gparange::pluck('name','id')->toArray(); 
        $academicYears=Academicyear::pluck('name','id')->toArray();
        $selectedGpa=$gpacurricular->gpaCurricular->pluck('id')->toArray();
        return view('academics.gpacurricular.edit',
        ['show'=>$gpacurricular,
        'academicYears'=> $academicYears,
        'selectedGpa'=>$selectedGpa,
        'gparanges'=>$gparanges]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Academic\Gpacurricular  $gpacurricular
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gpacurricular $gpacurricular)
    {
        $gpacurricular->updated_by = auth()->id();
        $gpacurricular->update(request(['name','year_id','locked']));
        $gparanges_lists = $request->input('gparange_id');
        $gpacurricular->gpaCurricular()->sync($gparanges_lists);
        alert()->success('success', 'GPA curricular  has  successfully Updated.')->persistent();
        return redirect()->route('academic.gpacurricular.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Academic\Gpacurricular  $gpacurricular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gpacurricular $gpacurricular)
    {
       $gpacurricular->delete();
        alert()->success('success', 'GPA curricular  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.gpacurricular.index');
    }
}
