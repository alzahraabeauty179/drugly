<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stagnant extends Model
{
    protected $guarded = [];


    protected $append = ['image_path'];

    public function getImagePathAttribute()
    {
        return $this->image != null ? asset('uploads/stagnants_images/' . $this->image) :  asset('uploads/stagnants_images/default.png');
    }
}
