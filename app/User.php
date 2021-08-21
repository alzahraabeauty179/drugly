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
    protected $guarded = [];

    protected $append = ['image_path', 'national_id_image_path', 'license_image_path'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/users_images/'.$this->image) :  asset('dashboard_files/app-assets/images/portrait/small/avatar-s-1.png') ;
    }

	public function getNationalIdImagePathAttribute(){
        return $this->national_id_image != null ? asset('uploads/users_images/'.$this->national_id_image) :  asset('dashboard_files/app-assets/images/carousel/06.jpg') ;
    }

	public function getLicenseImagePathAttribute(){
        return $this->license_image != null ? asset('uploads/users_images/'.$this->license_image) :  asset('dashboard_files/app-assets/images/carousel/06.jpg') ;
    }

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

}
