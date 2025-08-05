<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage Usage Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 40px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        p {
            text-align: center;
            font-size: 16px;
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <h1>📊 Storage Usage Report</h1>
    <p>Generated on: {{ now()->format('d M Y, H:i A') }}</p>

    <table class="table-container">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Size (MB)</th>
                <th>Upload Date</th>
                <th>Management Decision / Conclusion</th> <!-- ✅ New Column -->
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                @php
                    $fileSizeMB = $file->size / (1024 * 1024);
                    if ($fileSizeMB > 100) {
                        $decision = 'Large file – Consider archiving';
                    } elseif ($fileSizeMB > 50) {
                        $decision = 'Moderate size – Monitor usage';
                    } else {
                        $decision = 'Low usage – No action needed';
                    }
                @endphp
                <tr>
                    <td>{{ $file->filename }}</td>
                    <td>{{ number_format($fileSizeMB, 2) }} MB</td>
                    <td>{{ \Carbon\Carbon::parse($file->created_at)->format('d M Y, H:i A') }}</td>
                    <td>{{ $decision }}</td> <!-- ✅ Output Decision -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Storage Used: {{ $totalStorageUsedMB }} MB</strong></p>

    <div class="footer">
        <p>Secure File Transfer System | &copy; {{ date('Y') }} All Rights Reserved.</p>
    </div>

</body>
</html>
