<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Storage Usage Report (PDF)</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Storage Usage Report</h2>

    <table>
        <thead>
            <tr>
                <th>Total Files</th>
                <th>Total Storage Used (MB)</th>
                <th>Average File Size (KB)</th>
                <th>Largest File (MB)</th>
                <th>Smallest File (KB)</th>
                <th>Last Upload Date</th>
                <th>Upload Frequency (Files/Day)</th>
                <th>Peak Usage Date</th>
                <th>Storage Efficiency (%)</th>
                <th>Conclusion</th>
                <th>Suggested Action</th>
            </tr>
        </thead>
        <tbody>
            @if($storageUsage->total_files > 0)
                @php
                    $largestMB = $storageUsage->largest_file / (1024 * 1024);
                    $averageKB = $storageUsage->average_size / 1024;
                    $totalMB = $storageUsage->total_size / (1024 * 1024);
                    $smallestKB = $storageUsage->smallest_file / 1024;

                    $dateFrom = \Carbon\Carbon::parse(request('date_from'));
                    $dateTo = \Carbon\Carbon::parse(request('date_to'));
                    $days = $dateFrom->diffInDays($dateTo) ?: 1;
                    $uploadFrequency = round($storageUsage->total_files / $days, 2);

                    $efficiency = $storageUsage->largest_file > 0 
                        ? round(($storageUsage->average_size / $storageUsage->largest_file) * 100, 1) 
                        : 0;

                    $peakDate = $storageUsage->peak_upload_date ?? 'N/A';

                    if ($largestMB > 100) {
                        $conclusion = 'Heavy Usage';
                        $action = 'Archive large files and consider compression.';
                    } elseif ($largestMB > 50) {
                        $conclusion = 'Moderate Usage';
                        $action = 'Monitor and maintain regular backups.';
                    } else {
                        $conclusion = 'Light Usage';
                        $action = 'No immediate action required.';
                    }
                @endphp
                <tr>
                    <td>{{ $storageUsage->total_files }}</td>
                    <td>{{ number_format($totalMB, 2) }} MB</td>
                    <td>{{ number_format($averageKB, 2) }} KB</td>
                    <td>{{ number_format($largestMB, 2) }} MB</td>
                    <td>{{ number_format($smallestKB, 2) }} KB</td>
                    <td>{{ $storageUsage->last_upload_date ? \Carbon\Carbon::parse($storageUsage->last_upload_date)->format('d M Y, H:i') : 'N/A' }}</td>
                    <td>{{ $uploadFrequency }}</td>
                    <td>{{ $peakDate }}</td>
                    <td>{{ $efficiency }}%</td>
                    <td>{{ $conclusion }}</td>
                    <td>{{ $action }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="11" class="text-center">No data available for the selected period.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
