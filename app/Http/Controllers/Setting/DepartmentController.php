<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\StoreTwoFieldSettings;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.departments.actions';
            return $dataTables->eloquent(Department::with(['creator','updator'])->select('departments.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.department';
                    $routeKey = 'setting.department';
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
         return view('settings.departments.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *  * @param  \App\Http\Requests\StoreTwoFieldSettings  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTwoFieldSettings  $request)
    {
        $department = Department::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Department  has  successfully added.')->persistent();
        return redirect()->route('setting.department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
    alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
     return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('settings.departments.edit',['show'=>$department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTwoFieldSettings $request, Department $department)
    {
        $department->updated_by = auth()->id();
        $department->update(request(['name','display_name']));
        alert()->success('success', 'Department  has  successfully Updated.')->persistent();
        return redirect()->route('setting.department.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.department.index');
    }
}
