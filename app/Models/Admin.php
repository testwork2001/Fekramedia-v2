<?php

namespace App\Models;

use App\Services\MediaService;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin  extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable , InteractsWithMedia , MediaService;

    protected $password = 'admins_password_resets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'email_verified_at' ,
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      /**
     * Get an Admin status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == '1'? ['bg-success','Active'] : ['bg-danger','Not Active'] ,
        );
    }

     /**
     * Get an Admin email verified at.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function emailVerifiedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? ['bg-success','Verified'] : ['bg-danger','Not Verified'] ,
        );
    }
}
