<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersFiles extends Model
{
    use HasFactory;

    protected $table = 'users_file';

    protected $fillable = [
        'user_id','file_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Define the inverse relationship
    }
}
