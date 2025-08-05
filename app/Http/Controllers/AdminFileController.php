<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileDownload;
use App\Models\Log;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminFileController extends Controller
{
    /**
     * Display uploaded files with pagination.
     */
    public function index()
    {
        $files = File::with('downloads')->paginate(10); // ✅ Use pagination
        return view('admin.files.index', compact('files'));
    }

    /**
     * Show the file upload form.
     */
    public function create()
    {
        return view('admin.files.create');
    }

    /**
     * Store uploaded file and log action.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $fileSize = $file->getSize(); // ✅ Get file size
        $filePath = $file->storeAs('uploads', $fileName, 'public'); // ✅ Store in public disk

        File::create([
            'name' => $fileName,
            'size' => $fileSize, // ✅ Store file size
            'path' => $filePath, // ✅ Store file path
        ]);

        // ✅ Log file upload action
        Log::create([
            'user_id' => auth()->id(),
            'action' => "Uploaded file: {$fileName}",
        ]);

        return redirect()->route('admin.files.index')->with('success', 'File uploaded successfully.');
    }

    /**
     * Download a file and log the download action.
     */
    public function download($id)
    {
        $file = File::findOrFail($id);

        if (!$file->path) {
            return redirect()->route('admin.files.index')->with('error', 'File path is missing.');
        }

        $filePath = storage_path('app/public/' . $file->path); // ✅ Corrected path

        if (!Storage::disk('public')->exists($file->path)) {
            return redirect()->route('admin.files.index')->with('error', 'File not found.');
        }

        // ✅ Log file download
        FileDownload::create([
            'file_id' => $file->id,
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Downloaded file: {$file->name}",
        ]);

        return response()->download($filePath);
    }

    /**
     * Delete a file and log action.
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        if ($file->path && Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path); // ✅ Use Laravel Storage delete
        }

        $fileName = $file->name;
        $file->delete();

        // ✅ Log file deletion
        Log::create([
            'user_id' => auth()->id(),
            'action' => "Deleted file: {$fileName}",
        ]);

        return redirect()->route('admin.files.index')->with('success', 'File deleted successfully.');
    }

    /**
     * Display file download report with filtering.
     */
    public function downloadReport(Request $request)
    {
        // Fetch all users for the dropdown filter
        $allUsers = User::all();

        // Get filter parameters
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $userId = $request->input('user_id');

        // Start query with relationships
        $query = File::with(['downloads.user']);

        // Apply filters
        if ($dateFrom) {
            $query->whereHas('downloads', function ($q) use ($dateFrom) {
                $q->whereDate('created_at', '>=', $dateFrom);
            });
        }
        if ($dateTo) {
            $query->whereHas('downloads', function ($q) use ($dateTo) {
                $q->whereDate('created_at', '<=', $dateTo);
            });
        }
        if ($userId) {
            $query->whereHas('downloads', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }

        // Paginate results
        $files = $query->paginate(10);

        return view('admin.reports.download_report', compact('files', 'allUsers', 'dateFrom', 'dateTo', 'userId'));
    }

    /**
     * Export file download report to PDF.
     */
    public function exportDownloadReport()
    {
        $files = File::with('downloads.user')->get();
        $pdf = Pdf::loadView('admin.reports.download_report_pdf', compact('files'));

        // ✅ Log report export action
        Log::create([
            'user_id' => auth()->id(),
            'action' => "Exported download report as PDF",
        ]);

        return $pdf->download('download_report_' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Display system logs with pagination.
     */
    public function logs()
    {
        $logs = Log::latest()->paginate(10); // ✅ Paginate logs
        return view('admin.logs', compact('logs'));
    }
}
