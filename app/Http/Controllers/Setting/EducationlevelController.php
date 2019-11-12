<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\EducationlevelRequest;
use App\Admin\Educationlevel;

class EducationlevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.educationlevels.actions';
            return $dataTables->eloquent(Educationlevel::with(['creator','updator'])->select('educationlevels.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.educationlevel';
                    $routeKey = 'setting.educationlevel';
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
         return view('settings.educationlevels.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.educationlevels.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationlevelRequest $request)
    {
        $educationlevel = Educationlevel::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'educationlevel  has  successfully added.')->persistent();
        return redirect()->route('setting.educationlevel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Educationlevel  $educationlevel
     * @return \Illuminate\Http\Response
     */
    public function show(Educationlevel $educationlevel)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Educationlevel  $educationlevel
     * @return \Illuminate\Http\Response
     */
    public function edit(Educationlevel $educationlevel)
    {
        return view('settings.educationlevels.edit',['show'=>$educationlevel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Educationlevel  $educationlevel
     * @return \Illuminate\Http\Response
     */
    public function update(EducationlevelRequest $request, Educationlevel $educationlevel)
    {
        $educationlevel->updated_by = auth()->id();
        $educationlevel->update(request(['name','display_name']));
        alert()->success('success', 'educationlevel  has  successfully Updated.')->persistent();
        return redirect()->route('setting.educationlevel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Educationlevel  $educationlevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educationlevel $educationlevel)
    {
        $educationlevel->delete();
        alert()->success('success', 'educationlevel  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.educationlevel.index');
    }
}
