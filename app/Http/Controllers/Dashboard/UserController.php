<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Dashboard\BackEndController;
use Illuminate\Http\Request;
use App\User;
use App\Models\Area;
use App\Models\AppSetting;
use App\Models\Subscriber;
use App\Models\Store;
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
        $rules = [
            'image' 			=> 'nullable|image|max:2000',
        	'national_id_image' => 'required|image|max:2000',
        	'license_image'     => 'required|image|max:2000',
            'name'  			=> 'required|string|min:3|max:200',
            'email' 			=> 'required|string|email|max:191|unique:users,email',
            'phone' 			=> 'nullable|regex:/^\+?\d[0-9-]{9,11}$/|unique:users,phone',
            'password'   	 	=> 'required|string|min:8|confirmed',
        	'areas' 			=> 'required',
        	'payment_method' 	=> 'required|string|in:cash,visa,vodafone_cash',
        	'subscription_id'	=> 'required|exists:subscriptions,id',
        	'subscription_type' => 'required|in:medical_store,beauty_company,pharmacy'
        ];

        $validator = Validator::make($request->all(), $rules);
 			
        if($validator->fails())
			return redirect()->back()->with(["registrationErrorMessage" => $validator->errors()->first(), "id" => $request->subscription_id]);
		
    	$subscriber_request = ['payment_method' => $request->payment_method, 'subscription_id' => $request->subscription_id];
    	
        $request_data = $request->except(['password', 'password_confirmation', 'image', 'national_id_image', 'areas',
                                          'license_image', 'payment_method', 'subscription_id', 'subscription_type']);

        // store image
        if ($request->image)
            $request_data['image'] = $this->uploadImage($request->image, 'users_images');

    	// store national_id_image
        if ($request->national_id_image) 
            $request_data['national_id_image'] = $this->uploadImage($request->national_id_image, 'users_images');

    	// store license_image
        if ($request->license_image)
            $request_data['license_image'] = $this->uploadImage($request->license_image, 'users_images');
    	
    	$request_data += ['password' => Hash::make($request->password), 'type' => $request->subscription_type, 
                          'areas' => implode(',', $request->areas)];
    	// dd("working on sending user's mail");
    	$user = User::create($request_data);
    	
    	Subscriber::create([
        	'subscription_id'	=>$subscriber_request['subscription_id'], 
			'subscriber_id'		=>$user->id,
			'payment_method'	=>$subscriber_request['payment_method']
        ]);
    	
    	session()->flash('success', __('site.subscribed_successfully'));
        return redirect()->back();
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

        if( auth()->user()->type == "super_admin" )
            $app_settings = AppSetting::where('owner_id', auth()->user()->id)->first();
        else
            $app_settings  = Store::where('owner_id', auth()->user()->id)->first();

        $append = ['app_settings' => $app_settings];
   
        $row = $this->model->findOrFail($id);
    	$row->areas  = explode(',', $row->areas);

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
            'name'  => 'required|string|min:3|max:200',
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
