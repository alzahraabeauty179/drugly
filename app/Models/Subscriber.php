<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscriber extends Model
{

	 /**
     * @var string[]  fillable
     */
    protected $fillable = [
    	'subscription_id',
    	'subscriber_id',
    	'payment_method',
        'status',
        'start_date',
        'end_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->BelongsTo(\App\User::class ,'subscriber_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription() : BelongsTo
    {
        return $this->BelongsTo(Subscription::class ,'subscription_id');
    }
}
