<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\File;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Import for PDF generation

class AdminLogsController extends Controller
{
    /**
     * Display the logs list with pagination & filtering.
     */
    public function index(Request $request)
    {
        $query = Log::orderBy('created_at', 'desc');

        // Filter logs by action if provided
        if ($request->has('action')) {  // ✅ Fixed column name
            $query->where('action', $request->action);
        }

        // Filter logs by user ID if provided
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $logs = $query->paginate(20); // ✅ Ensures pagination works

        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Display system reports with useful statistics.
     */
    public function reports()
    {
        $totalFiles = File::count();
        $totalUsers = User::count();
        $totalLogs = Log::count();
        $latestLogs = Log::latest()->take(5)->get(); // Fetch last 5 logs

        return view('admin.logs.reports', compact('totalFiles', 'totalUsers', 'totalLogs', 'latestLogs'));
    }

    /**
     * Export logs as a PDF report.
     */
    public function exportLogsToPDF()
    {
        $logs = Log::orderBy('created_at', 'desc')->get(); // ✅ Fetch all logs for export
        $pdf = Pdf::loadView('admin.logs.logs_pdf', compact('logs'));

        return $pdf->download('system_logs_' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Clear logs from the database.
     */
    public function clearLogs()
    {
        Log::truncate(); // ✅ Deletes all logs

        return redirect()->route('admin.logs.index')->with('success', 'All logs have been cleared.');
    }
}
