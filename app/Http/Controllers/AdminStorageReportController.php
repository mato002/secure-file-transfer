<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    /**
     * Show Storage Usage Report with Filters
     */
    public function storageUsageReport(Request $request)
    {
        $allUsers = User::all();
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $userId = $request->input('user_id');

        $query = File::query();

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        if ($userId) {
            $query->where('user_id', $userId);
        }

        $files = $query->select('name', 'size', 'created_at')->get();
        $totalStorageUsed = $query->sum('size');

        // Convert bytes to MB
        $totalStorageUsedMB = number_format($totalStorageUsed / (1024 * 1024), 2);

        return view('admin.reports.storage_usage', compact('allUsers', 'files', 'totalStorageUsedMB'));
    }

    /**
     * Export Storage Usage Report as PDF
     */
    public function exportStorageUsageReport(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $userId = $request->input('user_id');

        $query = File::query();

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        if ($userId) {
            $query->where('user_id', $userId);
        }

        $files = $query->select('name', 'size', 'created_at')->get();
        $totalStorageUsed = $query->sum('size');

        // Convert bytes to MB
        $totalStorageUsedMB = number_format($totalStorageUsed / (1024 * 1024), 2);

        $pdf = Pdf::loadView('admin.reports.export_storage_usage', compact('files', 'totalStorageUsedMB'));

        return $pdf->download('storage_usage_report.pdf');
    }

    /**
     * Show Overall Storage Report
     */
    public function storageReport()
    {
        $files = File::all();

        if ($files->isEmpty()) {
            $storageUsage = (object) [
                'total_files' => 0,
                'total_size' => 0,
                'average_size' => 0,
                'largest_file' => 0,
                'smallest_file' => 0,
                'last_upload_date' => null,
            ];
        } else {
            $totalSize = $files->sum('size');
            $averageSize = $files->avg('size');
            $largestFile = $files->max('size');
            $smallestFile = $files->min('size');
            $lastUploadDate = $files->max('created_at');

            $storageUsage = (object) [
                'total_files' => $files->count(),
                'total_size' => number_format($totalSize / (1024 * 1024), 2), // Convert to MB
                'average_size' => number_format($averageSize / 1024, 2), // Convert to KB
                'largest_file' => number_format($largestFile / (1024 * 1024), 2), // Convert to MB
                'smallest_file' => number_format($smallestFile / 1024, 2), // Convert to KB
                'last_upload_date' => $lastUploadDate ? Carbon::parse($lastUploadDate)->format('d M Y, H:i A') : 'N/A',
            ];
        }

        return view('admin.reports.storage_report', compact('storageUsage'));
    }
}
