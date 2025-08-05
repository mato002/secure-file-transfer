@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>System Reports</h2>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Files</div>
                <div class="card-body">
                    <h3>{{ $totalFiles }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Logs</div>
                <div class="card-body">
                    <h3>{{ $totalLogs }}</h3>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-5">Recent Logs</h4>
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
            @foreach($latestLogs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->user_id }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
