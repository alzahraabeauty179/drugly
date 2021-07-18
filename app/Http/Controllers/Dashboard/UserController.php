<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Dashboard\BackEndController;
use Illuminate\Http\Request;
use App\User;
use App\Models\AppSetting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Validator;
use Hash;

class UserController extends BackEndController
{
    
    /**
     * Constructor.
     */
    public function __construct(User $model, UserDataTable $userDataTable)
    {
        parent::__construct($model, $userDataTable);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_name_plural   = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();

        $app_settings = AppSetting::where('owner_id', auth()->user()->id)->first();
        $append = ['app_settings' => $app_settings];
   
        $row = $this->model->findOrFail($id);

        return view('dashboard.' . $this->getClassNameFromModel() . '.edit', compact('row', 'module_name_singular', 'module_name_plural'))->with($append);
    } //end of edit

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
        $rules = [
            'image' => 'nullable|image|max:2000',
            'full_name'  => 'required|string|min:3|max:200',
            'email' => 'required|string|email|max:191|unique:users,email,'. $id,
            'phone' => 'nullable|regex:/^\+?\d[0-9-]{9,11}$/|unique:users,phone,'. $id,
            'current_password'=>'nullable|string',
            'new_password'    =>'nullable|string|min:8|confirmed'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
			return redirect()->back()->with(["updateProfileErrorMessage" => $validator->errors()->first()]);

        $request_data=$request->except(['current_password', 'new_password', 'new_password_confirmation', 'image']);

        // store image
        if ($request->image) {
            if ($user->image != null) {
                Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, 'users_images');
        } //end of if

        if($request->has('new_password') && $request->get('new_password') != ''){
            if ( Hash::check($request->current_password, $user->password) ) 
            {
                $request_data += ['password' => Hash::make($request->new_password)];
            }else
                return redirect()->back()->with(["message_type"=>"error", 
                                                 "updateProfileErrorMessage" => __('site.current_password_not_correct') ]);
        }

        $user->update($request_data);

        session()->flash('success', __('site.profile_updated_successfully'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
    }
}
