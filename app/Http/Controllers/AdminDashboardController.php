<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;
use App\Models\FileDownload;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalFiles = File::count();
        $totalDownloads = FileDownload::count(); // ✅ Total number of downloads

        // Get monthly download trends for the chart
        $monthlyDownloads = FileDownload::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_downloads')
        )->groupBy('month')->orderBy('month')->get();

        // Format data for the chart (Make sure all months are represented)
        $downloadsData = array_fill(0, 12, 0); // 12 months (Jan-Dec)
        foreach ($monthlyDownloads as $data) {
            $downloadsData[$data->month - 1] = $data->total_downloads;
        }

        return view('admin.dashboard', compact('totalUsers', 'totalFiles', 'totalDownloads', 'downloadsData'));
    }
}
