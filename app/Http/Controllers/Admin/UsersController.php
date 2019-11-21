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
class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {
    
       $users=User::all();
        return view('admin.users.index', compact('users'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
       
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }


      /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function userPermission(User $user)
    {
        $extrapermission = [];
        $attachedpermissions = [];
        $admin_default_permissions = [];
        foreach ($user->Permissions as $extrapermissions) {
            $extrapermission[] = $extrapermissions->id;
        }
        foreach ($user->roles as $roles) {
          
            foreach ($roles->permissions as $role_permission) {
                $attachedpermissions[] = $role_permission->id;
            }
        }
       
        if (count($attachedpermissions) > 0) {
            $attachedpermissions = array_unique($attachedpermissions);
        }
      
        $adminroles = Role::whereIn('id', [1, 2])->get();
        $adminrole2 =Role::all();
       
        foreach ($adminrole2 as $adminrole_default) {
            //dd($adminrole_default);
            dd($adminrole_default->permissions);
            foreach ($adminrole_default->permissions as $admin_permission) {
               
                $admin_default_permissions[] = $admin_permission->id;
            }
        }
        $uniq_admin_default_permissions = array_unique($admin_default_permissions);
        $allattachedpermissions = array_merge($uniq_admin_default_permissions, $attachedpermissions);

        $permission = Permission::whereNotIn('id', $allattachedpermissions)->get();
        
        return view('admin.users.user_permissions',
            [
                'user' => $user,
                'permissions' => $permission,
                'extrapermission' => $extrapermission
            ]);
    }

    public function userPermissionsAssignment(Request $request, $id)
    {
        $user = User::findorFail($id);
        $permissions = $request->input("permission_ids");
        $user->syncPermissions($permissions, 'App/User');
        alert()->success('User specific permission. ', 'Specific Permission Successfully Assigned', 'success')->persistent('Ok');
        return redirect()->back();
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       
        $user->delete();

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
