<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Advertisement extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['title', 'content'];

    protected $guarded = [];

    protected $appends = ['image_path', 'creater_name'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/advertisements_images/'.$this->image) :  asset('uploads/advertisements_images/default.jpg') ;
    }

	public function creater(){
        return $this->belongsTo(\App\User::class, 'created_by');
    }

	public function getCreaterNameAttribute(){
        return is_null($this->created_by) ?: $this->creater->name;
    }

	public function owner(){
        return $this->belongsTo(\App\User::class, 'owner_id');
    }
    
}
