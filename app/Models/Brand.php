<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    protected $append = ['image_path'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/brands_images/'.$this->image) :  asset('uploads/brands_images/default.png') ;
    }

}
