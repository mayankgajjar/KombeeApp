<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersHobbie extends Model
{
    use HasFactory;

    protected $table = 'users_hobbie';

    protected $fillable = [
        'user_id','hobbie'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Define the inverse relationship
    }
}
