<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Yajra\DataTables\DataTables;
use App\Permission;
use DB;
use Crypt;
class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
            if (request()->wantsJson()) {
            $template = 'admin.users.actions';
            return $dataTables->eloquent(User::with(['roles','permissions'])->where(
            'userable_type','=','App/Model/Staff'
            )->select('users.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'admin.users';
                    $routeKey = 'admin.users';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('status', function($row){
                return $row->status == 1 ? 'Active' : 'Not Active';   
                })
                    ->editColumn('verifiedstatus', function($row){
                return $row->verifiedstatus == 1 ? 'Yes' : 'No';   
                })
             ->addColumn('user_roles', function ($row) {
                return $row->roles->map(function ($roleName) {
                    return
                        ucfirst(strtolower($roleName->name));
                        
             })->implode(', '); })
            ->addColumn('user_permission', function ($row) {
                return $row->permissions->map(function ($permissionName) {
                    return
                        ucfirst(strtolower($permissionName->name));
                        
             })->implode(', '); })
             
         ->make(true);
         }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
                         
        $data=[
            'email'=>'email', 
            'username'=>'email', 
            'password'=>'email',
            'token'=>'email',
            'verifiedstatus'=>'email', 
            'userable_type'=>'email',
            'userable_id'=>'email', 
            'password_changed_at'=>'email',
            'image'=>'email', 
            'status'=>'email', 
            'created_by'=>'email', 
        ];
        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);
        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $id=Crypt::decrypt($user);
        $user = User::find($id);
        $roles = Role::pluck('display_name', 'id')->toArray();
        $show=$user;
        $rolesin =$user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('show', 'rolesin','roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
       * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request,$user)
    {

       $id=Crypt::decrypt($user);
        $user = User::find($id);
     if(!is_null($user)){
        $roles = $request->input('roles') ? $request->input('roles') : [];
        if(!is_null($roles)){
        $user->syncRoles($roles);
        }
        return redirect()->route('admin.users.index');
      }
        return redirect()->route('admin.users.index');
    }

    public function show($user)
    {
        $id=Crypt::decrypt($user);
        $user = User::find($id);
        $user->load('roles');
        return view('admin.users.show', compact('users'));
    }


      /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function userPermission($user)
    {
         $id=Crypt::decrypt($user);
        $user = User::find($id);
        $attachedpermissions = [];
        $admin_default_permissions = [];
        $admin_default_roles=[];
        $unique_permissions=[];
        $extrapermission =$user->permissions->pluck('id')->toArray();
        foreach ($user->roles as $roles_assigned) {
        if(!is_null($roles_assigned)){
         $data=$roles_assigned->permissions->pluck('id')->toArray();
        $attachedpermissions=array_merge($attachedpermissions,$data);
        }
        }
        if (count($attachedpermissions) > 0) {
            $attachedpermissions = array_unique($attachedpermissions);
        }
        $admin_default_roles=DB::table('permission_role')->select('permission_id')->whereIn('role_id', [1,2])->get()->pluck('permission_id')->toArray();
        if(!is_null($admin_default_roles)){
          $admin_default_roles = array_unique($admin_default_roles);
         }
        $allattachedpermissions = array_merge($admin_default_roles, $attachedpermissions);
        if(!is_null($allattachedpermissions)){
         $unique_permissions = array_unique($allattachedpermissions);
        }
        $permission = Permission::whereNotIn('id', $unique_permissions)->get();
        
        return view('admin.users.user_permissions',
            [
                'user' => $user,
                'permissions' => $permission,
                'extrapermission' => $extrapermission
            ]);
    }

    public function permissionsAssignment(Request $request)
    {
        $user = User::findorFail($request->input('user_id'));
        $permissions = $request->input("permission_ids");
        $user->syncPermissions($permissions, 'App/User');
        alert()->success('User specific permission. ', 'Specific Permission Successfully Assigned', 'success')->persistent('Ok');
        return redirect()->back();
    }

      public function addAdminRole($user)
    {
       $id=Crypt::decrypt($user);
        $user = User::find($id);
        $assigned_roles=auth()->user()->roles->pluck('id')->toArray();
        $adminrole=in_array(2,$assigned_roles) ? true : false;
     
        if ($adminrole) {
            $user->attachRoles([2]);
        alert()->success('Role assigned . ', 'Admin Role has been added successfully', 'success')->persistent('Ok');

        } else {
   alert()->warning('Role assigned . ', 'Access denied, Your not Allowed', 'warning')->persistent('Ok');
        }
        return redirect()->route('admin.users.index');
    }

    public function removeAdminRole($user)
    {
       $id=Crypt::decrypt($user);
        $user = User::find($id);
        $assigned_roles=auth()->user()->roles->pluck('id')->toArray();
        $adminrole=in_array(1,$assigned_roles) ? true : false;
        if ($adminrole) {
           $user->detachRoles([2]);
           alert()->success('Role removed . ', 'Admin Role has been removed ', 'success')->persistent('Ok');
        } 
         alert()->warning('Access denied . ', 'Sorry your not authorised to perform this action ', 'warning')->persistent('Ok');
        return redirect()->route('admin.users.index');
    }


    public function activateAccount(Request $request, $user)
    {
        $id=Crypt::decrypt($user);
        $user = User::find($id);
        $deactivationfactor = $user->accountStatus->name;
        if ($user->deactivation_factor < 4) {
            \Session::flash('delete', " Sorry!! user account deactivated due to   $deactivationfactor Cannot be activated.");
        } elseif ($id == auth()->user()->id) {
            \Session::flash('delete', " Sorry!! you can not activate Your own account.");
        } else {
            $user->update([
                'status' => 1,
                'deactivation_factor' => null,
            ]);
            \Session::flash('success', 'You have Successfully Activate  an Account');
        }
        return redirect()->back();
    }
    public function deactivateAccount(Request $request, $user)
    {
         $id=Crypt::decrypt($user);
        $user = User::find($id);
        if ($id == auth()->user()->id) {
            \Session::flash('delete', " Sorry!! you can not Deactivate  Your own Account.");
           return redirect()->back();  
        } 
          $assigned_roles=$user->roles->pluck('id')->toArray();
          $adminrole=in_array(1,$assigned_roles) || in_array(2,$assigned_roles)  ? true : false;  
          if($adminrole){
            $user->update([
                'account_status' => 0,
                'deactivation_factor' => request('factor'),
             ]);
            \Session::flash('success', 'You have Successfully Deactivate  an Account');
          }
        return redirect()->back();
        }
        public function passwordReset($user){
        $id=Crypt::decrypt($user);
        $user = User::find($id);
        $nature=$user->userable_type;
        $nature_details=explode('/',$nature);
        $password_reset=($nature_details[2]=="Staff") ? bcrypt('Staff@255??') : bcrypt('Student@255??');
        $user->password= $password_reset;
        $user->password_changed_at=NULL;
        $user->verifiedstatus;
        $user->reseted_by=auth()->user()->id;
        $user->reseted_at=date('Y-m-d h:m:s');
        $user->status=1;
        $user->save();
        return redirect()->route('admin.users.index');
        }
      
    /**
     * Remove User from storage.
     *
       * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $id=Crypt::decrypt($user);
        $user = User::find($id);
        $assigned_roles=$user->roles->pluck('id')->toArray();
        $adminrole=in_array(1,$assigned_roles) || in_array(2,$assigned_roles)  ? true : false;  
        if($adminrole){
        $user->delete();
        \Session::flash('delete', " Sorry!! you can not Deactivate  Your own Account.");
         return redirect()->route('admin.users.index');
        }
        alert()->warning('Access denied . ', 'Sorry your not authorised to perform this action ', 'warning')->persistent('Ok');
        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
