<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Owner extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['title', 'name', 'address'];
    protected $guarded = [];


    protected $append = ['image_path'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/owner_images/'.$this->image) :  asset('uploads/owner_images/default.png') ;
    }
}