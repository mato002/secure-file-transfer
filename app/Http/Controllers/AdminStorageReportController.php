<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\User;
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

        // Build the query
        $query = File::query();
        
        if ($dateFrom) $query->whereDate('created_at', '>=', $dateFrom);
        if ($dateTo) $query->whereDate('created_at', '<=', $dateTo);
        if ($userId) $query->where('user_id', $userId);

        // Get basic counts
        $totalFiles = $query->count();
        
        // Always define all array keys, even when empty
        $storageUsage = [
            'total_files' => $totalFiles,
            'total_size' => 0,
            'average_size' => 0,
            'largest_file' => 0,
            'smallest_file' => 0,
            'last_upload_date' => null,
            'peak_upload_date' => null,
        ];
        
        // If there are files, get additional metrics
        if ($totalFiles > 0) {
            $storageUsage['total_size'] = $query->sum('size');
            $storageUsage['average_size'] = $query->avg('size');
            $storageUsage['largest_file'] = $query->max('size');
            $storageUsage['smallest_file'] = $query->min('size');
            $storageUsage['last_upload_date'] = $query->max('created_at');
            
            // Get peak upload date
            $peakQuery = File::query();
            if ($dateFrom) $peakQuery->whereDate('created_at', '>=', $dateFrom);
            if ($dateTo) $peakQuery->whereDate('created_at', '<=', $dateTo);
            if ($userId) $peakQuery->where('user_id', $userId);
            
            $peakUploadDate = $peakQuery->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderByDesc('count')
                ->value('date');
                
            $storageUsage['peak_upload_date'] = $peakUploadDate;
        }

        return view('admin.reports.storage_usage', compact('allUsers', 'storageUsage'));
    }

    /**
     * Export Storage Usage Report as CSV
     */
    public function exportStorageUsageReport(Request $request)
    {
        // Implementation for CSV export
        // This would follow the same pattern as above
    }

    /**
     * Show Overall Storage Report
     */
    public function storageReport()
    {
        $totalFiles = File::count();
        
        // Always define all array keys
        $storageUsage = [
            'total_files' => $totalFiles,
            'total_size' => 0,
            'average_size' => 0,
            'largest_file' => 0,
            'smallest_file' => 0,
            'last_upload_date' => null,
        ];
        
        // If there are files, get additional metrics
        if ($totalFiles > 0) {
            $storageUsage['total_size'] = File::sum('size');
            $storageUsage['average_size'] = File::avg('size');
            $storageUsage['largest_file'] = File::max('size');
            $storageUsage['smallest_file'] = File::min('size');
            $storageUsage['last_upload_date'] = File::max('created_at');
        }

        return view('admin.reports.storage_report', compact('storageUsage'));
    }
}