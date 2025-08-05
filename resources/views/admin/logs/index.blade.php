@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">System Logs</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.logs.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="user_id" class="form-control" placeholder="Filter by User ID" value="{{ request('user_id') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="action_type" class="form-control" placeholder="Filter by Action Type" value="{{ request('action_type') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Logs Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Action</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->user_id }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
   <!-- Pagination -->
@if ($logs->hasPages()) <!-- ✅ Check if pagination exists -->
    <div class="mt-3">
        {{ $logs->links() }}
    </div>
@endif


    <!-- Export & Clear Logs -->
    <div class="mt-4">
        <a href="{{ route('admin.logs.export') }}" class="btn btn-success">Export to PDF</a>
        <form action="{{ route('admin.logs.clear') }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all logs?')">Clear Logs</button>
        </form>
    </div>
</div>
@endsection
