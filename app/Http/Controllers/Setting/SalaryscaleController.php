<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;

use App\Model\Salaryscale;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\SalaryscaleRequest;

class SalaryscaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.salaryscales.actions';
            return $dataTables->eloquent(Salaryscale::with(['creator','updator'])->select('salaryscales.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.salaryscale';
                    $routeKey = 'setting.salaryscale';
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
         return view('settings.salaryscales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.salaryscales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryscaleRequest $request)
    {
        $salaryscale = Salaryscale::create([
             'name'=>request('name'),
             'display_name'=>request('display_name'),
             'min_payment'=>request('min_payment'),
             'max_payment'=>request('max_payment'),
             'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Department  has  successfully added.')->persistent();
        return redirect()->route('setting.salaryscale.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Salaryscale  $salaryscale
     * @return \Illuminate\Http\Response
     */
    public function show(Salaryscale $salaryscale)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Salaryscale  $salaryscale
     * @return \Illuminate\Http\Response
     */
    public function edit(Salaryscale $salaryscale)
    {
        return view('settings.salaryscales.edit',['show'=>$salaryscale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Salaryscale  $salaryscale
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryscaleRequest $request, Salaryscale $salaryscale)
    {
        $salaryscale->updated_by = auth()->id();
        $salaryscale->update(request(['name', 'display_name', 'min_payment', 'max_payment',]));
        alert()->success('success', 'Department  has  successfully Updated.')->persistent();
        return redirect()->route('setting.salaryscale.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Salaryscale  $salaryscale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salaryscale $salaryscale)
    {
        $salaryscale->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.salaryscale.index');
    }
}
