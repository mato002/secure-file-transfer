<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;
use App\Models\Log; // Unused, but I'll leave it.
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log as LaravelLog;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class AdminController extends Controller
{
    // ✅ Show Admin Login Form
    public function showLoginForm()
    {
        return view('admin.auth.login'); // Make sure this view exists
    }

    // ✅ Handle Admin Login
    public function login(Request $request)
    {
        LaravelLog::info('AdminController@login called');  // Added logging
        LaravelLog::info('Request data: ' . json_encode($request->all()));

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (Auth::guard('admin')->attempt($credentials)) { // Changed to 'admin' guard
                LaravelLog::info('Admin authentication successful');
                return redirect()->route('admin.dashboard');
            } else {
                LaravelLog::warning('Admin authentication failed');
                return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
            }
        } catch (\Exception $e) {
            LaravelLog::error('Exception in AdminController@login: ' . $e->getMessage());
            return abort(500, 'Login error. Check logs.'); // More specific message
        }
    }

    // ✅ Handle Admin Logout
    public function logout()
    {
        Auth::guard('admin')->logout(); // Specify the 'admin' guard
        return redirect()->route('admin.login');
    }

    // ✅ Render the Admin Dashboard
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalFiles = File::count();
        $totalDownloads = File::sum('downloads'); // Assuming 'downloads' column tracks downloads

        // Generate user registration chart data
        $userChartLabels = User::selectRaw('MONTHNAME(created_at) as month')
            ->groupBy('month')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('month')
            ->toArray();

        $userChartData = User::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('count')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalFiles',
            'totalDownloads',
            'userChartLabels',
            'userChartData'
        ));
    }

    // ✅ Show all uploaded files with pagination
    public function index()
    {
        $files = File::paginate(10);
        return view('admin.files.index', compact('files'));
    }

    // ✅ Handle file upload
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:5120', // 5MB max file size
        ]);

        try {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public');
            $fileSize = Storage::disk('public')->size($filePath);

            LaravelLog::info("File Uploaded - Name: " . $file->getClientOriginalName() . ", Size: " . $fileSize . " bytes");

            File::create([
                'name'    => $file->getClientOriginalName(),
                'path'    => $filePath,
                'size'    => $fileSize,
                'user_id' => Auth::guard('admin')->id(), // Use admin guard id
            ]);
        } catch (\Exception $e) {
            LaravelLog::error('File upload failed: ' . $e->getMessage());
            return back()->withErrors(['file' => 'File upload failed.'])->withInput(); // Inform the user
        }


        return redirect()->route('admin.files.index')->with('success', '✅ File uploaded successfully.');
    }

    // ✅ Download a file
    public function download($id)
    {
        $file = File::findOrFail($id);
        $filePath = storage_path("app/public/{$file->path}");

        if (!file_exists($filePath)) {
            LaravelLog::warning("File not found: {$filePath}");
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->download($filePath, $file->name);
    }

    // ✅ Delete a file
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        try {
            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
            }

            $file->delete();
        } catch (\Exception $e) {
            LaravelLog::error('File deletion failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete file.'])->withInput();
        }


        return redirect()->route('admin.files.index')->with('success', '✅ File deleted successfully.');
    }

    // ==============================================
    // 🔎 QUERY HANDLING METHODS
    // ==============================================

    // ✅ 1. Fetch Users Registered Between Specific Dates
    public function usersByDate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $users = User::whereBetween('created_at', [$startDate, $endDate])->get();
            $allUsers = User::all(); // 🔹 FIXED: Ensure $allUsers is available
        } catch (\Exception $e) {
            LaravelLog::error('Error fetching users by date: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to fetch users.'])->withInput();
        }


        return view('admin.reports.users_by_date', compact('users', 'startDate', 'endDate', 'allUsers'));
    }

    // ✅ 2. Get All Files Uploaded by a Specific User
    public function filesByUser(Request $request)
    {
        $userId = $request->input('user_id');
        try{
            $files = File::where('user_id', $userId)->get();
            $allUsers = User::all(); // 🔹 FIXED: Ensure $allUsers is available
        } catch(\Exception $e){
            LaravelLog::error('Error fetching files by user: ' . $e->getMessage());
             return back()->withErrors(['error' => 'Failed to fetch files.'])->withInput();
        }


        return view('admin.reports.files_by_user', compact('files', 'allUsers'));
    }

    // ✅ 3. Get Total File Downloads per User
    public function downloadsByUser()
    {
        try{
            $downloads = User::withSum('files', 'downloads')->get();
            $allUsers = User::all(); // 🔹 FIXED: Ensure $allUsers is available
        } catch(\Exception $e){
            LaravelLog::error('Error fetching downloads by user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to fetch downloads.'])->withInput();
        }


        return view('admin.reports.downloads_by_user', compact('downloads', 'allUsers'));
    }

    // ✅ 4. Search for Files by Name
    public function searchFiles(Request $request)
    {
        $query = $request->input('query');
        try{
            $files = File::where('name', 'LIKE', "%$query%")->get();
            $allUsers = User::all(); // 🔹 FIXED: Ensure $allUsers is available
        }catch(\Exception $e){
            LaravelLog::error('Error searching files: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to search files.'])->withInput();
        }


        return view('admin.reports.search_results', compact('files', 'query', 'allUsers'));
    }

    // ✅ 5. Generate a Report on Storage Usage
    public function storageUsage()
    {
        try{
            $totalStorage = File::sum('size');
            $totalFiles = File::count();
            $allUsers = User::all(); // 🔹 FIXED: Ensure $allUsers is available
        }catch(\Exception $e){
            LaravelLog::error('Error fetching storage usage: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to get storage usage.'])->withInput();
        }


        return view('admin.reports.storage_usage', compact('totalStorage', 'totalFiles', 'allUsers'));
    }
    // ✅ 6. File Transfer Activity Report
    public function fileTransferReport(Request $request)
    {
        $query = User::with(['files', 'downloads']);

        // Apply filters
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        if ($request->has('user_id') && !empty($request->user_id)) {
            $query->where('id', $request->user_id);
        }
        try{
            $users = $query->paginate(10);
            $allUsers = User::all(); // ✅ Ensure this variable is available in the view
        }catch(\Exception $e){
             LaravelLog::error('Error generating file transfer report: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to generate report.'])->withInput();
        }


        return view('admin.reports.file_transfer', compact('users', 'allUsers'));
    }
}
