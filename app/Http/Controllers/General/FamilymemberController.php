<?php


namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;
use App\Model\Familymember;
use App\Model\Disability;
use App\Model\Familyrelationship;
use Yajra\DataTables\DataTables;
use App\Http\Requests\General\FamilymemberRequest;
use Illuminate\Http\Request;
class FamilymemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
       if (request()->wantsJson()) {
            $template = 'generals.familymembers.actions';
            return $dataTables->eloquent(Familymember::with(['disability','relationship','createdBy','updatedBy'])->select('familymembers.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'general.familymember';
                    $routeKey = 'general.familymember';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('firstname', function ($row) {
                    return $row->firstname ? strip_tags($row->firstname) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->createdBy->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? $row->updatedBy->email : '';
                })
                ->make(true);
         }
        return view('generals.familymembers.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disability = Disability::pluck('name','id')->toArray();
        $relationship =Familyrelationship::pluck('name','id')->toArray();
        return view('generals.familymembers.create',compact('disability','relationship'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamilymemberRequest $request)
    {
         $birth_date = date("Y-m-d", strtotime(request('birth_date')));
         $type="App/Model/Student";
         $typeid=1;
         $familymember = Familymember::create([
            'firstname'=>request('firstname'),
            'middlename'=>request('middlename'),
            'lastname'=>request('lastname'),
            'sex'=>request('sex'),
            'birth_date'=>$birth_date,
            'memberable_type'=>$type, 
            'memberable_id'=>$typeid,
            'address'=>request('address'),
            'disability'=>request('disability'),
            'phone_no'=>request('phone_no'),
            'email'=>request('email'),
            'relationship'=>request('relationship'),
            'created_by'=>auth()->id(),
            ]);
        alert()->success('success', 'Family member   has  successfully added.')->persistent();
        return redirect()->route('general.familymember.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Familymember  $familymember
     * @return \Illuminate\Http\Response
     */
    public function show(Familymember $familymember)
    {
          alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
          return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Familymember  $familymember
     * @return \Illuminate\Http\Response
     */
    public function edit(Familymember $familymember)
    {
         $disability = Disability::pluck('name','id')->toArray();
         $relationship =Familyrelationship::pluck('name','id')->toArray();
         $show=$familymember;
        return view('generals.familymembers.edit',compact('disability','relationship','show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Familymember  $familymember
     * @return \Illuminate\Http\Response
     */
    public function update(FamilymemberRequest $request, Familymember $familymember)
    {
        $familymember->updated_by = auth()->id();
        $familymember->birth_date = date("Y-m-d", strtotime(request('birth_date')));
        $familymember->update(request([
        'firstname',
        'middlename',
        'lastname',
        'sex',
        'address',
        'disability',
        'phone_no',
        'email',
        'relationship',
        ]));
        alert()->success('success', 'FAmill year  has  successfully Updated.')->persistent();
        return redirect()->route('general.familymember.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Familymember  $familymember
     * @return \Illuminate\Http\Response
     */
    public function destroy(Familymember $familymember)
    {
        $familymember->delete();
        alert()->success('success', 'Familly member has successfully Deleted.')->persistent();
         return redirect()->back();
    }
}
