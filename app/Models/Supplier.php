<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'name','contact_number','address','state_id','city_id'
    ];

    public function state()
    {
        return $this->hasOne(State::class, 'id','state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id','city_id');
    }
}
