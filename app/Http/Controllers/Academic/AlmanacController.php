<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Almanac;
use App\Model\Academicyear;
use App\Model\Event;
use App\Model\Center;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\AlmanacRequest;
class AlmanacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'academics.almanac.actions';
            return $dataTables->eloquent(Almanac::with(['creator','updator','events','years','centers'])->select('almanacs.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.almanac';
                    $routeKey = 'academic.almanac';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('description', function ($row) {
                    return $row->description ? strip_tags($row->description) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('academics.almanac.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years=Academicyear::pluck('name','id')->toArray();
        $centers=Center::pluck('name','id')->toArray();
        $events=Event::pluck('name','id')->toArray();
        return view('academics.almanac.create',compact(['years','centers','events']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlmanacRequest $request)
    {
          $start_date = date("Y-m-d h:m:s", strtotime(request('start_date')));
          $end_date = date("Y-m-d h:m:s", strtotime(request('end_date')));
          $almanac = Almanac::create([
                'name'=>request('name'),
                'description'=>request('description'),
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'center_id'=>request('center_id'),
                'year_id'=>request('year_id'),
                'event_id'=>request('event_id'),
                'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Almanac  has  successfully added.')->persistent();
        return redirect()->route('academic.almanac.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Almanac  $almanac
     * @return \Illuminate\Http\Response
     */
    public function show(Almanac $almanac)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Almanac  $almanac
     * @return \Illuminate\Http\Response
     */
    public function edit(Almanac $almanac)
    {
        $years=Academicyear::pluck('name','id')->toArray();
        $centers=Center::pluck('name','id')->toArray();
        $events=Event::pluck('name','id')->toArray();
        return view('academics.almanac.edit',
        [
        'show'=> $almanac,
        'years'=> $years,
        'centers'=>$centers,
        'events'=>$events
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Almanac  $almanac
     * @return \Illuminate\Http\Response
     */
    public function update(AlmanacRequest $request, Almanac $almanac)
    {
          $almanac->updated_by = auth()->id();
          $almanac->start_date = date("Y-m-d h:m:s", strtotime(request('start_date')));
          $almanac->end_date = date("Y-m-d h:m:s", strtotime(request('end_date')));
          $almanac->update(request([
            'center_id',
            'year_id', 
            'event_id',   
            'description'
          ]));
        alert()->success('success', 'Almanac  has  successfully Updated.')->persistent();
        return redirect()->route('academic.almanac.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Almanac  $almanac
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almanac $almanac)
    {
          $almanac->delete();
        alert()->success('success', 'Almanac  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.almanac.index');
    }
}
