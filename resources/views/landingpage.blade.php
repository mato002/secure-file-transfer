<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SFT - Secure File Transfer System</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html,
    body {
      scroll-behavior: smooth;
      font-family: 'Roboto', sans-serif;
    }

    body {
      background-color: #f8fafc;
      color: #334155;
      line-height: 1.6;
    }

    /* Header Styles */
    header {
      background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
      color: white;
      padding: 25px 5%;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo-icon {
      font-size: 28px;
      color: #fff;
    }

    .logo-text {
      font-size: 24px;
      font-weight: 700;
    }

    .header-buttons {
      display: flex;
      gap: 15px;
    }

    .header-buttons a {
      background-color: rgba(255, 255, 255, 0.15);
      color: white;
      padding: 10px 22px;
      font-size: 1rem;
      border-radius: 30px;
      font-weight: 500;
      text-decoration: none;
      border: 1px solid rgba(255, 255, 255, 0.3);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .header-buttons a:hover {
      background-color: rgba(255, 255, 255, 0.25);
      transform: translateY(-2px);
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(rgba(78, 115, 223, 0.85), rgba(78, 115, 223, 0.9)), url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80') no-repeat center center/cover;
      color: white;
      padding: 100px 5%;
      text-align: center;
    }

    .hero-content {
      max-width: 900px;
      margin: 0 auto;
    }

    .hero h1 {
      font-size: 3rem;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .hero p {
      font-size: 1.3rem;
      margin-bottom: 40px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .hero-buttons {
      display: flex;
      gap: 20px;
      justify-content: center;
      margin-top: 30px;
    }

    .hero-buttons a {
      padding: 15px 35px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 500;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s ease;
    }

    .cta-primary {
      background-color: white;
      color: #4e73df;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .cta-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .cta-secondary {
      background-color: transparent;
      color: white;
      border: 2px solid white;
    }

    .cta-secondary:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateY(-3px);
    }

    /* Features Section */
    .features {
      padding: 100px 5%;
      background-color: #fff;
    }

    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-title h2 {
      font-size: 2.5rem;
      color: #1e293b;
      margin-bottom: 15px;
    }

    .section-title p {
      font-size: 1.2rem;
      color: #64748b;
      max-width: 600px;
      margin: 0 auto;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .feature-card {
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
      font-size: 50px;
      color: #4e73df;
      margin-bottom: 25px;
    }

    .feature-card h3 {
      font-size: 1.5rem;
      margin-bottom: 15px;
      color: #1e293b;
    }

    .feature-card p {
      color: #64748b;
    }

    /* How It Works */
    .how-it-works {
      padding: 100px 5%;
      background-color: #f8fafc;
    }

    .steps {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .step {
      background: white;
      border-radius: 12px;
      padding: 30px;
      width: 300px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .step-number {
      background: #4e73df;
      color: white;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0 auto 20px;
    }

    .step h3 {
      font-size: 1.4rem;
      margin-bottom: 15px;
      color: #1e293b;
    }

    .step p {
      color: #64748b;
    }

    /* Testimonials */
    .testimonials {
      padding: 100px 5%;
      background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
      color: white;
    }

    .testimonials .section-title h2 {
      color: white;
    }

    .testimonials .section-title p {
      color: rgba(255, 255, 255, 0.8);
    }

    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .testimonial-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      padding: 30px;
      backdrop-filter: blur(10px);
    }

    .testimonial-text {
      font-style: italic;
      margin-bottom: 20px;
      font-size: 1.1rem;
    }

    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .author-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #4e73df;
      font-weight: bold;
      font-size: 1.2rem;
    }

    .author-details h4 {
      font-weight: 600;
    }

    .author-details p {
      opacity: 0.8;
      font-size: 0.9rem;
    }

    /* Footer */
    footer {
      background-color: #1e293b;
      color: white;
      padding: 60px 5% 30px;
    }

    .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .footer-column h3 {
      font-size: 1.3rem;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }

    .footer-column h3::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 3px;
      background: #4e73df;
    }

    .footer-column p {
      margin-bottom: 20px;
      opacity: 0.8;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: white;
      text-decoration: none;
      opacity: 0.8;
      transition: opacity 0.3s;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-links a:hover {
      opacity: 1;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 50px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      opacity: 0.7;
      font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .header-container {
        flex-direction: column;
        gap: 20px;
      }

      .hero h1 {
        font-size: 2.2rem;
      }

      .hero p {
        font-size: 1.1rem;
      }

      .hero-buttons {
        flex-direction: column;
        align-items: center;
      }

      .feature-card, .step {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <!-- Header Section -->
  <header>
    <div class="header-container">
      <div class="logo">
        <div class="logo-icon"><i class="fas fa-lock"></i></div>
        <div class="logo-text">SFT</div>
      </div>
      <div class="header-buttons">
        <a href="{{ route('regular_users.register') }}"><i class="fas fa-user-plus"></i> Register</a>
        <a href="{{ route('regular_users.login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Secure File Transfer Made Simple</h1>
      <p>Transfer your files with military-grade encryption, ensuring your data remains confidential and protected at all times.</p>
      <div class="hero-buttons">
        <a href="{{ route('regular_users.register') }}" class="cta-primary"><i class="fas fa-rocket"></i> Get Started</a>
        <a href="#features" class="cta-secondary"><i class="fas fa-info-circle"></i> Learn More</a>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" id="features">
    <div class="section-title">
      <h2>Why Choose SFT?</h2>
      <p>Our platform offers industry-leading security and convenience for all your file transfer needs</p>
    </div>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-shield-alt"></i>
        </div>
        <h3>Military-Grade Encryption</h3>
        <p>All files are encrypted with AES-256 encryption, ensuring your data remains secure during transfer and at rest.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-bolt"></i>
        </div>
        <h3>Lightning Fast Transfers</h3>
        <p>Our optimized infrastructure ensures your files transfer quickly, no matter how large they are.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-chart-line"></i>
        </div>
        <h3>Detailed Reporting</h3>
        <p>Comprehensive activity logs and transfer reports help you keep track of all file movements.</p>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="how-it-works">
    <div class="section-title">
      <h2>How It Works</h2>
      <p>Transferring files securely has never been easier</p>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step-number">1</div>
        <h3>Create an Account</h3>
        <p>Sign up for a free account in just a few seconds</p>
      </div>
      <div class="step">
        <div class="step-number">2</div>
        <h3>Upload Your Files</h3>
        <p>Select files from your device or cloud storage</p>
      </div>
      <div class="step">
        <div class="step-number">3</div>
        <h3>Share Securely</h3>
        <p>Send encrypted links to recipients with optional expiration dates</p>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials">
    <div class="section-title">
      <h2>Trusted by Thousands</h2>
      <p>See what our users have to say about SFT</p>
    </div>
    <div class="testimonial-grid">
      <div class="testimonial-card">
        <div class="testimonial-text">
          "SFT has revolutionized how our company handles sensitive documents. The peace of mind is priceless."
        </div>
        <div class="testimonial-author">
          <div class="author-avatar">S</div>
          <div class="author-details">
            <h4>Sarah Johnson</h4>
            <p>CTO, TechCorp Inc.</p>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-text">
          "I've tried many file transfer services, but none match the combination of security and ease-of-use that SFT offers."
        </div>
        <div class="testimonial-author">
          <div class="author-avatar">M</div>
          <div class="author-details">
            <h4>Michael Chen</h4>
            <p>Freelance Developer</p>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-text">
          "The detailed activity logs have been invaluable for compliance purposes. Highly recommended for any business."
        </div>
        <div class="testimonial-author">
          <div class="author-avatar">A</div>
          <div class="author-details">
            <h4>Amanda Rodriguez</h4>
            <p>Compliance Officer, Financial Services</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div class="footer-column">
        <h3>About SFT</h3>
        <p>SFT is a leading secure file transfer solution trusted by businesses and individuals worldwide.</p>
      </div>
      <div class="footer-column">
        <h3>Quick Links</h3>
        <ul class="footer-links">
          <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
          <li><a href="#features"><i class="fas fa-chevron-right"></i> Features</a></li>
          <li><a href="#"><i class="fas fa-chevron-right"></i> Pricing</a></li>
          <li><a href="#"><i class="fas fa-chevron-right"></i> Contact</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Legal</h3>
        <ul class="footer-links">
          <li><a href="#"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
          <li><a href="#"><i class="fas fa-chevron-right"></i> Terms of Service</a></li>
          <li><a href="#"><i class="fas fa-chevron-right"></i> Data Protection</a></li>
          <li><a href="#"><i class="fas fa-chevron-right"></i> Compliance</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 SFT. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>