<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>KYC UGANDA - Home</title>
  <meta content="Search Customers Through Sanction Lists, PEP Lists, Adverse Media, National ID & Company Verification." name="description">
  <meta content="The only Easy, Accurate & Affordable Anti-Money Laundering & Know Your Customer Online Tool In Uganda." name="description">
  <meta content="" name="keywords">
  <meta property="og:image" content="http://ia.media-imdb.com/rock.jpg" />


  <!-- Favicons -->
  <link href="{{ asset('assets/frontend/img/favicon.JPG') }}" rel="icon">
  <link href="{{ asset('assets/frontend/img/apple-touch-icon.png+') }}" rel="apple-touch-icon">
  <script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer>
  </script>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- {{ URL::asset('assets/vendor/aos/aos.css'); }}  -->

  <link href="{{ asset('assets/frontend/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/frontend/img/favicon.JPG') }}" alt="" height="80px">
        <!-- <span>KYC UGANDA</span> -->
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#values">Services</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="{{route('login.show')}}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Let's make KYC, Easy, Accurate and Affordable </h1>
          <h2 data-aos="fade-up" data-aos-delay="400">The only Easy, Accurate & Affordable Anti-Money Laundering & Know Your Customer Online Tool In Uganda. <br>Search Customers Through Sanction Lists, PEP Lists, Adverse Media, National ID & Company Verification.</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="{{ asset('assets/frontend/img/hero-img.png') }}" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h2>Why Choose Us</h2>
              <ul>
                <li>KYC compliance can be difficult.</li>
                <li>It is expensive and complicated</li>
                <li>How about a PAY-AS-YOU- GO Option</li>
              </ul> <br>

              <h2>Core values</h2>
              <ul>
                <li> We Listen </li>
                <li> We Empathise </li>
                <li>We give honest feedback</li>
                <li>We Innovate</li>
              </ul>
              <div class="text-center text-lg-start">
                <a href="#values" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('assets/frontend/img/about.jpg') }}" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Services</h2>
          <p>Services</p>
        </header>

        <div class="row">

          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <a href="#contact"><img src="{{ asset('assets/frontend/img/values-1.png') }}" class="img-fluid" alt=""></a>
              <a href="#contact">
                <h3>Global Sanctions and Watchlists</h3>
              </a>
              <p>We monitor hundreds of interdependent sanctions lists concurrently in near real-time.
                Thousands of government, regulatory and law enforcement watchlists.
                Latest updates in 15 minutes
              </p>
            </div>
          </div>

          <div class="col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <a href="#contact"><img src="{{ asset('assets/frontend/img/values-2.png') }}" class="img-fluid" alt=""></a>
              <a href="#contact">
                <h3>Politically Exposed Persons</h3>
              </a>
              <p>Global coverage with over 5,000 structured sources used for our PEP database. Including spouses, partners, and children. </p>

            </div>
          </div>

          <div class="col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <a href="{{ route('login.show') }}"><img src="{{ asset('assets/frontend/img/values-3.png') }}" class="img-fluid" alt=""></a>
              <a href="{{ route('login.show') }}">
                <h3> Adverse Media and Information</h3>
              </a>
              <p>Rich, dynamic information from millions of newspapers, social media data points. Conduct ongoing monitoring with real-time updates</p>
            </div>
          </div>

          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <a href="#contact"><img src="{{ asset('assets/frontend/img/values-1.png') }}" class="img-fluid" alt=""></a>
              <a href="#contact">
                <h3>ID Verification</h3>
              </a>
              <p>With our ID checking system, you can confirm and verify an individual's national identification number and particulars</p>

            </div>
          </div>


        </div>

      </div>

    </section><!-- End Values Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="3" data-purecounter-duration="1" class="purecounter"></span>
                <p>Countries</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-headset" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                <p>AML Professionals</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>1001 Gaba Road,<br>Kampala, Uganda</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+256 392 912 222<br>+256 776 222 504</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>comply@smithandboltons.com<br>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form class="php-email-form" action="mail.php" method="POST">
              <div class="row gy-4">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>
                <div class="g-recaptcha form-group" data-sitekey="{{env('GOOGLE_RECAPTCHA')}}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaResponseExpiry" data-error-callback="onRecaptchaError"></div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit" id="submitBtn" disabled>Send Message</button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <!-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div> -->

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="{{ asset('assets/frontend/img/footer_logo-removebg-preview.png') }}" alt="">
              <!-- <span>KYC UGANDA</span> -->
            </a>
            <p>Smith and Bolton Limited consists of a team of Lawyers, Compliance Practitioners, Internal
              Auditors and Risk Management Practitioners.
              We seek to support Accountable Persons with Professional Services
              across the full AML/CTF Compliance and Advisory spectrum.
              Through practice experience and Global partnerships we
              deliver best in class services to a growing list of satisfied
              customers.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#values">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#values">Global Sanctions</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#values">Politically Exposed Persons</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#values">Adverse Media</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#values">ID Verification</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#values">Benefitial Owner Checks</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>

            <p>
              Smith and Bolton Limited, <br>
              P.O Box 118419 Kampala, <br>
              1st Floor Suite 2, <br> Suzie House, Nsambya

              <br><br>
              <strong>Phone:</strong> +256 776 222 504<br>
              <strong>Email:</strong> comply@smithandboltons.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>KYC UGANDA</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        <!-- Designed by <a href="https://emasonsug.com/">Emasons Uganda</a> -->
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script type="text/javascript">
    function onRecaptchaSuccess() {
      console.log('reached here')
      document.getElementById("submitBtn").disabled = false;
    };
  </script>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

</body>

</html>