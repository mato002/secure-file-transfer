<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLogs extends Model
{
    use HasFactory;

    protected $table = 'logs'; // Ensure it matches your database table name

    protected $fillable = ['user_id', 'action', 'ip_address', 'logged_at'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
