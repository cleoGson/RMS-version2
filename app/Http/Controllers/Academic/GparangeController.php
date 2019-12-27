<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;

use App\Model\Gparange;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\GparangeRequest;

class GparangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.gpa.actions';
            return $dataTables->eloquent(Gparange::with(['creator','updator'])->select('gparanges.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.gparange';
                    $routeKey = 'academic.gparange';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })      
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('academics.gpa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('academics.gpa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GparangeRequest $request)
    {
        $gparange = Gparange::create([
            'name'=>request('name'),
            'created_by'=>auth()->id(),
            'from'=>request('from'),
            'to'=>request('to'),
            
        ]);
        alert()->success('success', 'GPA Class  has  successfully added.')->persistent();
        return redirect()->route('academic.gparange.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Academic\Gparange  $gparange
     * @return \Illuminate\Http\Response
     */
    public function show(Gparange $gparange)
    {
       alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Academic\Gparange  $gparange
     * @return \Illuminate\Http\Response
     */
    public function edit(Gparange $gparange)
    {
        $show=$gparange;
        return view('academics.gpa.edit',compact('show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Academic\Gparange  $gparange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gparange $gparange)
    {
       $gparange->updated_by = auth()->id();
        $gparange->update(request(['name','from','to']));
        alert()->success('success', 'GPA Class  has  successfully Updated.')->persistent();
        return redirect()->route('academic.gparange.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Academic\Gparange  $gparange
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gparange $gparange)
    {
         $gparange->delete();
         alert()->success('success', 'GPA Class  has  successfully Deleted.')->persistent();
         return redirect()->route('academic.gparange.index');
    }
}
