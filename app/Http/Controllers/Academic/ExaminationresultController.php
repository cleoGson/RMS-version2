<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use App\Model\Examinationnaature;
use App\Model\Examinationresult;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Academic\EventRequest;

class ExaminationresultController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {   
        if (request()->wantsJson()) {
            $template = 'academics.classsetups.actions';
            return $dataTables->eloquent(Classsetup::with(['creator','updator','classes','classsections','years','gradings','curricular'])->select('classsetups.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.classsetup';
                    $routeKey = 'academic.classsetup';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })->addColumn('curricular_id', function ($row) {
                return $row->curricular->curricularSubjects->map(function ($curriculardata) {
                    return
                        ucfirst(strtoupper($curriculardata->name));
                        
             })->implode(', '); })
               ->addColumn('grade_curricular', function ($row) {
               return $row->gradings->gradeCurricular->map(function ($curriculargrade) {
                    return 
                         
                        ucfirst(strtoupper($curriculargrade->name));
                        
             })->implode(', ');
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
         return view('academics.classsetups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years=Academicyear::pluck('name','id')->toArray();
        $classsections=Classsection::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $grades=Gradecurricular::pluck('name','id')->toArray();
        $curricular=Curricular::pluck('name','id')->toArray();
        $feesstructure=Feesstructure::pluck('name','id')->toArray();
        $nature=Examinationnature::pluck('name','id')->toArray();
        return view('academics.classsetups.create',compact(['years','classsections','classes','grades','curricular','feesstructure']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasssetupRequest $request)
    {
        $classsetup = Classsetup::create([
            'name'=>request('name'),
            'class_id'=>request('class_id'),
            'classsection_id'=>request('classsection_id'),
            'year_id'=>request('year_id'),
            'grade_curricular'=>request('grade_curricular'),
            'examination_nature'=>request('examination_nature'),
            'minimum_capacity'=>request('minimum_capacity'),
            'maximum_capacity'=>request('maximum_capacity'),
            'curricular_id'=>request('curricular_id'),
            'feesstructure_id'=>request('feesstructure_id'),
            'status'=>1,
            'created_by'=>auth()->id(),
        ]);
        alert()->success('success', 'classsetup  has  successfully added.')->persistent();
        return redirect()->route('academic.classsetup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function show(Examinationresult $examinationresult)
    {
     alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function edit(Examinationresult $examinationresult)
    {
      $years=Academicyear::pluck('name','id')->toArray();
        $classsections=Classsection::pluck('name','id')->toArray();
        $classes=Classroom::pluck('name','id')->toArray();
        $grades=Gradecurricular::pluck('name','id')->toArray();
        $curricular=Curricular::pluck('name','id')->toArray();
        $feesstructure=Feesstructure::pluck('name','id')->toArray();
        $nature=Examinationnature::pluck('name','id')->toArray();
        return view('academics.classsetups.edit',[
            'show'=>$classsetup,
            'years'=>$years,
            'classsections'=>$classsections,
            'classes'=>$classes,
            'grades'=>$grades,
            'curricular'=>$curricular,
            'feesstructure'=>$feesstructure
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examinationresult $examinationresult)
    {
        
        $classsetup->updated_by = auth()->id();

        $classsetup->update(request([
             'name',
              'class_id',
              'classsection_id',
              'grade_curricular',
              'minimum_capacity',
              'maximum_capacity',
              'examination_nature',
              'curricular_id',
              'feesstructure_id',
              'year_id',
            ]));
        alert()->success('success', 'classsetup  has  successfully Updated.')->persistent();
        return redirect()->route('academic.classsetup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Examinationresult  $examinationresult
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examinationresult $examinationresult)
    {
        $classsetup->delete();
        alert()->success('success', 'classsetup  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.classsetup.index');
    }
}
