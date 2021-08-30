<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{  
    /**
     * @var string[]  fillable
     */
    protected $fillable = [
        'from_id',
        'to_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from() : BelongsTo
    {
        return $this->BelongsTo(\App\User::class ,'from_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to() : BelongsTo
    {
        return $this->BelongsTo(\App\User::class ,'to_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts() : HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
