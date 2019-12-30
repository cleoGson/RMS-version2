<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Crypt;
use Yajra\DataTables\DataTables;
class StudentAccount extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(DataTables $dataTables)
    {   
         if (request()->wantsJson()) {
            $template = 'students.accounts.actions';
            return $dataTables->eloquent(User::with(['creator','updator'])->where(
            'userable_type','=','App/Model/Student'
            )->select('users.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'student.studentAccount';
                    $routeKey = 'student.studentAccount';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })    
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? $row->updator->email : '';
                })
                ->make(true);
         }
         return view('students.accounts.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(studentAccountRequest $request)
    {
       alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function show(User  $studentAccount)
    {
         alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(User  $studentAccount)
    {
          $roles = Role::get()->pluck('name', 'name');
        return view('students.accounts.edit',compact('studentAccount','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User  $studentAccount)
    {
        $studentAccount->updated_by = auth()->id();
        $studentAccount->update(request(['name','display_name']));
        alert()->success('success', 'Education studentAccount  has  successfully Updated.')->persistent();
        return redirect()->route('student.studentAccount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(User  $studentAccount)
    {
        $studentAccount->delete();
        alert()->success('success', 'Education studentAccount  has  successfully Deleted.')->persistent();
        return redirect()->route('student.studentAccount.index');
    }
}
