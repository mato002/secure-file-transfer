@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">📂 File Details</h2>

    <div class="bg-white p-4 rounded shadow mt-4">
        <p><strong>File Name:</strong> {{ $file->filename }}</p>
        <p><strong>Uploaded By:</strong> {{ $file->user->name ?? 'Admin' }}</p>
        <p><strong>Upload Date:</strong> {{ $file->created_at->format('d M Y, H:i') }}</p>
        <p><strong>File Size:</strong> 
            {{ number_format($file->size / 1024, 2) }} KB ({{ number_format($file->size / (1024 * 1024), 2) }} MB)
        </p>

        <a href="{{ route('admin.files.download', $file->id) }}" class="mt-3 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">📥 Download File</a>

        <a href="{{ route('admin.files.index') }}" class="text-blue-500 hover:underline mt-4 block">🔙 Back to Files</a>
    </div>
</div>
@endsection
