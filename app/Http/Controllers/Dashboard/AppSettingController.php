<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\BackEndController;
use Illuminate\Http\Request;

use App\Models\AppSetting;
use App\User;
use Illuminate\Support\Facades\Storage;

use Validator;

class AppSettingController extends BackEndController
{

    /**
     * Constructor.
     */
    public function __construct(AppSetting $model)
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
        $rules = [
            'email' => 'required|string|email|max:191|unique:app_settings,email',
            'phone' => 'required|regex:/^\+?\d[0-9-]{9,11}$/|unique:app_settings,phone',
            'logo' => 'nullable|image|max:2000',         
            'facebook_link'=>'nullable|string|max:191',
            'twitter_link'=>'nullable|string|max:191',
            'instagram_link'=>'nullable|string|max:191',
            'youtube_link'=>'nullable|string|max:191',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => 'required|string|min:3|max:200',
                $locale . '.description' => 'nullable|string|min:3|max:500',
                $locale . '.about_us' => 'nullable|string|min:3|max:500',
                $locale . '.privacy_policy' => 'nullable|string|min:3|max:500',
            ];
        }

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
			return redirect()->back()->with(["updateAppInfoErrorMessage" => $validator->errors()->first()]);
   
        $request_data = $request->except(['_token', 'logo']);
        $request_data['owner_id'] = auth()->user()->id;

        if ($request->logo) {
            $request_data['image'] = $this->uploadImage($request->logo, 'app_settings_images');
        }

        $setting = $this->model->create($request_data);
        User::where('id', auth()->user()->id)->update(['app_setting_id'=>$setting->id]);

        session()->flash('success', __('site.app_info_added_successfully'));

        return redirect()->back();
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
        $appSetting = $this->model->findOrFail($id);
        $rules = [
            'email' => 'required|string|email|max:191|unique:app_settings,email,'.$appSetting->id,
            'phone' => 'required|regex:/^\+?\d[0-9-]{9,11}$/|unique:app_settings,phone,'.$appSetting->id,
            'logo' => 'nullable|image|max:2000',         
            'facebook_link'=>'nullable|string|max:191',
            'twitter_link'=>'nullable|string|max:191',
            'instagram_link'=>'nullable|string|max:191',
            'youtube_link'=>'nullable|string|max:191',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => 'required|string|min:3|max:200',
                $locale . '.description' => 'nullable|string|min:3|max:500',
                $locale . '.about_us' => 'nullable|string|min:3|max:500',
                $locale . '.privacy_policy' => 'nullable|string|min:3|max:500',
            ];
        }

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
			return redirect()->back()->with(["updateAppInfoErrorMessage" => $validator->errors()->first()]);

        $request_data = $request->except(['_token', 'logo']);
        $request_data['owner_id'] = auth()->user()->id;

        if ($request->logo) {
            if ($appSetting->image != null) {
                Storage::disk('public_uploads')->delete('app_settings_images/' . $appSetting->image);
            }
            $request_data['image'] = $this->uploadImage($request->logo, 'app_settings_images');
        } //end of if

        $appSetting->update($request_data);
        session()->flash('success', __('site.app_updated_successfully'));
  
        return redirect()->back();
    }
}
