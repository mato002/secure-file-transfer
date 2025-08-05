<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\FileTransferActivity;
use App\Models\Log;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'download']);
    }

    /**
     * Display all files for users (Users can only view/download files).
     */
    public function index()
    {
        $files = File::latest()->paginate(10); // Paginated for better performance
        return view('regular_users.download_files', compact('files'));
    }

    /**
     * Upload a new file (Admin Only).
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:51200', // Max 50MB
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $size = $file->getSize();

        if ($size <= 0) {
            return redirect()->back()->with('error', 'Invalid file size detected. Please try again.');
        }

        // Store file in the "public/uploads" directory
        $path = $file->storeAs('uploads', $filename, 'public');

        // Save file details in the database
        $newFile = File::create([
            'name' => $filename,
            'user_id' => auth()->id(),
            'size' => $size,
        ]);

        // Log file upload action
        Log::create([
            'user_id' => auth()->id(),
            'action' => "Uploaded file: {$filename}",
        ]);

        return redirect()->route('admin.files.index')->with('success', 'File uploaded successfully.');
    }

    /**
     * Download the specified file and log the download.
     */
    public function download($id)
    {
        $file = File::findOrFail($id);
        $filePath = storage_path('app/public/uploads/' . $file->name);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Increment download count
        $file->increment('download_count');

        // Log file download activity
        FileTransferActivity::create([
            'user_id' => Auth::id(),
            'file_name' => $file->name,
            'action' => 'download',
            'download_count' => $file->download_count,
        ]);

        // Log the download action
        Log::create([
            'user_id' => Auth::id(),
            'action' => "Downloaded file: {$file->name}",
        ]);

        return response()->download($filePath, $file->name);
    }

    /**
     * Show the edit form for a file (Admin Only).
     */
    public function edit($id)
    {
        $file = File::findOrFail($id);
        return view('admin.files.edit', compact('file'));
    }

    /**
     * Update the file name (Admin Only).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:files,name,' . $id,
        ]);

        $file = File::findOrFail($id);
        $oldName = $file->name;
        $file->update(['name' => $request->name]);

        // Log file update action
        Log::create([
            'user_id' => auth()->id(),
            'action' => "Renamed file from '{$oldName}' to '{$request->name}'",
        ]);

        return redirect()->route('admin.files.index')->with('success', 'File updated successfully.');
    }

    /**
     * Delete a file (Admin Only).
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        $filePath = storage_path('app/public/uploads/' . $file->name);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $fileName = $file->name;
        $file->delete();

        // Log file deletion action
        Log::create([
            'user_id' => auth()->id(),
            'action' => "Deleted file: {$fileName}",
        ]);

        return redirect()->route('admin.files.index')->with('success', 'File deleted successfully.');
    }

    /**
     * Display system logs (Admin Only).
     */
    public function logs()
    {
        $logs = Log::latest()->paginate(10); // Paginate logs for better performance
        return view('admin.logs', compact('logs'));
    }
}
