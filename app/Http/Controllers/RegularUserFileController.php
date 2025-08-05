<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileDownload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegularUserFileController extends Controller
{
    /**
     * Display all available files (not just admin's)
     */
    public function index()
    {
        // Get all files with their uploaders
    $files = File::with('user')->latest()->paginate(10);

        return view('regular_users.download_files', compact('files'));
    }

    /**
     * Download a file
     */
    public function download($id)
    {
        $file = File::with('user')->findOrFail($id);

        // Verify file exists in storage
        if (!Storage::disk('public')->exists($file->path)) {
            return back()->with('error', 'File not found in storage');
        }

        // Log the download
        FileDownload::create([
            'file_id' => $file->id,
            'ip_address' => request()->ip()
        ]);

        return Storage::disk('public')->download($file->path, $file->name);
    }
}