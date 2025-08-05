@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Delete File</h2>

    <div class="bg-white p-4 rounded shadow mt-4">
        <p>Are you sure you want to delete this file?</p>
        <p><strong>File Name:</strong> {{ $file->name }}</p>

        <form action="{{ route('admin.files.destroy', $file->id) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
            <a href="{{ route('admin.files.index') }}" class="text-blue-500 hover:underline ml-4">Cancel</a>
        </form>
    </div>
</div>
@endsection
