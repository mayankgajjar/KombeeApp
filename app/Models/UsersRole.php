<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    use HasFactory;

    protected $table = 'users_role';

    protected $fillable = [
        'user_id','role_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Define the inverse relationship
    }
}
