<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RegularUser;
use App\Models\File;
use App\Models\FileTransferActivity;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function fileTransferReport(Request $request)
    {
        // Uploads by Users
        $uploadsQuery = User::with(['files' => function ($query) use ($request) {
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }
        }]);

        if ($request->filled('user_id')) {
            $uploadsQuery->where('id', $request->user_id);
        }

        $uploads = $uploadsQuery->get();

        // Downloads by RegularUsers
        $downloadsQuery = RegularUser::with(['downloads' => function ($query) use ($request) {
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }
        }]);

        if ($request->filled('regular_user_id')) {
            $downloadsQuery->where('id', $request->regular_user_id);
        }

        $downloads = $downloadsQuery->get();

        $allUsers = User::select('id', 'name', 'email')->get();
        $allRegularUsers = RegularUser::select('id', 'name', 'email')->get();

        return view('admin.reports.file_transfer', compact('uploads', 'downloads', 'allUsers', 'allRegularUsers'));
    }

    public function exportFileTransferReportToPDF(Request $request)
    {
        $uploadsQuery = User::with(['files' => function ($query) use ($request) {
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }
        }]);

        if ($request->filled('user_id')) {
            $uploadsQuery->where('id', $request->user_id);
        }

        $uploads = $uploadsQuery->get();

        $downloadsQuery = RegularUser::with(['downloads' => function ($query) use ($request) {
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }
        }]);

        if ($request->filled('regular_user_id')) {
            $downloadsQuery->where('id', $request->regular_user_id);
        }

        $downloads = $downloadsQuery->get();

        if ($uploads->isEmpty() && $downloads->isEmpty()) {
            return back()->with('error', 'No records found for the selected filters.');
        }

        $pdf = Pdf::loadView('admin.reports.file_transfer_pdf', compact('uploads', 'downloads'));

        return $pdf->download('file_transfer_report_' . now()->format('Y-m-d') . '.pdf');
    }

    public function storageUsageReport(Request $request)
    {
        $query = File::query();

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $files = $query->get();

        $storageUsage = $files->groupBy('user_id')->map(function ($group) {
            return [
                'total_files' => $group->count(),
                'total_size_mb' => round($group->sum('size') / 1024 / 1024, 2),
                'files' => $group
            ];
        });

        $allUsers = User::select('id', 'name', 'email')->get();

        return view('admin.reports.storage_usage', compact('storageUsage', 'allUsers'));
    }

    public function exportStorageUsageReportToPDF(Request $request)
    {
        $query = File::query();

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $files = $query->get();

        if ($files->isEmpty()) {
            return back()->with('error', 'No storage usage records found for the selected filters.');
        }

        $storageUsage = $files->groupBy('user_id')->map(function ($group) {
            return [
                'total_files' => $group->count(),
                'total_size_mb' => round($group->sum('size') / 1024 / 1024, 2),
                'files' => $group
            ];
        });

        $pdf = Pdf::loadView('admin.reports.storage_usage_pdf', compact('storageUsage'));

        return $pdf->download('storage_usage_report_' . now()->format('Y-m-d') . '.pdf');
    }
}
