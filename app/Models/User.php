<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "firstname","lastname",'name','email','password','postcode',
        'gender','contact_number','remember_token','state_id','city_id'
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

    public function state()
    {
        return $this->hasOne(State::class, 'id','state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id','city_id');
    }

    public function hobbie()
    {
        return $this->hasMany(UsersHobbie::class);
    }

    public function role()
    {
        return $this->hasMany(UsersRole::class);
    }

    public function file()
    {
        return $this->hasMany(UsersFiles::class);
    }
}
