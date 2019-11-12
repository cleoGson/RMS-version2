<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;

use App\Model\Termsofservice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\TermsofserviceRequest;
class TermsofserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.termsofservices.actions';
            return $dataTables->eloquent(Termsofservice::with(['creator','updator'])->select('termsofservices.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.termsofservice';
                    $routeKey = 'setting.termsofservice';
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
         return view('settings.termsofservices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.termsofservices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TermsofserviceRequest $request)
    {
        $termsofservice = Termsofservice::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'termsof service  has  successfully added.')->persistent();
        return redirect()->route('setting.termsofservice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Termsofservice  $termsofservice
     * @return \Illuminate\Http\Response
     */
    public function show(Termsofservice $termsofservice)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Termsofservice  $termsofservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Termsofservice $termsofservice)
    {
        return view('settings.termsofservices.edit',['show'=>$termsofservice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Termsofservice  $termsofservice
     * @return \Illuminate\Http\Response
     */
    public function update(TermsofserviceRequest $request, Termsofservice $termsofservice)
    {

        $termsofservice->updated_by = auth()->id();
        $termsofservice->update(request(['name','display_name']));
        alert()->success('success', 'termsof service  has  successfully Updated.')->persistent();
        return redirect()->route('setting.termsofservice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Termsofservice  $termsofservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Termsofservice $termsofservice)
    {
        $termsofservice->delete();
        alert()->success('success', 'termsof service  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.termsofservice.index');
    }
}
