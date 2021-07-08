<?php

namespace App;

use App\Models\Work;
use App\Scopes\AuthScope;
use App\Scopes\AuthUserScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use Notifiable, LaratrustUserTrait, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function work()
    {
        return $this->hasMany(Work::class);
    }

    public function latestWork()
    {
        return $this->hasOne(Work::class)->latest();
    }
    public function allSum($col)
    {
        return $this->work->sum($col);
    }

    public function scopeActive($query)
    {

        if (auth()->user()->type == 1 && auth()->user()->id == 1) {
            $query->where('id', '>=', 1);
        } else if (auth()->user()->type == 1) {
            $query->where('id', '>', 1);
        } else {
            $query->where('id', auth()->user()->id);
        }
    }
}
