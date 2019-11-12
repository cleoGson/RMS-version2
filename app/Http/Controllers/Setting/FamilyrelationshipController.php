<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Familyrelationship;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\RelationshipRequest;

class FamilyrelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.relationships.actions';
            return $dataTables->eloquent(Familyrelationship::with(['creator','updator'])->select('familyrelationships.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.familyrelationship';
                    $routeKey = 'setting.familyrelationship';
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
         return view('settings.relationships.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.relationships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RelationshipRequest $request)
    {
        $familyrelationship = Familyrelationship::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Department  has  successfully added.')->persistent();
        return redirect()->route('setting.familyrelationship.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Familyrelationship  $familyrelationship
     * @return \Illuminate\Http\Response
     */
    public function show(Familyrelationship $familyrelationship)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Familyrelationship  $familyrelationship
     * @return \Illuminate\Http\Response
     */
    public function edit(Familyrelationship $familyrelationship)
    {
        return view('settings.relationships.edit',['show'=>$familyrelationship]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Familyrelationship  $familyrelationship
     * @return \Illuminate\Http\Response
     */
    public function update(RelationshipRequest $request, Familyrelationship $familyrelationship)
    {
        $familyrelationship->updated_by = auth()->id();
        $familyrelationship->update(request(['name','display_name']));
        alert()->success('success', 'Department  has  successfully Updated.')->persistent();
        return redirect()->route('setting.familyrelationship.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Familyrelationship  $familyrelationship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Familyrelationship $familyrelationship)
    {
        $familyrelationship->delete();
        alert()->success('success', 'Department  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.familyrelationship.index');
    }
}
