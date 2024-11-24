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

        <!-- About 2 Section -->
        <section id="about-2" class="about-2 section">

            <div class="container">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4">
                            <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                                <div class="img">
                                    <img src="assets/img/img_v_3.jpg" alt="circle image" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="offset-md-0 offset-lg-1 col-sm-12 col-md-5 col-lg-5 col-xl-4" data-aos="fade-up">
                            <div class="px-3">
                                <span class="content-subtitle">Our Mission</span>
                                <h2 class="content-title text-start">
                                    The Big Oxmox advised her not to do so, because there were
                                    thousands.
                                </h2>
                                <p class="lead">
                                    A small river named Duden flows by their place and supplies it
                                    with the necessary regelialia. It is a paradisematic country.
                                </p>
                                <p class="mb-5">
                                    The Big Oxmox advised her not to do so, because there were
                                    thousands of bad Commas, wild Question Marks and devious Semikoli.
                                </p>
                                <p>
                                    <a href="#" class="btn-get-started">Get Started</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /About 2 Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-3">
                        <div class="services-item" data-aos="fade-up">
                            <div class="services-icon">
                                <i class="bi bi-bullseye"></i>
                            </div>
                            <div>
                                <h3>Technology</h3>
                                <p>Separated they live in Bookmarksgrove right at the coast</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="services-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="services-icon">
                                <i class="bi bi-command"></i>
                            </div>
                            <div>
                                <h3>Web Design</h3>
                                <p>Separated they live in Bookmarksgrove right at the coast</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="services-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="services-icon">
                                <i class="bi bi-bar-chart"></i>
                            </div>
                            <div>
                                <h3>Branding</h3>
                                <p>Separated they live in Bookmarksgrove right at the coast</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- /Services Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section light-background">

            <div class="container">

                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-5">
                        <div class="images-overlap">
                            <img src="assets/img/img_v_1.jpg" alt="student" class="img-fluid img-1" data-aos="fade-up">
                        </div>
                    </div>

                    <div class="col-lg-4 ps-lg-5">
                        <span class="content-subtitle">Why Us</span>
                        <h2 class="content-title">Far far away Behind the Word Mountains</h2>
                        <p class="lead">
                            Far far away, behind the word mountains, far from the countries
                            Vokalia and Consonantia.
                        </p>
                        <p class="mb-5">
                            There live the blind texts. Separated they live in Bookmarksgrove
                            right at the coast of the Semantics, a large language ocean.
                        </p>
                        <div class="row mb-5 count-numbers">

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="100">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="3919" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Coffee</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="200">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="2831" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Codes</span>
                            </div>
                            <!-- End Stats Item -->

                            <!-- Start Stats Item -->
                            <div class="col-4 counter" data-aos="fade-up" data-aos-delay="300">
                                <span data-purecounter-separator="true" data-purecounter-start="0"
                                    data-purecounter-end="1914" data-purecounter-duration="1"
                                    class="purecounter number"></span>
                                <span class="d-block">Projects</span>
                            </div>
                            <!-- End Stats Item -->

                        </div>
                    </div>

                </div>

            </div>
        </section><!-- /Stats Section -->

        <!-- Team Section -->
        <section id="team" class="team section">

            <div class="site-section slider-team-wrap">
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