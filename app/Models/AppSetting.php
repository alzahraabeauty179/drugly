<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name', 'description', 'about_us', 'privacy_policy'];

    protected $guarded = [];

    protected $append = ['image_path'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/app_settings_images/'.$this->image) :  asset('uploads/app_settings_images/default.jpg') ;
    }
}
