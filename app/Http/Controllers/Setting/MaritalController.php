<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Marital;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\MaritalstatusRequest;
class MaritalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.maritals.actions';
            return $dataTables->eloquent(Marital::with(['creator','updator'])->select('maritals.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.marital';
                    $routeKey = 'setting.marital';
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
         return view('settings.maritals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.maritals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaritalstatusRequest $request)
    {
        $marital = Marital::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Department  has  successfully added.')->persistent();
        return redirect()->route('setting.marital.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Marital  $marital
     * @return \Illuminate\Http\Response
     */
    public function show(Marital $marital)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
     return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Marital  $marital
     * @return \Illuminate\Http\Response
     */
    public function edit(Marital $marital)
    {
        return view('settings.maritals.edit',['show'=>$marital]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Marital  $marital
     * @return \Illuminate\Http\Response
     */
    public function update(MaritalstatusRequest $request, Marital $marital)
    {
        $this->validate($request, [
            'name'=> 'required',
            'display_name'  => 'required',
        ]);
        $marital->updated_by = auth()->id();
        $marital->update(request(['name','display_name']));
        alert()->success('success', 'Department  has  successfully Updated.')->persistent();
        return redirect()->route('setting.marital.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Marital  $marital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marital $marital)
    {
        $marital->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.marital.index');
    }
}
