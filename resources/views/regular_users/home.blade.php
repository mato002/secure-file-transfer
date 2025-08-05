@extends('layouts.app')

@section('content')
    <div style="text-align: center; padding: 50px; background: #f8f9fa; border-radius: 10px; max-width: 900px; margin: auto;">
        <h1 style="font-size: 36px; font-weight: bold; color: #007bff; margin-bottom: 10px;">Welcome to Our Secure File Transfer System</h1>
        <p style="font-size: 18px; color: #555; max-width: 750px; margin: auto; line-height: 1.6;">
            Experience seamless, <strong>encrypted</strong>, and <strong>efficient</strong> file sharing with <strong>top-notch security</strong>. 
            Our platform ensures your data remains protected while enabling smooth and reliable transfers for both individuals and businesses.
        </p>

        <div style="margin-top: 40px; display: flex; justify-content: center; flex-wrap: wrap; gap: 30px;">
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); text-align: center; width: 280px;">
                <h3 style="color: #007bff; font-size: 22px;"> Secure Transfers</h3>
                <p style="color: #333; font-size: 16px;">End-to-end encryption ensures safe data transmission at all times.</p>
            </div>
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); text-align: center; width: 280px;">
                <h3 style="color: #007bff; font-size: 22px;"> Easy File Access</h3>
                <p style="color: #333; font-size: 16px;">Upload, download, and manage files effortlessly with a user-friendly interface.</p>
            </div>
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); text-align: center; width: 280px;">
                <h3 style="color: #007bff; font-size: 22px;"> Fast & Reliable</h3>
                <p style="color: #333; font-size: 16px;">Experience lightning-fast file transfers with 99.9% uptime and minimal latency.</p>
            </div>
        </div>

        <div style="margin-top: 40px;">
            <h3 style="color: #0056b3; font-size: 24px; margin-bottom: 15px;">Why Choose Us? </h3>
            <ul style="list-style: none; padding: 0; font-size: 16px; color: #444; max-width: 700px; margin: auto;">
                <li style="margin-bottom: 8px;"> <strong>Strong Data Protection</strong> – Your files are safeguarded with state-of-the-art encryption.</li>
                <li style="margin-bottom: 8px;"> <strong>Intuitive User Experience</strong> – A simple and clean interface for smooth navigation.</li>
                <li style="margin-bottom: 8px;"> <strong>24/7 Support</strong> – Get assistance anytime from our dedicated team.</li>
                <li style="margin-bottom: 8px;"> <strong>Cloud Storage</strong> – Access your files anytime, anywhere.</li>
            </ul>
        </div>

        <div style="margin-top: 50px;">
            <a href="{{ route('regular_users.download_files') }}" style="background: #007bff; color: white; padding: 14px 25px; border-radius: 8px; text-decoration: none; font-size: 18px; font-weight: bold; display: inline-block; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); transition: 0.3s;">
                 Browse Files
            </a>
        </div>

        <div style="margin-top: 40px; font-size: 14px; color: #666;">
            <p> Your security is our priority. All file transfers are encrypted and secure.</p>
        </div>
    </div>
@endsection  
