<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\log;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\User;
use Spatie\Activitylog\Models\Activity as ActivityLoggerData;
use Illuminate\Support\Facades\Response;
use Session;
use Yajra\DataTables\DataTables;
class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Datatables $dataTables)
    {
        return view('admin.userlogs.index');
    }

    public function data(DataTables $dataTables, Request $request){
        $template = 'admin.userlogs.actions';
        $query = Log::with('users')->orderBy('id','desc');
        return $dataTables->eloquent($query->select('logs.*'))
            ->editColumn('action', function ($row) use ($template) {
                $gateKey = 'admin.log';
                $routeKey = 'admnin.log';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            })
            ->editColumn('station', function ($row) {
                return $row->user_id ? $row->users->name : '';
            })
           
            ->make(true);
    }

    public function activityIndex(Datatables $dataTables)
    {
        return view('admin.userlogs.activitieslogs');
    }


    public function dataActivityLogs(DataTables $dataTables, Request $request){
        $template = 'admin.userlogs.activitiesactions';

        $query = ActivityLoggerData::with('causer')->orderBy('id','desc');

        if(!is_null($request->start_date) && !is_null($request->end_date)){
            $query = $query->whereBetween('created_at',array($request->start_date, $request->end_date)); 
        }
        return $dataTables->eloquent($query->select('activity_log.*'))
            ->editColumn('action', function ($row) use ($template) {
                $gateKey = 'admin.activitylogs';
                $routeKey = 'admin.activitylogs';

                return view($template, compact('row', 'gateKey', 'routeKey'));

            }) 
            ->editColumn('properties', function ($row) {
                if(!is_null($row->properties)){
              
                return $row->properties ? $row->properties : '';
            }
            return 'Nothing';
            })

            ->editColumn('causer_id', function ($row) {
                return $row->causer_id ? $row->causer->name : '';
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]); 
        $start_date = date("Y-m-d h:m:s", strtotime(request('start_date')));
        $end_date = date("Y-m-d h:m:s", strtotime(request('end_date')));
        $log=Logs::findOrFail($request->log_id);
        if(!is_null($log->user_id) && is_int($log->user_id)){
            $users_data=User::findOrFail($log->user_id);
            $user_actions=$users_data->actions->whereBetween('created_at',array($start_date,$end_date)); 
            return view('admin.userlogs.logsactivities')
            ->with('userdetails',$log)
            ->with('userlogs',$users_data)
            ->with('user_actions',$user_actions);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(log $log)
    {
        if(!is_null($log->user_id) && is_int($log->user_id)){
            $users_data=User::findOrFail($log->user_id);
            $user_actions=$users_data->actions;
            return view('userlogs.logsactivities')
            ->with('userdetails',$log)
            ->with('userlogs',$users_data)
            ->with('user_actions',$user_actions);
        }
        return redirect()->back();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(log $log)
    {
        //
    }
}
