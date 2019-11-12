<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Classsection;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\ClasssectionRequest;

class ClasssectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.classsections.actions';
            return $dataTables->eloquent(Classsection::with(['creator','updator'])->select('classsections.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.classsection';
                    $routeKey = 'academic.classsection';
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
         return view('academics.classsections.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academics.classsections.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasssectionRequest $request)
    {
        $classsection = Classsection::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'classsection  has  successfully added.')->persistent();
        return redirect()->route('academic.classsection.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Classsection  $classsection
     * @return \Illuminate\Http\Response
     */
    public function show(Classsection $classsection)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Classsection  $classsection
     * @return \Illuminate\Http\Response
     */
    public function edit(Classsection $classsection)
    {
        return view('academics.classsections.edit',['show'=>$classsection]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Classsection  $classsection
     * @return \Illuminate\Http\Response
     */
    public function update(ClasssectionRequest $request, Classsection $classsection)
    {
        $classsection->updated_by = auth()->id();
        $classsection->update(request(['name','display_name']));
        alert()->success('success', 'classsection  has  successfully Updated.')->persistent();
        return redirect()->route('academic.classsection.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Classsection  $classsection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classsection $classsection)
    {
        $classsection->delete();
        alert()->success('success', 'classsection  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.classsection.index');
    }
}
