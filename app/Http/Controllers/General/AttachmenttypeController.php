<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;

use App\Model\Atttachementtype;
use Illuminate\Http\Request;

class AttachmenttypeController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'generals.attachmenttypes.actions';
            return $dataTables->eloquent(Attachmenttype::with(['creator','updator'])->select('attachmenttypes.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'general.attachmenttype';
                    $routeKey = 'general.attachmenttype';
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
        
        $attachmenttype = Attachmenttype::create([
                    'file'=>request('name'),
                    'attachment_type'=>request('attachment_type'),
                    'created_by'=>auth()->id(),
                    'attachable_type'=>request('attachment_type'),
                    'attachable_id'=>request('attachment_id'), 
                    'remarks'=>request('remarks'),
        ]);
        alert()->success('success', 'Attachmenttype  has  successfully added.')->persistent();
        return redirect()->route('general.attachmenttype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Attachmenttype  $attachmenttype
     * @return \Illuminate\Http\Response
     */
    public function show(Attachmenttype $attachmenttype)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Attachmenttype  $attachmenttype
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachmenttype $attachmenttype)
    {
        return view('generals.attachmenttypes.edit',['show'=>$attachmenttype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Attachmenttype  $attachmenttype
     * @return \Illuminate\Http\Response
     */
    public function update(AttachmenttypeRequest $request, Attachmenttype $attachmenttype)
    {
        $attachmenttype->updated_by = auth()->id();
        $attachmenttype->update(request(['file','attachment_type','remarks']));
        alert()->success('success', 'Attachmenttype  has  successfully Updated.')->persistent();
        return redirect()->route('general.attachmenttype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Attachmenttype  $attachmenttype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachmenttype $attachmenttype)
    {
        $attachmenttype->delete();
        alert()->success('success', 'Attachmenttype  has  successfully Deleted.')->persistent();
        return redirect()->route('general.attachmenttype.index');
    }
}
