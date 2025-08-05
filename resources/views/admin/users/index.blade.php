@extends('layouts.admin') <!-- ✅ Use the common admin layout -->

@section('title', 'Manage Users') <!-- ✅ Page Title -->

@section('content') <!-- ✅ Main Content Section -->
<div class="table-container">
    <h2>Manage Users</h2>

    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->firstItem() + $index : $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <!-- ✅ Edit Button -->
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">Edit</a>

                    <!-- ✅ Delete Button (with Confirmation) -->
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ✅ Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->links() : '' }}
    </div>
</div>

<!-- ✅ Custom Styling -->
<style>
    .table-container {
        width: 95%;
        margin: auto;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow-x: auto; /* Enable horizontal scrolling */
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 14px;
    }

    .styled-table th, .styled-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .styled-table th {
        background-color: #34495e;
        color: white;
        font-size: 16px;
    }

    .styled-table td {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ✅ Edit & Delete Button Styles */
    .btn {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
        margin-right: 5px;
    }

    .btn-edit {
        background-color: #3498db; /* Blue */
        color: white;
    }

    .btn-edit:hover {
        background-color: #2980b9;
    }

    .btn-delete {
        background-color: #e74c3c; /* Red */
        color: white;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    .delete-form {
        display: inline;
    }
</style>
@endsection
