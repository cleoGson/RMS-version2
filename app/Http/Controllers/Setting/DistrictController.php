<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        return view('settings.departments.edit',['show'=>$department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $this->validate($request, [
            'name'=> 'required',
            'display_name'  => 'required',
        ]);
        $department->updated_by = auth()->id();
        $department->update(request(['name','display_name']));
        alert()->success('success', 'Department  has  successfully Updated.')->persistent();
        return redirect()->route('setting.department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $department->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.department.index');
    }
}
