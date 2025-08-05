<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Transfer Activity Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            table-layout: fixed; /* Ensures consistent column widths */
            word-wrap: break-word;
        }

        th, td {
            border: 1px solid #666;
            padding: 8px 6px;
            text-align: center;
            vertical-align: top;
        }

        th {
            background-color: #2c3e50;
            color: #fff;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            color: #555;
        }

        td, th {
            overflow: hidden;
        }

        /* Custom column widths for clarity */
        th:nth-child(1), td:nth-child(1) { width: 12%; }
        th:nth-child(2), td:nth-child(2) { width: 18%; }
        th:nth-child(3), td:nth-child(3),
        th:nth-child(4), td:nth-child(4) { width: 8%; }
        th:nth-child(5), td:nth-child(5),
        th:nth-child(6), td:nth-child(6),
        th:nth-child(7), td:nth-child(7) { width: 10%; }
        th:nth-child(8), td:nth-child(8) { width: 16%; }
        th:nth-child(9), td:nth-child(9) { width: 18%; }

    </style>
</head>
<body>

    <h2>Secure File Transfer Activity Report</h2>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Uploads</th>
                <th>Downloads</th>
                <th>Activity</th>
                <th>U/D Ratio</th>
                <th>Top Action</th>
                <th>Conclusion</th>
                <th>Suggestion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                @php
                    $uploads = optional($user->files)->count() ?? 0;
                    $downloads = optional($user->downloads)->count() ?? 0;
                    $total = $uploads + $downloads;

                    // Activity Level
                    if ($total == 0) {
                        $activity = 'None';
                    } elseif ($total < 5) {
                        $activity = 'Low';
                    } elseif ($total < 15) {
                        $activity = 'Moderate';
                    } else {
                        $activity = 'High';
                    }

                    // Upload/Download Ratio
                    $ratio = $downloads > 0 ? number_format($uploads / $downloads, 2) : ($uploads > 0 ? '∞' : '0');

                    // Top Action
                    if ($uploads > $downloads) {
                        $topAction = 'Uploader';
                    } elseif ($downloads > $uploads) {
                        $topAction = 'Downloader';
                    } else {
                        $topAction = 'Balanced';
                    }

                    // Conclusion
                    if ($total == 0) {
                        $conclusion = 'Inactive – Engage or review';
                        $suggestion = 'Send onboarding email, provide tutorial, or consider account review for engagement.';
                    } elseif ($uploads > $downloads) {
                        $conclusion = 'High contribution';
                        $suggestion = 'Reward or highlight user as active uploader. Monitor shared content quality.';
                    } elseif ($downloads > $uploads) {
                        $conclusion = 'High demand';
                        $suggestion = 'Encourage user to contribute uploads or promote file sharing among peers.';
                    } else {
                        $conclusion = 'Balanced usage';
                        $suggestion = 'User shows steady activity. Keep encouraging consistent engagement.';
                    }
                @endphp
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $uploads }}</td>
                    <td>{{ $downloads }}</td>
                    <td>{{ $activity }}</td>
                    <td>{{ $ratio }}</td>
                    <td>{{ $topAction }}</td>
                    <td>{{ $conclusion }}</td>
                    <td>{{ $suggestion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Report generated on {{ now()->format('Y-m-d H:i:s') }} &mdash; Secure File Transfer System
    </div>

</body>
</html>
