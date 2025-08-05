@extends('layouts.app') {{-- Ensure this matches the correct layout file --}}

@section('title', 'About Us') <!-- Page title -->

@section('content')
    <div class="container">
        <h2 class="title"> About Us</h2>

        <p class="intro">
            Welcome to <strong>Secure File Transfer System</strong>! Our mission is to provide <strong>secure, fast, and reliable</strong> file-sharing services. 
            We are a team of passionate individuals committed to <strong>data security, innovation, and user satisfaction</strong>.
        </p>

        <h3 class="section-title"> Our Mission</h3>
        <p class="section-text">
            To ensure <strong>secure file transfers</strong> by leveraging <strong>advanced encryption technologies</strong> while maintaining a <strong>user-friendly experience</strong>.
        </p>

        <h3 class="section-title"> Our Vision</h3>
        <p class="section-text">
            To be the <strong>leading global platform</strong> for <strong>safe and efficient file transfers</strong>, empowering businesses and individuals to <strong>share data securely</strong>.
        </p>

        <h3 class="section-title"> Why Choose Us?</h3>
        <ul class="benefits">
            <li> <strong>End-to-End Encryption</strong> – Your files are protected at all times.</li>
            <li> <strong>User-Friendly Interface</strong> – Simple, intuitive, and easy to navigate.</li>
            <li> <strong>Lightning-Fast Transfers</strong> – No more waiting; experience blazing-fast downloads and uploads.</li>
            <li> <strong>Dedicated Support</strong> – Our team is always here to help you.</li>
        </ul>

        <h3 class="section-title"> Meet Our Team</h3>
        <div class="team-container">
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="John Doe">
                <h5>John Doe</h5>
                <p>CEO & Founder</p>
            </div>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Jane Smith">
                <h5>Jane Smith</h5>
                <p>Chief Technology Officer</p>
            </div>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Emily Johnson">
                <h5>Emily Johnson</h5>
                <p>Chief Marketing Officer</p>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* General Styles */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            font-size: 28px;
            color: #007bff;
            margin-bottom: 20px;
        }

        .intro {
            text-align: center;
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .section-title {
            font-size: 22px;
            color: #0056b3;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .section-text {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        /* Benefits List */
        .benefits {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .benefits li {
            background: #f8f9fa;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        /* Team Section */
        .team-container {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-top: 20px;
            gap: 20px;
        }

        .team-member {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            flex: 1;
            max-width: 200px;
        }

        .team-member:hover {
            transform: scale(1.05);
        }

        .team-member img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .team-member h5 {
            font-size: 18px;
            color: #007bff;
            margin-bottom: 5px;
        }

        .team-member p {
            font-size: 14px;
            color: #555;
        }
    </style>
@endsection
