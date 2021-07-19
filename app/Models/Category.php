<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    protected $appends = ['image_path', 'parent_name'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/categories_images/'.$this->image) :  asset('uploads/categories_images/default.png') ;
    }

    public function parent(){
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function child(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getParentNameAttribute(){
        return $this->parent_id == null ? null : $this->child->name ;
    }

}
