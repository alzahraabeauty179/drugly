<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Models\RoleUser;
use Validator;

class RoleController extends BackEndDatatableController
{
    public function __construct(Role $model, RoleDataTable $datatable)
    {
        parent::__construct($model, $datatable);
    }

    public function store(Request $request)
    {

        $newRole = new Role();

        $newRole->name         =  $request->name;
        $newRole->display_name = ucfirst($request->name);
        $newRole->description  =  $request->description;
        $newRole->save();

        $newRole->attachPermissions($request->permissions);

        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $updateRole = $this->model->findOrFail($id);

        $updateRole->name         =  $request->name;
        $updateRole->display_name = ucfirst($request->name);
        $updateRole->description  =  $request->description;
        $updateRole->save();


        $updateRole->syncPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    public function userRoleIndex()
    {
        $module_name_plural   = "users_roles";
        $module_name_singular = "user_role";

        $rows = RoleUser::all();

        return view('dashboard.roles.' . $module_name_plural . '.index', compact('rows','module_name_singular', 'module_name_plural'));
    }

    public function userRoleCreateUpdate(Request $request)
    {
        $isExist = RoleUser::where('user_id', $request->user_id)->where('role_id', $request->role_id)->first();

        $rules = [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
			return is_null($isExist)? redirect()->back()->with(["createUserRoleError" => $validator->errors()->first()]) 
                                    : redirect()->back()->with(["id" => $request->user_id.$request->role_id, "updateUserRoleError" => $validator->errors()->first()]);

        if( is_null($isExist) )
        {
            if( is_null(RoleUser::where('user_id', $request->user_id)->first()) )
                RoleUser::create(['user_id'=>$request->user_id, 'role_id'=>$request->role_id, 'user_type'=>'App\User']);
            else
                RoleUser::where('user_id', $request->user_id)->update(['role_id'=>$request->role_id]);

            session()->flash('success', __('site.done'));
        }
        else
            session()->flash('error', __('site.user_have_this_role'));

        return redirect()->back();
    }
}
