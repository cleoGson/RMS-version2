<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\DesignationRequest;
class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.designations.actions';
            return $dataTables->eloquent(Designation::with(['creator','updator'])->select('designations.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.designation';
                    $routeKey = 'setting.designation';
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
         return view('settings.designations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.designations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignationRequest $request)
    {
        $designation = Designation::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Department  has  successfully added.')->persistent();
        return redirect()->route('setting.designation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        return view('settings.designations.edit',['show'=>$designation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(DesignationRequest $request, Designation $designation)
    {
        $this->validate($request, [
            'name'=> 'required',
            'display_name'  => 'required',
        ]);
        $designation->updated_by = auth()->id();
        $designation->update(request(['name','display_name']));
        alert()->success('success', 'Department  has  successfully Updated.')->persistent();
        return redirect()->route('setting.designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.designation.index');
    }
}
