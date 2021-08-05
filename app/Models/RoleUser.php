<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleUser extends Model
{
    protected $table   = "role_user";
    public $timestamps = false;

    /**
     * @var string[]  fillable
     */
    protected $fillable = [
        'user_id',
        'role_id',
        'user_type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->BelongsTo(\App\User::class ,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() : BelongsTo
    {
        return $this->BelongsTo(\App\Role::class ,'role_id');
    }
}
