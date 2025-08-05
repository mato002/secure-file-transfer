<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural of the model name
    protected $table = 'activities';

    // Define fillable attributes
    protected $fillable = [
        // List your fillable columns here
    ];
}
