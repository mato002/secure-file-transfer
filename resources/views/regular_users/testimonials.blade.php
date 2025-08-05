@extends('layouts.app')

@section('content')
    <h1 class="title"> What Our Users Say </h1>

    <div class="testimonials-container">
        <div class="testimonial">
            <p class="quote">"This is the best file transfer system I've ever used!"</p>
            <h3>- John Doe</h3>
        </div>

        <div class="testimonial">
            <p class="quote">"Highly secure and easy to use!"</p>
            <h3>- Jane Smith</h3>
        </div>

        <div class="testimonial">
            <p class="quote">"I love how fast and efficient the system is. The encryption makes me feel secure!"</p>
            <h3>- David Wilson</h3>
        </div>

        <div class="testimonial">
            <p class="quote">"Finally, a file transfer system that is simple yet powerful. Great job!"</p>
            <h3>- Lisa Carter</h3>
        </div>

        <div class="testimonial">
            <p class="quote">"The admin-user roles are a game changer. I can easily manage my files without hassle!"</p>
            <h3>- Mark Robinson</h3>
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

        /* Testimonials Container */
        .testimonials-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }

        /* Individual Testimonial */
        .testimonial {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            text-align: center;
        }

        .testimonial:hover {
            transform: scale(1.03);
        }

        /* Quote Styling */
        .quote {
            font-size: 16px;
            font-style: italic;
            color: #333;
        }

        .testimonial h3 {
            color: #0056b3;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
@endsection
