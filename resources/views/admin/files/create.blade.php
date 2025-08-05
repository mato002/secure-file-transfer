@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Upload New File</h3>
                </div>
                <div class="card-body p-4">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Choose File</label>
                            <input type="file" name="file" class="form-control-file" id="file">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Upload</button>
                    </form>

                    <a href="{{ route('admin.files.index') }}" class="btn btn-link mt-3">Back to Files</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
