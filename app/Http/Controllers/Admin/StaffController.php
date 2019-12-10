<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaffRequest;
use App\Model\Staff;
use App\Model\Marital;
use App\Model\Department;
use App\Model\Designation;
use App\Model\Disability;
use App\Model\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class   StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    
       if (request()->wantsJson()) {
            $template = 'admin.staffs.actions';
            return $dataTables->eloquent(Staff::with(['departments','designations','citizens','countries','disability','maritals','creator','updator'])->select('staff.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'admin.staff';
                    $routeKey = 'admin.staff';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('address', function ($row) {
                    return $row->address ? strip_tags($row->address) : '';
                })->addColumn('full_name', function ($row) {
                    return  $row->firstname.' '.$row->middlename.' '.$row->lastname;
                 })
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
        return view('admin.staffs.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $countrydata=Country::get();
        $maritals=  Marital::pluck('name','id')->toArray();
        $departments=  Department::pluck('name','id')->toArray();
        $designations=  Designation::pluck('name','id')->toArray();
//$disabilities=  Disability::pluck('name','id')->toArray();
        $citizenship=  $countrydata->pluck('name','id')->toArray();
        $birthcountries= $countrydata->pluck('name','id')->toArray();
        return view('admin.staffs.create',compact([ 'maritals','departments',
        'designations','citizenship','birthcountries']));
    }

    public function disabilityData(Request $request){
       $search = $request->get('search');
        $data = Disability::Where('name', 'like', '%' . $search . '%')
            ->orWhere('display_name', 'like', '%' . $search . '%')
            ->orderBy('name')->paginate(10);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {

        
        $birth_date = date("Y-m-d h:m:s", strtotime(request('birth_date')));
        $staff = Staff::create([
            'created_by'=>auth()->id(),
            'firstname'=>request('firstname'), 
            'middlename'=>request('middlename'), 
            'lastname'=>request('lastname'), 
            'sex'=>request('sex'),
            'marital_status'=>request('marital_status'),
            'birth_date'=>$birth_date, 
            'disability'=>request('disability'),
            'birth_place'=>request('birth_place'), 
            'staff_number'=>$this->staffGeneratedNumber(),
            'email'=>request('email'),
            'address'=>request('address'),
            'phone_no'=>request('phone_no'),
            'check_no'=>request('check_no'), 
            'birth_country'=>request('birth_country'), 
            'citzenship'=>request('citzenship'), 
            'department_id'=>request('department_id'),
            'designation_id'=>request('designation_id'),
        ]);
        alert()->success('success', 'Staff has  successfully added.')->persistent();
        return redirect()->route('admin.staff.index');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back(); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        $countrydata=Country::get();
        $maritals=  Marital::pluck('name','id')->toArray();
        $departments=  Department::pluck('name','id')->toArray();
        $designations=  Designation::pluck('name','id')->toArray();
        $disabilities=  Disability::pluck('name','id')->toArray();
        $citizenship=  $countrydata->pluck('name','id')->toArray();
        $birthcountries= $countrydata->pluck('name','id')->toArray();
        $show = $staff; 
        return view('admin.staffs.edit',compact([ 'show','maritals','departments',
        'designations','disabilities','citizenship','birthcountries']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, Staff $staff)
    {

        $staff->updated_by = auth()->id();
        $staff->birth_date = date("Y-m-d h:m:s", strtotime(request('birth_date')));
        $staff->update(request([   
        'firstname',
        'middlename',
        'lastname',
        'sex',
        'marital_status',
        'disability',
        'birth_place',
        'email',
        'address',
        'phone_no',
        'birth_country',
        'citzenship',
        'department_id',
        'designation_id'
        ]));
        alert()->success('success', 'Staff status  has  successfully Updated.')->persistent();
        return redirect()->route('admin.staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        alert()->success('success', 'Staff status  has  successfully Deleted.')->persistent();
        return redirect()->route('admin.staff.index');
    }

       public function selectOptions(Request $request){
        $search = $request->get('search');
        $data = Disability::Where('name', 'like', '%' . $search . '%')
            ->orWhere('display_name', 'like', '%' . $search . '%')
            ->orderBy('name')->paginate(10);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }

        public function staffGeneratedNumber()
    {
            $number = "%STAFF-".date('Y'). '%';
            $staff_number = Staff::withTrashed()->where('staff_number', 'like', $number)->count();
            $staff_number += 1;
            if ($staff_number >= 0 && $staff_number < 10) {
                $assigned_number =$number."-000" . $staff_number;
            } else if ($staff_number >= 10 && $staff_number < 100) {
                $assigned_number =$number."-00" . $staff_number;
            } else if ($staff_number >= 100 && $staff_number < 10000) {
                $assigned_number =$number."-0" . $staff_number;
            } else {
                $assigned_number =$number.'-'. $staff_number;
            }
            return $assigned_number;
    }
}
