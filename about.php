<?php
$body_class = 'index-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';

// Fetch team members from the database
$query = "SELECT * FROM team";
$result = mysqli_query($conn, $query);
?>

<body class="about-page">

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>About</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">About</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Stats Section -->
        <section id="stats" class="stats section light-background">

            <div class="container">

                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-5">
                        <div class="images-overlap">
                            <img src="assets/img/all.png" alt="student" class="img-fluid img-1" data-aos="fade-up">
                        </div>
                    </div>

                    <div class="col-lg-4 ps-lg-5">
                        <span class="content-subtitle">Why Us</span>
                        <h2 class="content-title">Premiumness of your look in exceeding excellence</h2>
                        <p class="mb-5">
                            Artisan Business Network is an import and distribution company that specializes in sourcing
                            and
                            delivering high-quality products from overseas suppliers to businesses and consumers in the
                            local market. We are dedicated to providing our customers with exceptional service and
                            products
                            at competitive prices, while also supporting fair trade and ethical business practices.
                        </p>
                        <div class="row mb-5 count-numbers">

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="100">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="96" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Dristribution House</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="200">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="19" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Brands</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="300">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="208" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Products</span>
                            </div>
                            <!-- End Stats Item -->

                        </div>
                    </div>

                </div>

            </div>
        </section>

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

        <!-- Team Section -->
        <section id="team" class="team section">

            <div class="site-section slider-team-wrap">
            <h1 style="text-align:center; margin-top:2%;" >Meet Our Team</h1>
                <div class="container">

                    <div class="slider-nav d-flex justify-content-end mb-3">
                        <a href="#" class="js-prev js-custom-prev"><i class="bi bi-arrow-left-short"></i></a>
                        <a href="#" class="js-next js-custom-next"><i class="bi bi-arrow-right-short"></i></a>
                    </div>

                    <div class="swiper init-swiper" data-aos="fade-up" data-aos-delay="100">
                        <script type="application/json" class="swiper-config">
                            {
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                    "delay": 5000
                                },
                                "slidesPerView": "1",
                                "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                },
                                "navigation": {
                                    "nextEl": ".js-custom-next",
                                    "prevEl": ".js-custom-prev"
                                },
                                "breakpoints": {
                                    "640": {
                                        "slidesPerView": 2,
                                        "spaceBetween": 30
                                    },
                                    "768": {
                                        "slidesPerView": 3,
                                        "spaceBetween": 30
                                    },
                                    "1200": {
                                        "slidesPerView": 3,
                                        "spaceBetween": 30
                                    }
                                }
                            }
                        </script>
                        <div class="swiper-wrapper">
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <div class="swiper-slide">
                                    <div class="team">
                                        <div class="pic">
                                            <img src="<?= htmlspecialchars($row['image']) ?>"
                                                alt="<?= htmlspecialchars($row['name']) ?>" class="img-fluid">
                                        </div>
                                        <h3>
                                            <span class=""><?= htmlspecialchars($row['name']) ?></span>
                                        </h3>
                                        <span class="d-block position"><?= htmlspecialchars($row['designation']) ?></span>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <!-- /.container -->
            </div>
        </section><!-- /Team Section -->

    </main>

</body>

<?php include('footer.php'); ?>