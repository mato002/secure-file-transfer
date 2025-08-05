@extends('layouts.app')

@section('content')
    <h1 class="title"> Key Features of Secure File Transfer System </h1>

    <div class="features-container">
        <div class="feature-card">
            <h2> Secure File Transfers</h2>
            <p>Our system ensures that all files are transferred securely using the latest encryption techniques.</p>
        </div>

        <div class="feature-card">
            <h2> End-to-End Encryption</h2>
            <p>All files are encrypted both during upload and download, ensuring complete privacy and security.</p>
        </div>

        <div class="feature-card">
            <h2> Fast Upload & Download</h2>
            <p>Optimized transfer speeds allow you to upload and download files quickly, even for large documents.</p>
        </div>

        <div class="feature-card">
            <h2> Admin & User Roles</h2>
            <p>Different user roles provide controlled access to uploaded files with an easy-to-use dashboard.</p>
        </div>

        <div class="feature-card">
            <h2> File Management</h2>
            <p>Users can organize, rename, and manage their uploaded files easily within a structured interface.</p>
        </div>

        <div class="feature-card">
            <h2> Multi-Factor Authentication</h2>
            <p>Enhanced security with two-factor authentication for admin and user logins.</p>
        </div>

        <div class="feature-card">
            <h2> File Search & Preview</h2>
            <p>Quickly find and preview files before downloading with our advanced search functionality.</p>
        </div>

        <div class="feature-card">
            <h2> Detailed Activity Logs</h2>
            <p>Track every action performed on the system with a full log of file uploads, downloads, and edits.</p>
        </div>

        <div class="feature-card">
            <h2> Cloud Storage Integration</h2>
            <p>Sync your files with cloud services like Google Drive and Dropbox for additional backup options.</p>
        </div>
    </div>

    <style>
        /* Title Styling */
        .title {
            text-align: center;
            color: #007bff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Features Container */
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        /* Feature Card */
        .feature-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .feature-card:hover {
            transform: scale(1.05);
        }

        .feature-card h2 {
            color: #0056b3;
            font-size: 20px;
        }

        .feature-card p {
            color: #333;
            font-size: 14px;
        }
    </style>
@endsection
