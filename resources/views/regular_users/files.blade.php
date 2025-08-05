@extends('layouts.app')


@section('title', 'Download Files')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white text-center mb-6"> Available Files</h2>

        <div class="overflow-x-auto">
            <table class="file-table w-full border-collapse bg-white shadow-lg rounded-lg">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>File Name</th>
                        <th>Uploaded Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($files as $index => $file)
                        <tr>
                            <td class="text-center">{{ $files instanceof \Illuminate\Pagination\LengthAwarePaginator ? $files->firstItem() + $index : $loop->iteration }}</td>
                            <td class="text-left truncate">{{ $file->name }}</td>
                            <td class="text-center">{{ $file->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('regular_user.files.download', ['id' => $file->id]) }}" class="btn-download">
                                     Download
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-red-500 font-semibold py-6">No files available for download.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            {{ $files instanceof \Illuminate\Pagination\LengthAwarePaginator ? $files->links() : '' }}
        </div>

        <!-- Back to Dashboard -->
        <div class="text-center mt-6">
            <a href="{{ route('regular_user.dashboard') }}" class="btn-back">
                Back to Dashboard
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Table Styling */
        .file-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .file-table th, .file-table td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .file-table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }

        .file-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .file-table tr:hover {
            background-color: #dbeafe;
            transition: background-color 0.3s ease-in-out;
        }

        /* Download Button */
        .btn-download {
            display: inline-block;
            padding: 10px 14px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-download:hover {
            background-color: #218838;
        }

        /* Back to Dashboard Button */
        .btn-back {
            display: inline-block;
            padding: 12px 18px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
@endpush  
@section('styles')
    <style>
        /* Paste your styles here */
        .file-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border-radius: 10px !important;
    overflow: hidden !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
}

.file-table th, .file-table td {
    padding: 14px !important;
    text-align: center !important;
    border-bottom: 1px solid #ddd !important;
}

.file-table th {
    background-color: #007bff !important;
    color: white !important;
    text-transform: uppercase !important;
}

.file-table tr:nth-child(even) {
    background-color: #f8f9fa !important;
}

.file-table tr:hover {
    background-color: #dbeafe !important;
    transition: background-color 0.3s ease-in-out !important;
}

    </style>
@endsection

