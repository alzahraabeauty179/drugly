<?php

namespace App\Models;

use App\Scopes\TypeScope;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];




    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TypeScope);
    }
}
