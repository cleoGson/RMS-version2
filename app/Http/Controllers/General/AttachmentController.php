<?php
namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;

use App\Model\Attachment;
use App\Model\Attachmenttype;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Image;
use App\Http\Requests\General\AttachmentRequest;

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
            return $dataTables->eloquent(Attachment::with(['createdBy','updatedBy','attachmentType'])->select('attachments.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'general.attachment';
                    $routeKey = 'general.attachment';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                  ->editColumn('attachment_type', function ($row) {
                    return $row->attachment_type ? strip_tags($row->attachmentType->name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
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
        $filepath=null;
        if($request->hasFile('file')) {
        $extension = $request->file('file')->getClientOriginalExtension();
        //filename to store
        $filenametostore = date('Ymdhms').microtime(true).'.'.$extension;
        //Upload File
        $request->file('file')->storeAs('public/attachments', $filenametostore);
        $filepath = 'storage/attachments/'.$filenametostore;
        }

    //    $image = $request->file('file');

    //     $file_name_path =date('Ymdhms').microtime(true).'.'.$image->extension();

    //     $destinationPath = storage_path('attachments');

    //     $img = Image::make($image->path());

    //     $img->resize(150, 150, function ($constraint) {

    //         $constraint->aspectRatio();

    //     })->save($destinationPath.'/'.$file_name_path);

    //     $destinationPath = storage_path('/images');
    //     $image->move($destinationPath, $file_name_path);
         $attachment = Attachment::create([
                    'file'=> $filepath,
                    'attachment_type'=>request('attachment_type'),
                    'created_by'=>auth()->id(),
                    'attachable_type'=>request('attachable_type'),
                    'attachable_id'=>request('attachable_id'), 
                    'remarks'=>request('remarks'),
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
        
        $attachment->update(request(['file','attachment_type','remarks']));
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
