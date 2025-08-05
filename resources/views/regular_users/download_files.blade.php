@extends('layouts.app')

@section('title', 'Download Files')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Available Files</h2>

        <div class="table-responsive">
            <table class="table table-hover text-center file-table">
                <thead class="table-primary">
                    <tr>
                        <th>File Name</th>
                        <th>Uploaded By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $file)
                        <tr>
                            <td>{{ $file->name }}</td>
                            <td>
                                <a href="{{ route('regular_users.files.download', $file->id) }}" class="btn btn-sm btn-gradient">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-danger fw-bold py-4">No files available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $files->links() }}
        </div>

        {{-- Back to Dashboard Button --}}
        <div class="text-center mt-4">
            <a href="{{ route('regular_users.home') }}" class="btn btn-back btn-lg">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    {{-- FontAwesome for Icons --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
@endsection

@push('styles')
    <style>
        /* Custom Table Styling */
        .file-table {
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .file-table th, .file-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .file-table th {
            background: linear-gradient(90deg, #007bff, #6610f2);
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

        /* Gradient Download Button */
        .btn-gradient {
            display: inline-block;
            padding: 8px 12px;
            background: linear-gradient(90deg, #28a745, #17a2b8);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #218838, #138496);
            transform: scale(1.05);
        }

        /* Back Button with Gradient */
        .btn-back {
            display: inline-block;
            padding: 12px 18px;
            background: linear-gradient(90deg, #ff5722, #ff9800);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-back:hover {
            background: linear-gradient(90deg, #e64a19, #ff5722);
            transform: scale(1.05);
        }
    </style>
@endpush
