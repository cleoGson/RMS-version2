<?php
namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;

use App\Model\Attachment;
use App\Model\Attachmenttype;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'generals.attachments.actions';
            return $dataTables->eloquent(Attachment::with(['creator','updator'])->select('attachments.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'general.attachment';
                    $routeKey = 'general.attachment';
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
         return view('generals.attachments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attachmenttypes=Attachmenttype::pluck('name','id')->toArray();
        return view('generals.attachments.create',compact(['attachmenttypes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttachmentRequest $request)
    {
        $attachment = Attachment::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Attachment  has  successfully added.')->persistent();
        return redirect()->route('general.attachment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
         $attachmenttypes=Attachmenttype::pluck('name','id')->toArray();
         $show=$attachment;
        return view('generals.attachments.edit',compact(['show','attachmenttypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(AttachmentRequest $request, Attachment $attachment)
    {
        $attachment->updated_by = auth()->id();
        $attachment->update(request(['name','display_name']));
        alert()->success('success', 'Attachment  has  successfully Updated.')->persistent();
        return redirect()->route('general.attachment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();
        alert()->success('success', 'Attachment  has  successfully Deleted.')->persistent();
        return redirect()->route('general.attachment.index');
    }
}
