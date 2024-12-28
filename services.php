<?php
include('header.php');
// include 'admin/connection.php';
?>
<body class="services-page">

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Services</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Services</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Tabs Section -->
    <section id="tabs" class="tabs section light-background">
        <div class="container">
            <h1 class="" data-aos="fade-up">Our Mission</h1>
            <div class="row">
                <div class="col-lg-4 js-custom-dots">
                    <a href="#" class="service-item link horizontal d-flex active" data-aos="fade-left"
                        data-aos-delay="0">
                        <div class="service-icon color-1 mb-4">
                            <i class="bi bi-alarm"></i>
                        </div>
                        <!-- /.icon -->
                        <div class="service-contents">
                            <h3>Sales & Marketing</h3>
                            <p>
                                Sales and marketing services are designed to unlock new revenue streams for businesses .
                            </p>
                        </div>
                        <!-- /.service-contents-->
                    </a>
                    <!-- /.service -->

                    <a href="#" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="100">
                        <div class="service-icon color-2 mb-4">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <!-- /.icon -->
                        <div class="service-contents">
                            <h3>Distribution & Logistics</h3>
                            <p>
                                360-degree distribution and logistics system.
                            </p>
                        </div>
                        <!-- /.service-contents-->
                    </a>
                    <!-- /.service -->

                    <a href="#" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="200">
                        <div class="service-icon color-3 mb-4">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <!-- /.icon -->
                        <div class="service-contents">
                            <h3>Exchange</h3>
                            <p>
                                Trading solutions connect businesses to valuable resources .
                            </p>
                        </div>
                        <!-- /.service-contents-->
                    </a>
                    <!-- /.service -->

                    <a href="#" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="300">
                        <div class="service-icon color-4 mb-4">
                            <i class="bi bi-easel"></i>
                        </div>
                        <!-- /.icon -->
                        <div class="service-contents">
                            <h3>Quality</h3>
                            <p>
                                Maintain our commitment to quality through regular audits .
                            </p>
                        </div>
                        <!-- /.service-contents-->
                    </a>
                    <!-- /.service -->
                </div>

                <div class="col-lg-8">
                    <div class="swiper init-swiper-tabs">
                        <script type="application/json" class="swiper-config">
                            {
                                "loop": true,
                                "speed": 600,
                                "autoHeight": true,
                                "autoplay": {
                                    "delay": 5000
                                },
                                "slidesPerView": "auto",
                                "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                },
                                "breakpoints": {
                                    "320": {
                                        "slidesPerView": 1,
                                        "spaceBetween": 40
                                    },
                                    "1200": {
                                        "slidesPerView": 1,
                                        "spaceBetween": 1
                                    }
                                }
                            }
                        </script>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="assets/img/img_h_1.jpg" alt="Image" class="img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/img/img_h_2.jpg" alt="Image" class="img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/img/img_h_3.jpg" alt="Image" class="img-fluid">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/img/img_h_4.jpg" alt="Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Tabs Section -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <!-- Card 1 -->
                <div class="col-lg-3">
                    <div class="services-item serviceclass" data-aos="fade-up">
                        <div class="services-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <div>
                            <h3>No Copy Products</h3>
                            <p>All Products are imported from unilever global brands from various countries.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-3">
                    <div class="services-item serviceclass" data-aos="fade-up" data-aos-delay="100">
                        <div class="services-icon">
                            <i class="bi bi-command"></i>
                        </div>
                        <div>
                            <h3>Dedicated Team</h3>
                            <p>We provide exceptional service and products at competitive prices, supporting ethical
                                business practices.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-lg-3">
                    <div class="services-item serviceclass" data-aos="fade-up" data-aos-delay="200">
                        <div class="services-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <div>
                            <h3>24/7 Available</h3>
                            <p>We are available at all times for our clients' needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

  </main>

</body>


<?php include('footer.php'); ?>