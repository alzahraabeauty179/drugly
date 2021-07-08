<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class EmployeeController extends BackEndController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        $request->validate([
            'name'          => 'required|min:5|string',
            'email'         => 'required|email',
            'phone'         => 'required|digits:11|regex:/(01)[0-2]{1}[0-9]{8}/',
            'password'      => 'required|min:5|string|confirmed',
            'password_confirmation'   => 'required|min:5|string|same:password',
            'address'       => 'nullable|min:5|string',
        ]);


        $request_data = $request->except(['_token', 'password', 'password_confirmation', 'role', 'permissions']);
        $request_data['password'] = bcrypt($request->password);

        $newuser = $this->model->create($request_data);

        $newuser->attachRole('new_per');
        $newuser->attachPermissions($request->permissions);

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
        $user = $this->model->findOrFail($id);
        $request->validate([
            'name'          => ['required', 'min:5',],
            'email'         => ['required', 'min:5', 'email'],
        ]);

        $request_data = $request->except(['_token', 'password', 'password_confirmation', 'role', 'permissions']);
        $request_data['password'] = bcrypt($request->password);

        $user->syncPermissions($request->permissions);

        $user->update($request_data);

        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    public function destroy($id, Request $request)
    {
        $user = $this->model->findOrFail($id);

        $user->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
