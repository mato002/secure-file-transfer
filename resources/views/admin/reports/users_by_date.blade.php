@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Users Registered from {{ $startDate ?? 'Start Date' }} to {{ $endDate ?? 'End Date' }}</h2>

    <!-- Filtering Form -->
    <form action="{{ route('admin.users.report') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="startDate" class="form-label">Start Date:</label>
                <input type="date" id="startDate" name="startDate" value="{{ request('startDate') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="endDate" class="form-label">End Date:</label>
                <input type="date" id="endDate" name="endDate" value="{{ request('endDate') }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection
