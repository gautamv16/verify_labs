<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Verify Lab</title>

        <!-- Fonts
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        Styles 
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .d-flex{
                display:flex;
            }
            .align-items-center{
                align-items: center;
            }
            .title img{
                margin-right: 15px;
            }
            .title span{
                margin-top: 20px;
                color: #000;
            }
            @media (max-width: 520px){
            .title img{
               max-width: 80px
            }
            .title span{
                font-size: 46px;
            } 
            }
        </style> -->
        <link href="/admin/css/styles.css" rel="stylesheet" />
        <link href="/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="/admin/assets/vendor/aos/aos.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900%7COpen+Sans:300%7CIndie+Flower:regular%7COswald:300,regular,700&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
    </head>
    <body>
        <!--<div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title d-flex align-items-center">
                    <img src="{{ asset('admin/assets/img/lab-verification-logo.png') }}" width="100">
                    <span>Verify Lab</span>
                </div>
            </div>
        </div> -->

        <!-- ======= Header ======= -->
  
  <header id="header" class="fixed-top">
    <div class="very-top-header">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-10 d-flex align-items-center justify-content-between">
          <div class="very-top-left">Call Us<span> Today! +971 4 2388755 | info@racs.ae</span></div>
          <div class="very-top-right">
            <ul class="social-icons">
              <li>
                <a href="#">
                  <span class="screen-reader-text">fa-sa</span>
                  <i class="fag fag-sa transparent-text-dark" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="screen-reader-text">fa-gr</span>
                  <i class="fag fag-gr transparent-text-dark" aria-hidden="true"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="screen-reader-text">fa-usa</span>
                  <i class="fag fag-usa transparent-text-dark" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-10 d-flex align-items-center">
          <a href="index.html" class="logo mr-auto"><img src="../../admin/assets/img/racs-logo-2.png"></a>
          <span class="hDRTXT">Inspection Services System</span>
          <!--<nav class="nav-menu d-none d-lg-block">
            <ul>
              <li class="active"><a href="#header">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Sectors</a></li>
              <li><a href="#">Open Data</a></li>
              <li><a href="#">FAQ</a></li>
              <li class="drop-down"><a href="#">Directory</a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li><a href="#">Drop Down 2</a></li>
                  <li><a href="#">Drop Down 3</a></li>
                  <li><a href="#">Drop Down 4</a></li>
                </ul>
              </li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
          </nav>--><!-- .nav-menu -->
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container-fluid" data-aos="zoom-out" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="row">
            <div class="col-xl-5 col-md-6">
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container-fluid" data-aos="zoom-in">
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="owl-carousel clients-carousel">
              <img src="../../admin/assets/img/image010.jpg" alt="">
              <img src="../../admin/assets/img/ecas.jpg" alt="">
              <img src="../../admin/assets/img/eqm.jpg" alt="">
              <img src="../../admin/assets/img/metrology.png" alt="">
              <img src="../../admin/assets/img/g-mark-w270.png" alt="">
              <img src="../../admin/assets/img/SERVICE.png" alt="">
              <img src="../../admin/assets/img/SERVICE-2.png" alt="">
              <img src="../../admin/assets/img/Saber_V.12_logo-02-1.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Clients Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row no-gutters">
          <div class="content col-xl-6 d-flex align-items-stretch">
            <div class="content">
              <h3>WELCOME TO RACS</h3>
              <p>
                RACS is an accredited and recognized worldwide quality conformity assessment body serving the inspection, verification, assessments and certification requirements of clients throughout UAE, GCC, and worldwide, delivering high quality services to help clients meet the growing challenges of quality and social responsibility.
              </p>
              <a href="#" class="about-btn"><span>Read More</span> <i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
          <div class="col-xl-6 d-flex align-items-stretch">
            <img src="../../admin/assets/img/new-web.jpg">
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Tabs Section ======= -->
    <section id="tabs" class="tabs">
      <div class="container" data-aos="fade-up">

        <ul class="nav nav-tabs row d-flex">
          <li class="nav-item col-3">
            <a class="nav-link active show" data-toggle="tab" href="#tab-1">
              <i class="ri-gps-line"></i>
              <h4 class="d-none d-lg-block">Modi sit est dela pireda nest</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-toggle="tab" href="#tab-2">
              <i class="ri-body-scan-line"></i>
              <h4 class="d-none d-lg-block">Unde praesenti mara setra le</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-toggle="tab" href="#tab-3">
              <i class="ri-sun-line"></i>
              <h4 class="d-none d-lg-block">Pariatur explica nitro dela</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-toggle="tab" href="#tab-4">
              <i class="ri-store-line"></i>
              <h4 class="d-none d-lg-block">Nostrum qui dile node</h4>
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active show" id="tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                <p class="font-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                  <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                </ul>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                <img src="../../admin/assets/img/tabs-1.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Neque exercitationem debitis soluta quos debitis quo mollitia officia est</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="font-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                  <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                  <li><i class="ri-check-double-line"></i> Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="../../admin/assets/img/tabs-2.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Voluptatibus commodi ut accusamus ea repudiandae ut autem dolor ut assumenda</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                  <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                  <li><i class="ri-check-double-line"></i> Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                </ul>
                <p class="font-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="../../admin/assets/img/tabs-3.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-4">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Omnis fugiat ea explicabo sunt dolorum asperiores sequi inventore rerum</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="font-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                  <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                  <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="../../admin/assets/img/tabs-4.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Tabs Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title d-flex justify-content-between align-items-center">
          <h2 class="mb-0 pdb-0">GET CERTIFIED BY US FOR YOUR PRODUCTS AND SERVICES</h2>
          <a href="#" class="about-btn">Apply Now</a>
        </div>
      </div>
    </section><!-- End Services Section -->
     <section id="clients" class="certified clients">
      <div class="section-title"><h2>CERTIFIED BY US</h2></div>
      <div class="container-fluid" data-aos="zoom-in">
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="owl-carousel clients-carousel mt-5">
              <img src="../../admin/assets/img/agt-1-211x100.jpg" alt="">
              <img src="../../admin/assets/img/ai-211x100.jpg" alt="">
              <img src="../../admin/assets/img/ajm-211x100.jpg" alt="">
              <img src="../../admin/assets/img/alba-211x100.jpg" alt="">
              <img src="../../admin/assets/img/am-211x100.jpg" alt="">
              <img src="../../admin/assets/img/ama-211x100.jpg" alt="">
              <img src="../../admin/assets/img/brock-211x100.jpg" alt="">
              <img src="../../admin/assets/img/brunei-1-211x100.jpg" alt="">
              <img src="../../admin/assets/img/dio-211x100.jpg" alt="">
              <img src="../../admin/assets/img/kitc-211x100.jpg" alt="">
              <img src="../../admin/assets/img/kwa-211x100.jpg" alt="">
              <img src="../../admin/assets/img/ldc-211x100.jpg" alt="">
              <img src="../../admin/assets/img/moto-211x100.jpg" alt="">
              <img src="../../admin/assets/img/nest-211x100.jpg" alt="">
              <img src="../../admin/assets/img/orga-211x100.jpg" alt="">
              <img src="../../admin/assets/img/patc-211x100.jpg" alt="">
              <img src="../../admin/assets/img/rasasi-211x100.jpg" alt="">
              <img src="../../admin/assets/img/red-1-211x100.jpg" alt="">
              <img src="../../admin/assets/img/san-211x100.jpg" alt="">
              <img src="../../admin/assets/img/spani-1-211x100.jpg" alt="">
              <img src="../../admin/assets/img/tro-1-211x100.jpg" alt="">
              <img src="../../admin/assets/img/uni-1-211x100.jpg" alt="">
              <img src="../../admin/assets/img/y-211x100.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>About Racs<span>.</span></h3>
            <p>
              Established in 2009, RACS is a Worldwide Quality Conformity Assessment Body serving the inspection, verification, testing, assessments and certification requirements of clients throughout UAE, GCC, and worldwide, delivering high quality services to help clients meet the growing challenges of quality and social responsibility.
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>SERVICES</h4>
            <ul>
              <li><a href="#">Halal Certification and UAE Halal National Mark:</a></li>
              <li><a href="#">Energy Efficiency Standards and Labeling EESL</a></li>
              <li><a href="#">Emirates Quality Mark (EQM)</a></li>
              <li><a href="#">Emirates Conformity Assessment Scheme (ECAS)</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>NAVIGATION</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">FAQ</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Events</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Careers</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
            <div class="social-links pt-3 pt-md-4">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-3">
      <div class="copyright text-center">
          &copy; Copyright <strong><span>Racs</span></strong>. All Rights Reserved
        </div>
    </div>
  </footer><!-- End Footer -->
  <!-- Vendor JS Files -->
      <script src="/admin/assets/vendor/jquery/jquery.min.js"></script>
      <script src="/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="/admin/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
      <script src="/admin/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
      <script src="/admin/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
      <script src="/admin/assets/vendor/aos/aos.js"></script>

      <!-- Template Main JS File -->
      <script src="../../admin/js/main.js"></script>
    </body>
</html>
