<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Academicyear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\AcademicYearRequest;

class AcademicyearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
        if (request()->wantsJson()) {
            $template = 'settings.academicyears.actions';
            return $dataTables->eloquent(Academicyear::with(['creator','updator'])->select('academicyears.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.academicyear';
                    $routeKey = 'setting.academicyear';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('name', function ($row) {
                    return $row->name ? strip_tags($row->name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('settings.academicyears.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.academicyears.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicYearRequest $request)
    {

        $start_date = date("Y-m-d h:m:s", strtotime(request('start_date')));
        $end_date = date("Y-m-d h:m:s", strtotime(request('end_date')));
        $academicyear = Academicyear::create([
            'name'=>request('name'),
            'start_date'=>$start_date,
            'end_date'=>$end_date, 
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'Acacademic year  has  successfully added.')->persistent();
        return redirect()->route('setting.academicyear.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function show(Academicyear $academicyear)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
     return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function edit(Academicyear $academicyear)
    {
        return view('settings.academicyears.edit',['show'=>$academicyear]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicYearRequest $request, Academicyear $academicyear)
    {
        $academicyear->updated_by = auth()->id();
        $academicyear->update(request(['name','start_date','end_date','status']));
        alert()->success('success', 'Academic year  has  successfully Updated.')->persistent();
        return redirect()->route('setting.academicyear.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academicyear $academicyear)
    {
        $academicyear->delete();
        alert()->success('success', 'Academic Year  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.academicyear.index');
    }
}
