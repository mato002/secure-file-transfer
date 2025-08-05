@extends('layouts.admin') 

@section('content')
@php
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        return $bytes . ' bytes';
    } elseif ($bytes == 1) {
        return $bytes . ' byte';
    } else {
        return '0 bytes';
    }
}
@endphp

<div class="container mt-4">
    <h2 class="mb-4">Manage Files</h2>

    <!-- ✅ Success Message Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ✅ File Upload Toggle Button -->
    <button class="btn btn-primary mb-3" onclick="toggleUploadForm()">Upload New File</button>

    <!-- ✅ File Upload Form (Initially Hidden) -->
    <div id="uploadForm" class="card mb-4 d-none">
        <div class="card-header bg-primary text-white">Upload a New File</div>
        <div class="card-body">
            <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <input type="file" name="file" class="form-control" required>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
                @error('file')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </form>
        </div>
    </div>

    <!-- ✅ File List Table -->
    <div class="card">
        <div class="card-header bg-dark text-white">Uploaded Files</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Filename</th>
                        <th>Size</th> <!-- ✅ Display file size -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $file)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $file->name }}</td>
                            <td>{{ formatSizeUnits($file->size) }}</td> <!-- ✅ Convert bytes to KB/MB -->
                            <td>
                                <!-- Download Button -->
                                <a href="{{ route('admin.files.download', $file->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.files.destroy', $file->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this file?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No files uploaded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- ✅ Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $files->links() }}
            </div>
        </div>
    </div>
</div>

<!-- ✅ JavaScript to Toggle Upload Form -->
<script>
    function toggleUploadForm() {
        document.getElementById('uploadForm').classList.toggle('d-none');
    }
</script>
@endsection
