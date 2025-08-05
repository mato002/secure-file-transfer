<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RegularUserController extends Controller
{
    // Show all files available for download (uploaded by the admin)
    public function files()
    {
        // Fetch files uploaded by the admin (assuming role = 'admin')
        $files = File::whereHas('user', function ($query) {
            $query->where('role', 'admin'); // Ensure the user role is admin
        })->paginate(10); // Show 10 files per page

        return view('regular_user.files', compact('files'));
    }

    public function submitContact(Request $request)
{
    // Validate form input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Process the form (e.g., store it in the database or send an email)
    return back()->with('success', 'Message sent successfully.');
}


    // Handle file downloads
    public function download($id)
    {
        $file = File::findOrFail($id); // Ensure the file exists
    
        $filePath = storage_path('app/public/uploads/' . $file->filename);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } 

        return redirect()->back()->with('error', 'File not found.');
    }
}
