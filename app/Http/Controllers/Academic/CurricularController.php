<?php

namespace App\Http\Controllers\Academic;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Model\Curricular;
use App\Model\Semester;
use App\Model\Academicyear;
use App\Model\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\Academic\CurricularRequest;
class CurricularController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'academics.curricular.actions';
            return $dataTables->eloquent(Curricular::with(['createdBy','updatedBy','verifiedBy','semesters','years'])->select('curriculars.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'academic.curricular';
                    $routeKey = 'academic.curricular';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                  ->addColumn('subjects', function ($row) {
               return $row->curricularSubjects->map(function ($curriculars) {
                    return   ucfirst(strtoupper($curriculars->name));
                        
             })->implode(', ');
               })
                ->editColumn('semester_id', function ($row) {
                    return $row->semester_id ? strip_tags($row->semesters->name) : '';
                })
                  ->editColumn('year_id', function ($row) {
                    return $row->year_id ? strip_tags($row->years->name) : '';
                })
                  ->editColumn('verified_by', function ($row) {
                    return $row->verified_by ? strip_tags($row->verifieBy->email) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updatedBy->email)) : '';
                })
                ->make(true);
         }
         return view('academics.curricular.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::pluck('name','id')->toArray();
        $years=Academicyear::pluck('name','id')->toArray();
        $semesters=Semester::pluck('name','id')->toArray();
        $selectedsubject=[];
        $selected_optional_subject=[];
        return view('academics.curricular.create',compact(['years','semesters','subjects','selectedsubject','selected_optional_subject']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurricularRequest $request)
    {
       $curricular = Curricular::create([
            'name'=>request('name'),
            'year_id'=>request('year_id'),
            'semester_id'=>request('semester_id'),
            'status'=>1,
            'created_by'=>auth()->id(),
        ]);
        $subjects_lists = $request->input('subjects_id');
        //optional subjects
        $optional_subjects=$request->input('optional_subjects');
        $optionalSubjects=array_diff($optional_subjects,$subjects_lists);

        $datacompulsory = [];
        foreach( $subjects_lists  as $key_c=>$c_value) { 
            $datacompulsory[$c_value] = [ 'status' => 1 ];
        }

        $dataoptional=[];
        foreach ($optionalSubjects as $key_o => $o_value){
             $dataoptional[$o_value] = [ 'status' => '0'];
           }

           if(!is_null($datacompulsory)){
        $curricular->curricularSubjects()->sync($datacompulsory);
           }
         if(!is_null($dataoptional)){ 
        $curricular->curricularSubjects()->syncWithoutDetaching($dataoptional,false);
         }
    
        alert()->success('success', 'Curriculum  has  successfully added.')->persistent();
        return redirect()->route('academic.curricular.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function show(Curricular $curricular)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function edit(Curricular $curricular)
    {
         $selectedsubject=$curricular->compulsoryCurricularSubjects->pluck('id')->toArray();
         $selected_optional_subject=$curricular->optionalCurricularSubjects->pluck('id')->toArray();
        $subjects = Subject::pluck('name','id')->toArray();
        $years=Academicyear::pluck('name','id')->toArray();
        $semesters=Semester::pluck('name','id')->toArray();
        return view('academics.curricular.edit',
        ['show'=>$curricular,
        'years'=>$years,
        'semesters'=>$semesters,
        'subjects'=>$subjects,
        'selectedsubject'=>$selectedsubject,
        'selected_optional_subject'=> $selected_optional_subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function update(CurricularRequest $request, Curricular $curricular)
    {
        $curricular->updated_by = auth()->id();
        $curricular->update(request(['name','semester_id','year_id','status']));
        $subjects_lists = $request->input('subjects_id');
        //optional subjects
        $optional_subjects=$request->input('optional_subjects');
        $optionalSubjects=array_diff($optional_subjects,$subjects_lists);

        $datacompulsory = [];
        foreach( $subjects_lists  as $key_c=>$c_value) { 
            $datacompulsory[$c_value] = [ 'status' => 1 ];
          }
         
        $dataoptional=[];
        foreach ($optionalSubjects as $key_o => $o_value){
             $dataoptional[$o_value] = [ 'status' => '0'];
           }
          if(!is_null($datacompulsory)){   
        $curricular->curricularSubjects()->sync($datacompulsory);
          }
         if(!is_null($dataoptional)){ 
        $curricular->curricularSubjects()->syncWithoutDetaching($dataoptional, false);
         }
        alert()->success('success', 'Curriculum  has  successfully Updated.')->persistent();
        return redirect()->route('academic.curricular.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Curricular  $curricular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curricular $curricular)
    {
       $curricular->delete();
        alert()->success('success', 'Curriculum  has  successfully Deleted.')->persistent();
        return redirect()->route('academic.curricular.index');
    }
}
