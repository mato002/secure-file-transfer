@extends('layouts.app')

@section('content')
    <h1 class="title"> Frequently Asked Questions (FAQs) </h1>

    <div class="faq-container">
        <div class="faq-item">
            <h2> Is the file transfer secure?</h2>
            <p>Yes, we use advanced encryption protocols to protect all file transfers, ensuring security and privacy.</p>
        </div>

        <div class="faq-item">
            <h2> How do I reset my password?</h2>
            <p>You can reset your password by clicking on <strong>"Forgot Password"</strong> on the login page and following the instructions.</p>
        </div>

        <div class="faq-item">
            <h2> What types of files can I upload?</h2>
            <p>You can upload documents, images, videos, and other commonly used file formats up to a certain size limit.</p>
        </div>

        <div class="faq-item">
            <h2> How fast are the uploads and downloads?</h2>
            <p>We use optimized cloud servers to provide high-speed transfers, ensuring quick uploads and downloads.</p>
        </div>

        <div class="faq-item">
            <h2>Can I download multiple files at once?</h2>
            <p>Yes, our system allows batch downloads so you can download multiple files in a single click.</p>
        </div>

        <div class="faq-item">
            <h2> Who can access the files?</h2>
            <p>Only authenticated users have access. Admins can manage files, while regular users can only view and download permitted files.</p>
        </div>

        <div class="faq-item">
            <h2> How long are my files stored?</h2>
            <p>Files are stored permanently unless deleted by the user or admin. Temporary files may be auto-deleted after 30 days.</p>
        </div>

        <div class="faq-item">
            <h2> How can I contact support?</h2>
            <p>You can reach out to our support team via email at <strong>stephenloishorua88@mail.com</strong> or call us at <strong>+254 793803227</strong>.</p>
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

        /* FAQ Container */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* FAQ Item */
        .faq-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .faq-item:hover {
            transform: scale(1.02);
        }

        .faq-item h2 {
            color: #0056b3;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .faq-item p {
            color: #333;
            font-size: 14px;
        }
    </style>
@endsection
