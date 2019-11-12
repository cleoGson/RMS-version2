<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Center;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\CenterRequest;


class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.centers.actions';
            return $dataTables->eloquent(Center::with(['creator','updator'])->select('centers.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.center';
                    $routeKey = 'setting.center';
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
         return view('settings.centers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.centers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CenterRequest $request)
    {
        $center = Center::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Center  has  successfully added.')->persistent();
        return redirect()->route('setting.center.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function show(Center $center)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function edit(Center $center)
    {
        return view('settings.centers.edit',['show'=>$center]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function update(CenterRequest $request, Center $center)
    {
        $center->updated_by = auth()->id();
        $center->update(request(['name','display_name']));
        alert()->success('success', 'Center  has  successfully Updated.')->persistent();
        return redirect()->route('setting.center.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function destroy(Center $center)
    {
        $center->delete();
        alert()->success('success', 'Center  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.center.index');
    }
}
