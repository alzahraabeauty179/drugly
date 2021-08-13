<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLog extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['unit'];

    protected $guarded = [];

    protected $append = ['image_path'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/products_images/'.$this->image) :  asset('uploads/products_images/default.png') ;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function parent() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

}
