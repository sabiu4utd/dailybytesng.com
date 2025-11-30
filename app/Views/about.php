<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Daily Bytes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --secondary: #1e40af;
      --text: #1f2937;
      --text-light: #4b5563;
      --light: #f8fafc;
      --white: #ffffff;
      --transition: all 0.3s ease;
    }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text);
      line-height: 1.7;
      background: var(--light);
    }

    .hero-section {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: var(--white);
      padding: 5rem 0;
      margin-bottom: 3rem;
      position: relative;
      overflow: hidden;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
      opacity: 0.3;
    }

    .section-title {
      color: var(--primary);
      position: relative;
      display: inline-block;
      margin-bottom: 1.5rem;
      font-weight: 700;
    }

    .section-title::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -8px;
      width: 50px;
      height: 3px;
      background: var(--primary);
      border-radius: 3px;
    }

    .card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      transition: var(--transition);
      height: 100%;
      background: var(--white);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15);
    }

    .card-body {
      padding: 2rem;
    }

    .social-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--light);
      color: var(--primary);
      margin: 0 5px 10px;
      transition: var(--transition);
    }

    .social-icon:hover {
      background: var(--primary);
      color: var(--white);
      transform: translateY(-3px);
    }

    .contact-info li {
      margin-bottom: 1rem;
      padding-left: 1.75rem;
      position: relative;
    }

    .contact-info li i {
      position: absolute;
      left: 0;
      top: 0.25rem;
      color: var(--primary);
    }

    .animate-on-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .animate-on-scroll.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body>
  <?php echo view('header'); ?>

  <!-- Hero Section -->
  <section class="hero-section text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">About Daily Bytes</h1>
          <p class="lead mb-0 animate__animated animate__fadeInUp animate__delay-1s">Delivering concise, credible, and compelling journalism in Nigeria's digital news space</p>
        </div>
      </div>
    </div>
  </section>

  <main class="container py-5">
    <!-- About Section -->
    <section class="mb-5">
      <div class="row g-4">
        <div class="col-12 text-center mb-5">
          <h2 class="section-title h1">Our Story</h2>
          <p class="lead text-muted">Committed to excellence in journalism since our inception</p>
        </div>

        <div class="col-lg-6">
          <div class="card h-100 animate-on-scroll">
            <div class="card-body">
              <h3 class="h4 mb-4">Who We Are</h3>
              <p class="mb-4">Daily Bytes is a leading digital news platform in Nigeria, dedicated to delivering timely, factual, and engaging stories that inform public understanding and promote accountability across various sectors.</p>
              <p>Our team of experienced journalists and editors work around the clock to bring you the most relevant and accurate news from Nigeria and beyond.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card h-100 animate-on-scroll">
            <div class="card-body">
              <h3 class="h4 mb-4">Our Mission</h3>
              <p class="mb-4">To be the most trusted source of news and information in Nigeria, providing our readers with accurate, balanced, and insightful journalism that makes a difference in their lives.</p>
              <p>We believe in the power of information to transform societies and are committed to upholding the highest standards of journalistic integrity.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Connect Section -->
    <section class="mb-5 pt-5">
      <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
          <h2 class="section-title">Connect With Us</h2>
          <p class="text-muted">Stay updated with our latest stories and updates</p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-5">
          <div class="card h-100 animate-on-scroll">
            <div class="card-body text-center">
              <h3 class="h4 mb-4">Follow Us</h3>
              <div class="social-links">
                <a href="https://facebook.com/DailyBytesNg" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://x.com/DailyBytesng" target="_blank" rel="noopener" class="social-icon" aria-label="Twitter">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com/DailyBytesng/" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
                  <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.youtube.com/@dailybytesnewslive" target="_blank" rel="noopener" class="social-icon" aria-label="YouTube">
                  <i class="fab fa-youtube"></i>
                </a>
                <a href="https://www.tiktok.com/@dailybytesnewslive" target="_blank" rel="noopener" class="social-icon" aria-label="TikTok">
                  <i class="fab fa-tiktok"></i>
                </a>
              </div>
              <p class="mt-4 mb-0">Join our growing community of informed readers</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-7">
          <div class="card h-100 animate-on-scroll">
            <div class="card-body">
              <h3 class="h4 mb-4">Get In Touch</h3>
              <ul class="contact-info list-unstyled">
                <li class="mb-3">
                  <i class="fas fa-envelope"></i>
                  <div>
                    <h5 class="h6 mb-1">General Inquiries</h5>
                    <a href="mailto:info@dailybytesng.com" class="text-decoration-none">info@dailybytesng.com</a>
                  </div>
                </li>
                <li class="mb-3">
                  <i class="fas fa-bullhorn"></i>
                  <div>
                    <h5 class="h6 mb-1">Advertise With Us</h5>
                    <a href="mailto:advert@dailybytesng.com" class="text-decoration-none">advert@dailybytesng.com</a>
                  </div>
                </li>
                <li class="mb-3">
                  <i class="fas fa-phone-alt"></i>
                  <div>
                    <h5 class="h6 mb-1">Phone</h5>
                    <a href="tel:+2349028281293" class="text-decoration-none">+234 902 828 1293</a> 
                    
                  </div>
                </li>
                <!-- <li>
                  <i class="fas fa-map-marker-alt"></i>
                  <div>
                    <h5 class="h6 mb-1">Location</h5>
                    <p class="mb-0">Lagos, Nigeria</p>
                  </div>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <!-- <section class="pt-5">
      <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
          <h2 class="section-title">Our Team</h2>
          <p class="text-muted">Meet the dedicated team behind Daily Bytes</p>
        </div>
      </div>
      
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 animate-on-scroll">
            <div class="card-body text-center">
              <div class="rounded-circle bg-light mx-auto mb-3" style="width: 120px; height: 120px;"></div>
              <h4 class="h5 mb-1">Editorial Team</h4>
              <p class="text-muted small">Editors & Journalists</p>
              <p class="small">Our experienced team ensures every story meets the highest standards of journalism.</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card h-100 animate-on-scroll">
            <div class="card-body text-center">
              <div class="rounded-circle bg-light mx-auto mb-3" style="width: 120px; height: 120px;"></div>
              <h4 class="h5 mb-1">Tech Team</h4>
              <p class="text-muted small">Developers & Designers</p>
              <p class="small">Building the platform that brings you the news, anytime, anywhere.</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card h-100 animate-on-scroll">
            <div class="card-body text-center">
              <div class="rounded-circle bg-light mx-auto mb-3" style="width: 120px; height: 120px;"></div>
              <h4 class="h5 mb-1">Business Team</h4>
              <p class="text-muted small">Sales & Marketing</p>
              <p class="small">Connecting brands with our engaged audience through strategic partnerships.</p>
            </div>
          </div>
        </div>
      </div>
    </section> -->
  </main>

  <?php echo view('footer'); ?>
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom JavaScript -->
  <script>
    // Animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
      const animateElements = document.querySelectorAll('.animate-on-scroll');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1
      });

      animateElements.forEach(element => {
        observer.observe(element);
      });
    });
  </script>
</body>

</html>