@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="contact-container">
        <h1>Contact Us</h1>

        <div class="contact-details">
            <p><strong>Email:</strong> stephenloishorua88@gmail.com</p>
            <p><strong>Phone:</strong> +254 793803227</p>
            <p><strong>Office Address:</strong> 123 Secure Lane, Cyber City, Techland</p>
            <p><strong>Working Hours:</strong> Monday - Friday, 9 AM - 6 PM</p>
        </div>
    </div>

    <style>
        /* Container styling */
        .contact-container {
            width: 90%; /* stretch to 90% of screen */
            max-width: 1200px; /* optional limit */
            margin: 30px auto;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Contact details */
        .contact-details p {
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
@endsection
