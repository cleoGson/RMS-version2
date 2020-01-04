<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;

use App\Model\ChartCategory;
use Illuminate\Http\Request;

class ChartCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    
        if (request()->wantsJson()) {
            $template = 'generals.attachmenttypes.actions';
            return $dataTables->eloquent(Attachmenttype::with(['createdBy','updatedBy'])->select('attachmenttypes.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'general.attachmenttype';
                    $routeKey = 'general.attachmenttype';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                ->make(true);
        }
        return view('generals.attachmenttypes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('generals.attachmenttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttachmenttypeRequest $request)
    {
         $attachment = Attachmenttype::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Attachmenttype  has  successfully added.')->persistent();
        return redirect()->route('general.attachmenttype.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ChartCategory  $chartCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ChartCategory $chartCategory)
    {
       alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ChartCategory  $chartCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChartCategory $chartCategory)
    {
       return view('generals.attachmenttypes.edit',['show'=>$attachmenttype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ChartCategory  $chartCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChartCategory $chartCategory)
    {
    $attachmenttype->updated_by = auth()->id();
        $attachmenttype->update(request(['name','display_name']));
        alert()->success('success', 'Attachmenttype  has  successfully Updated.')->persistent();
        return redirect()->route('general.attachmenttype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ChartCategory  $chartCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartCategory $chartCategory)
    {
         $attachmenttype->delete();
        alert()->success('success', 'Attachmenttype  has  successfully Deleted.')->persistent();
        return redirect()->route('general.attachmenttype.index');
    }
}
