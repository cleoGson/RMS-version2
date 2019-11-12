<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;

use App\Model\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\SectionRequest;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.sections.actions';
            return $dataTables->eloquent(Section::with(['creator','updator'])->select('sections.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.section';
                    $routeKey = 'setting.section';
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
         return view('settings.sections.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        $section = Section::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'section  has  successfully added.')->persistent();
        return redirect()->route('setting.section.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return view('settings.sections.edit',['show'=>$section]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, Section $section)
    {
        $section->updated_by = auth()->id();
        $section->update(request(['name','display_name']));
        alert()->success('success', 'section  has  successfully Updated.')->persistent();
        return redirect()->route('setting.section.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        alert()->success('success', 'section  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.section.index');
    }
}
