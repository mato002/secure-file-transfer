<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // Import the Notifiable trait
use Illuminate\Auth\Passwords\CanResetPassword; // Import CanResetPassword trait

class RegularUser extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword; // Add CanResetPassword trait

    protected $fillable = ['name', 'email', 'password', 'profile_image'];
    protected $hidden = ['password'];

    // app/Models/RegularUser.php
public function downloads()
{
    return $this->hasMany(FileDownload::class, 'regular_user_id');
}



}

