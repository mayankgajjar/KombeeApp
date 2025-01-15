<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class,'state_id', 'id');
    }
    
}
