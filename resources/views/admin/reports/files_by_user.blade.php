@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Files Uploaded by User</h2>

    <!-- Filtering Form -->
    <form action="{{ route('admin.files.report') }}" method="GET" class="mb-3">
        <div class="row">
            <!-- Start Date Filter -->
            <div class="col-md-4">
                <label for="startDate" class="form-label">Start Date:</label>
                <input type="date" id="startDate" name="startDate" value="{{ request('startDate') }}" class="form-control">
            </div>

            <!-- End Date Filter -->
            <div class="col-md-4">
                <label for="endDate" class="form-label">End Date:</label>
                <input type="date" id="endDate" name="endDate" value="{{ request('endDate') }}" class="form-control">
            </div>

            <!-- User Filter -->
            <div class="col-md-4">
                <label for="user_id" class="form-label">Select User:</label>
                <select id="user_id" name="user_id" class="form-control">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Files Table -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>File Name</th>
                <th>Size</th>
                <th>Uploaded On</th>
                <th>Management Decision / Conclusion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <td>{{ $file->id }}</td>
                <td>{{ $file->name }}</td>
                <td>{{ formatSizeUnits($file->size) }}</td>
                <td>{{ $file->created_at->format('Y-m-d') }}</td>
                <td>
                    @php
                        $uploadDate = \Carbon\Carbon::parse($file->created_at);
                        $recentThreshold = \Carbon\Carbon::now()->subDays(7);
                        $conclusion = '';

                        if ($uploadDate->greaterThan($recentThreshold)) {
                            $conclusion = 'User is actively uploading files';
                        } elseif ($file->size > 5 * 1024 * 1024) {
                            $conclusion = 'Large file; check for storage optimization';
                        } else {
                            $conclusion = 'Normal upload activity';
                        }
                    @endphp
                    {{ $conclusion }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $files->links() }}
    </div>
</div>
@endsection
