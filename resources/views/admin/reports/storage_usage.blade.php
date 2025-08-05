@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- ✅ Updated title with Font Awesome -->
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white text-center mb-6">
        <i class="fas fa-chart-bar"></i> Storage Usage Report
    </h2>

    <!-- ✅ Filtering Form -->
    <form method="GET" action="{{ route('admin.reports.storage_usage.index') }}" class="filter-form mb-6">
        <label for="date_from">From:</label>
        <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" required>

        <label for="date_to">To:</label>
        <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" required>

        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            <option value="">All Users</option>
            @foreach($allUsers as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>

        <!-- ✅ Updated Filter and Reset buttons -->
        <button type="submit" class="btn-filter">
            <i class="fas fa-filter"></i> Filter
        </button>
        <a href="{{ route('admin.reports.storage_usage.index') }}" class="btn-reset">
            <i class="fas fa-sync-alt"></i> Reset
        </a>
    </form>

    <!-- ✅ Storage Usage Table -->
    <div class="table-container overflow-x-auto">
        <table class="table table-bordered w-full text-sm text-left text-gray-900 bg-white shadow rounded">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">Total Files</th>
                    <th class="px-4 py-2">Total Storage Used (MB)</th>
                    <th class="px-4 py-2">Average File Size (KB)</th>
                    <th class="px-4 py-2">Largest File (MB)</th>
                    <th class="px-4 py-2">Smallest File (KB)</th>
                    <th class="px-4 py-2">Last Upload Date</th>
                    <th class="px-4 py-2">Upload Frequency (Files/Day)</th>
                    <th class="px-4 py-2">Peak Usage Date</th>
                    <th class="px-4 py-2">Storage Efficiency (%)</th>
                    <th class="px-4 py-2">Conclusion</th>
                    <th class="px-4 py-2">Suggested Action</th>
                </tr>
            </thead>
            <tbody>
                @if($storageUsage->total_files > 0)
                    @php
                        $largestMB = $storageUsage->largest_file / (1024 * 1024);
                        $averageKB = $storageUsage->average_size / 1024;
                        $totalMB = $storageUsage->total_size / (1024 * 1024);
                        $smallestKB = $storageUsage->smallest_file / 1024;

                        $dateFrom = \Carbon\Carbon::parse(request('date_from'));
                        $dateTo = \Carbon\Carbon::parse(request('date_to'));
                        $days = $dateFrom->diffInDays($dateTo) ?: 1;
                        $uploadFrequency = round($storageUsage->total_files / $days, 2);

                        $efficiency = $storageUsage->largest_file > 0 
                            ? round(($storageUsage->average_size / $storageUsage->largest_file) * 100, 1) 
                            : 0;

                        $peakDate = $storageUsage->peak_upload_date ?? 'N/A';

                        // Decision and Action Logic
                        if ($largestMB > 100) {
                            $conclusion = 'Heavy Usage';
                            $action = 'Archive large files and consider compression.';
                        } elseif ($largestMB > 50) {
                            $conclusion = 'Moderate Usage';
                            $action = 'Monitor and maintain regular backups.';
                        } else {
                            $conclusion = 'Light Usage';
                            $action = 'No immediate action required.';
                        }
                    @endphp
                    <tr class="bg-white border-b">
                        <td class="px-4 py-2">{{ $storageUsage->total_files }}</td>
                        <td class="px-4 py-2">{{ number_format($totalMB, 2) }} MB</td>
                        <td class="px-4 py-2">{{ number_format($averageKB, 2) }} KB</td>
                        <td class="px-4 py-2">{{ number_format($largestMB, 2) }} MB</td>
                        <td class="px-4 py-2">{{ number_format($smallestKB, 2) }} KB</td>
                        <td class="px-4 py-2">{{ $storageUsage->last_upload_date ? \Carbon\Carbon::parse($storageUsage->last_upload_date)->format('d M Y, H:i') : 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $uploadFrequency }}</td>
                        <td class="px-4 py-2">{{ $peakDate }}</td>
                        <td class="px-4 py-2">{{ $efficiency }}%</td>
                        <td class="px-4 py-2">{{ $conclusion }}</td>
                        <td class="px-4 py-2">{{ $action }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="11" class="text-center py-4">No data available for the selected period.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- ✅ Export Buttons -->
    <div class="mt-4 flex gap-3">
        <a href="{{ route('admin.reports.storage_usage.export', request()->all()) }}" class="btn btn-success">
            <i class="fas fa-file-csv"></i> Export as CSV
        </a>
    </div>
</div>
@endsection
