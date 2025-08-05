@extends('layouts.admin')

@section('content')
    <div class="dashboard-content">
        <div class="row">
            <!-- Summary Cards -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text fs-2">{{ $totalUsers ?? '0' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Files Uploaded</h5>
                        <p class="card-text fs-2">{{ $totalFiles ?? '0' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total File Downloads</h5>
                        <p class="card-text fs-2">{{ $totalDownloads ?? '0' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mt-4">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="chart-container p-3 bg-white shadow rounded w-100">
                    <h5 class="text-center">User Registration Trends</h5>
                    <canvas id="userChart" style="height: 250px; max-height: 300px;"></canvas>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="chart-container p-3 bg-white shadow rounded w-100">
                    <h5 class="text-center">File Uploads</h5>
                    <canvas id="fileChart" style="height: 250px; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="chart-container p-3 bg-white shadow rounded w-100">
                    <h5 class="text-center">File Downloads</h5>
                    <canvas id="downloadChart" style="height: 250px; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let totalUsers = Number({{ $totalUsers ?? 0 }});
            let totalFiles = Number({{ $totalFiles ?? 0 }});
            let totalDownloads = Number({{ $totalDownloads ?? 0 }});

            // Define months for the x-axis (January to December)
            let months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            // Generate directly proportional data (starting at 0, increasing each month)
            let proportionalUsers = months.map((_, index) => (index + 1) * 10);
            let proportionalDownloads = months.map((_, index) => (index + 1) * 5);

            // User Registration Trends
            new Chart(document.getElementById('userChart'), {
                type: 'line',
                data: {
                    labels: months, 
                    datasets: [{
                        label: 'New Users',
                        data: proportionalUsers, 
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.2)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    scales: {
                        x: { grid: { display: false } },
                        y: { 
                            beginAtZero: true, 
                            suggestedMax: proportionalUsers[proportionalUsers.length - 1] + 10
                        }
                    }
                }
            });

            // File Uploads Chart
            new Chart(document.getElementById('fileChart'), {
                type: 'bar',
                data: {
                    labels: ['Uploads'],
                    datasets: [{
                        label: 'File Activity',
                        data: [totalFiles],
                        backgroundColor: ['green']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // File Downloads Chart
            new Chart(document.getElementById('downloadChart'), {
                type: 'bar',
                data: {
                    labels: ['Downloads'],
                    datasets: [{
                        label: 'File Downloads',
                        data: [totalDownloads],
                        backgroundColor: ['orange']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
@endsection
