<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'user_id',
        'size',
    ];

    // Ensure that size is cast as an integer or float
    protected $casts = [
        'size' => 'integer', // If 'size' is stored as an integer (bytes)
    ];

    /**
     * Relationship to the user who uploaded the file (admin or regular user)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Ensure 'user_id' exists in the files table
    }

    /**
     * Relationship with file downloads
     */
    public function downloads()
    {
        return $this->hasMany(FileDownload::class, 'file_id');
    }

    /**
     * Helper: Get total download count
     */
    public function getDownloadCountAttribute()
    {
        return $this->downloads()->count();
    }

    /**
     * Scope: Get files uploaded by admins only
     */
    public function scopeUploadedByAdmins($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('role', 'admin');
        });
    }

    /**
     * Scope: Get files uploaded by regular users only
     */
    public function scopeUploadedByRegularUsers($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('role', 'user');
        });
    }

    /**
     * Helper function to format the file size in a readable format (KB, MB, GB)
     */
    public function getFormattedSizeAttribute()
    {
        $size = $this->size;

        if ($size < 1024) {
            return $size . ' bytes';
        } elseif ($size < 1048576) {
            return round($size / 1024, 2) . ' KB';
        } elseif ($size < 1073741824) {
            return round($size / 1048576, 2) . ' MB';
        } else {
            return round($size / 1073741824, 2) . ' GB';
        }
    }
}
