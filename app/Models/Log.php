<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
   	/**
     * @var string[]  fillable
     */
    protected $fillable = [
    	'log_type',
    	'log_id',
    	'message',
    	'action_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actionBy() : BelongsTo
    {
        return $this->BelongsTo(\App\User::class ,'action_by');
    }

}
