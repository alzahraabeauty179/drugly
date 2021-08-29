<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    public $timestamps = false;
    /**
     * @var string[]  fillable
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'unit',
        'note'
    ];

        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() : BelongsTo
    {
        return $this->BelongsTo(Order::class ,'order_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() : BelongsTo
    {
        return $this->BelongsTo(Product::class ,'product_id');
    }
}
