@extends('layouts.admin')

@section('title', 'File Transfer Report')

@section('content')
    <h2 class="text-3xl font-semibold text-gray-900 dark:text-white text-center mb-6">
        <i class="fas fa-chart-bar"></i> File Transfer Report
    </h2>

    <!-- Filtering Form -->
    <form method="GET" action="{{ route('admin.reports.file_transfer.index') }}" class="filter-form">
        <label for="date_from">From:</label>
        <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}">

        <label for="date_to">To:</label>
        <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}">

        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            <option value="">All Users</option>
            @if(isset($usersList) && count($usersList) > 0)
                @foreach($usersList as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            @endif
        </select>

        <button type="submit" class="btn-filter">
            <i class="fas fa-search"></i> Filter
        </button>
        <a href="{{ route('admin.reports.file_transfer.index') }}" class="btn-reset">
            <i class="fas fa-sync-alt"></i> Reset
        </a>
    </form>

    <!-- Export to PDF Button -->
    <a href="{{ route('admin.reports.file_transfer.export', request()->all()) }}" class="btn-export">
        <i class="fas fa-file-pdf"></i> Export as PDF
    </a>

    <!-- File Transfer Table -->
    <div class="table-container">
        <table class="file-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Uploaded Files</th>
                    <th>Downloaded Files</th>
                    <th>Activity Level</th>
                    <th>Upload:Download Ratio</th>
                    <th>Top Action</th>
                    <th>Management Decision / Conclusion</th>
                    <th>Engagement Suggestion</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($allUsers) && count($allUsers) > 0)
                    @foreach($allUsers as $user)
                        @php
                            $uploads = $user->files ? $user->files->count() : 0;
                            $downloads = 0; // you can replace with actual downloads count
                            $totalActivity = $uploads + $downloads;

                            if ($uploads == 0 && $downloads == 0) {
                                $conclusion = 'Inactive – Engage user or review access';
                            } elseif ($uploads > $downloads) {
                                $conclusion = 'High contribution – Recognize active uploader';
                            } elseif ($downloads > $uploads) {
                                $conclusion = 'High demand – Monitor for access trends';
                            } else {
                                $conclusion = 'Balanced activity – Normal usage';
                            }

                            $activityLevel = $totalActivity == 0 ? 'None' : ($totalActivity < 5 ? 'Low' : ($totalActivity < 15 ? 'Moderate' : 'High'));
                            $ratio = $downloads != 0 ? number_format($uploads / $downloads, 2) : ($uploads > 0 ? '∞' : '0');
                            $topAction = $uploads > $downloads ? 'Uploader' : ($downloads > $uploads ? 'Downloader' : 'Balanced');

                            if ($totalActivity == 0) {
                                $suggestion = 'Send welcome email or usage tips';
                            } elseif ($uploads == 0) {
                                $suggestion = 'Encourage file sharing';
                            } elseif ($downloads == 0) {
                                $suggestion = 'Suggest useful downloads';
                            } else {
                                $suggestion = 'No action needed';
                            }
                        @endphp
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $uploads }}</td>
                            <td>{{ $downloads }}</td>
                            <td>{{ $activityLevel }}</td>
                            <td>{{ $ratio }}</td>
                            <td>{{ $topAction }}</td>
                            <td>{{ $conclusion }}</td>
                            <td>{{ $suggestion }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="no-records">No records found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

@endsection

@push('styles')
<style>
    .file-table {
        width: 100%;
        border-collapse: collapse;
    }
    .file-table th,
    .file-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .btn-filter,
    .btn-reset,
    .btn-export {
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        margin-right: 10px;
    }
    .btn-filter:hover,
    .btn-reset:hover,
    .btn-export:hover {
        background-color: #45a049;
    }
    .no-records {
        text-align: center;
        color: #888;
    }
</style>
@endpush
