<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Event;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.events.actions';
            return $dataTables->eloquent(Event::with(['creator','updator'])->select('events.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.event';
                    $routeKey = 'academic.event';
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
         return view('academics.events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academics.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = Event::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Events  has  successfully added.')->persistent();
        return redirect()->route('academic.event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('academics.events.edit',['show'=>$event]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->updated_by = auth()->id();
        $event->update(request(['name','display_name']));
        alert()->success('success', 'Events  has  successfully Updated.')->persistent();
        return redirect()->route('academic.event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        alert()->success('success', 'Events  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.event.index');
    }
}
