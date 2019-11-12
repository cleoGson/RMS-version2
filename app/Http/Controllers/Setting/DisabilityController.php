<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Disability;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\DisabilityRequest;

class DisabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    
       if (request()->wantsJson()) {
            $template = 'settings.disabilities.actions';
            return $dataTables->eloquent(Disability::with(['creator','updator'])->select('disabilities.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.disability';
                    $routeKey = 'setting.disability';
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
       return view('settings.disabilities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.disabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisabilityRequest $request)
    {
        $disability = Disability::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'disability  has  successfully added.')->persistent();
        return redirect()->route('setting.disability.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function show(Disability $disability)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function edit(Disability $disability)
    {
        return view('settings.disabilities.edit',['show'=>$disability]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function update(DisabilityRequest $request, Disability $disability)
    {
        $disability->updated_by = auth()->id();
        $disability->update(request(['name','display_name']));
        alert()->success('success', 'disability  has  successfully Updated.')->persistent();
        return redirect()->route('setting.disability.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disability $disability)
    {
        $disability->delete();
        alert()->success('success', 'disability  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.disability.index');
    }
}
