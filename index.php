<?php
$body_class = 'index-page';
include('header.php'); 
// Connect to the database
include 'admin/connection.php';
?>

<main class="main">

    <section id="about" class="about section grn">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="400">
                    <div class="swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
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
                            <!-- Slide 1 -->
                            <div class="swiper-slide d-flex align-items-center">
                                <div class="slide-image" style="flex: 1.5;">
                                    <img src="assets/img/Slider/all.png" alt="Image" class="img-fluid">
                                </div>
                                <div class="slide-content ml-4" style="flex: 1;">
                                    <h2>AXE</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia...</p>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="swiper-slide d-flex align-items-center">
                                <div class="slide-image" style="flex: 1.5;">
                                    <img src="assets/img/Slider/stives.png" alt="Image" class="img-fluid">
                                </div>
                                <div class="slide-content ml-4" style="flex: 1;">
                                    <h2>Lorem Ipsum Dolor Sit Amet</h2>
                                    <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a
                                        large language ocean...</p>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div class="swiper-slide d-flex align-items-center">
                                <div class="slide-image" style="flex: 1.5;">
                                    <img src="assets/img/Slider/axe.png" alt="Image" class="img-fluid">
                                </div>
                                <div class="slide-content ml-4" style="flex: 1;">
                                    <h2>Ut Enim ad Minim Veniam</h2>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary
                                        regelialia...</p>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div class="swiper-slide d-flex align-items-center">
                                <div class="slide-image" style="flex: 1.5;">
                                    <img src="assets/img/Slider/bru.png" alt="Image" class="img-fluid">
                                </div>
                                <div class="slide-content ml-4" style="flex: 1;">
                                    <h2>Ut Enim ad Minim Veniam</h2>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary
                                        regelialia...</p>
                                </div>
                            </div>
                        </div>
                        <!-- Centered pagination dots -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- About 2 Section -->
    <section id="about-2" class="about-2 section light-background">

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
                    <h2 class="content-title">Premiumness of your look in exceeding excellence</h2>
                    <p class="mb-5">
                        Artisan Business Network is an import and distribution company that specializes in sourcing and
                        delivering high-quality products from overseas suppliers to businesses and consumers in the
                        local market. We are dedicated to providing our customers with exceptional service and products
                        at competitive prices, while also supporting fair trade and ethical business practices.
                    </p>
                    <div class="row mb-5 count-numbers">

                        <!-- Start Stats Item -->
                        <div class="col-4 counter" data-aos="fade-up" data-aos-delay="100">
                            <span data-purecounter-separator="true" data-purecounter-start="0" data-purecounter-end="96"
                                data-purecounter-duration="1" class="purecounter number"></span>
                            <span class="d-block">Dristribution House</span>
                        </div>
                        <!-- End Stats Item -->

                        <!-- Start Stats Item -->
                        <div class="col-4 counter" data-aos="fade-up" data-aos-delay="200">
                            <span data-purecounter-separator="true" data-purecounter-start="0" data-purecounter-end="17"
                                data-purecounter-duration="1" class="purecounter number"></span>
                            <span class="d-block">Brands</span>
                        </div>
                        <!-- End Stats Item -->

                        <!-- Start Stats Item -->
                        <div class="col-4 counter" data-aos="fade-up" data-aos-delay="300">
                            <span data-purecounter-separator="true" data-purecounter-start="0"
                                data-purecounter-end="180" data-purecounter-duration="1"
                                class="purecounter number"></span>
                            <span class="d-block">Products</span>
                        </div>
                        <!-- End Stats Item -->

                    </div>
                </div>

            </div>

        </div>
    </section>

    <?php

// Define the query
$query = "SELECT * FROM brands";

// Execute the query and check for errors
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error); // Show a message if the query fails
}
?>

    <!-- Starts Brands -->
    <section id="brands" class="brands section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h1>Our Brands</h1>
        </div>
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-6 col-sm-4 col-lg-2">
                    <!-- Adjusted column classes for 5 items per row -->
                    <a href="brand-details.php?id=<?php echo $row['brand_id']; ?>" class="brand-card-link">
                        <div class="brand-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="brand-image">
                                <img src="<?php echo $row['b_image']; ?>" alt="<?php echo $row['brand_name']; ?>"
                                    class="img-fluid rounded">
                            </div>
                            <div class="brand-content">
                                <h3><?php echo $row['brand_name']; ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <!-- Ends Brands -->



    <!-- Tabs Section -->
    <section id="tabs" class="tabs section light-background">

        <div class="container">
            <div class="row gap-x-lg-4 justify-content-between">
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
                                <!-- <img src="assets/img/img_h_1.jpg" alt="Image" class="img-fluid"> -->
                                <div class="p-4">
                                    <h3 class="text-black h5 mb-3">Sales & Marketing</h3>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                Our comprehensive sales and marketing services are designed to unlock
                                                new revenue streams for businesses operating in Bangladesh. We achieve
                                                this by ensuring widespread product distribution across all relevant
                                                channels throughout the country.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <!-- <img src="assets/img/img_h_2.jpg" alt="Image" class="img-fluid"> -->
                                <div class="p-4">
                                    <h3 class="text-black h5 mb-3">Distribution & Logistics</h3>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p>
                                                With our 360-degree distribution and logistics system, we possess the
                                                capability to deliver products to any location in the country within 48
                                                hours, ensuring timely and efficient delivery. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <!-- <img src="assets/img/img_h_3.jpg" alt="Image" class="img-fluid"> -->
                                <div class="p-4">
                                    <h3 class="text-black h5 mb-3">Exchange</h3>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p>
                                                Our trading solutions connect businesses to valuable resources from
                                                around the world. This enriches and diversifies the product offerings of
                                                various companies. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <!-- <img src="assets/img/img_h_4.jpg" alt="Image" class="img-fluid"> -->
                                <div class="p-4">
                                    <h3 class="text-black h5 mb-3">Quality</h3>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p>
                                                We maintain our commitment to quality through regular audits and
                                                rigorous follow-up procedures for all activities, adhering to our
                                                well-defined quality manual and the Standard Operating Procedures (SOP),
                                                which serve as the bedrock of Artisan's operational standards.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section><!-- /Tabs Section -->


    <!-- Product Section -->
    <section id="products" class="products section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h1>Our Products</h1>
        </div>

        <!-- Container for Product Cards -->
        <div class="container">
            <div class="row gy-4 justify-content-center">

                <?php
      $query = "SELECT * FROM product LIMIT 15"; // Fetch 15 products
      $result = $conn->query($query);

      while ($row = $result->fetch_assoc()):
      ?>
                <div class="col-lg-2-4 col-md-4 col-sm-6">
                    <a href="product_details.php?id=<?php echo $row['product_id']; ?>" class="product-card"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="image-container">
                            <img src="admin/uploads/products/<?php echo $row['p_image1']; ?>"
                                alt="<?php echo $row['product_title']; ?>" class="img-fluid">
                        </div>
                        <div class="product-content text-center mt-2">
                            <h8><?php echo $row['product_title']; ?></h8>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>

            </div>
        </div>
    </section>
    <!-- End Product Section -->




    <!-- Services 2 Section -->
    <section id="services-2" class="services-2 section">

        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-md-6 col-lg-4">
                    <span class="content-subtitle">Our Services</span>
                    <h2 class="content-title">
                        Far far away, behind the word mountains, far from the countries
                        Vokalia
                    </h2>
                    <p class="lead">
                        Far far away, behind the word mountains, far from the countries
                        Vokalia and Consonantia, there live the blind texts.
                    </p>
                    <p class="mb-5">
                        Separated they live in Bookmarksgrove right at the coast of the
                        Semantics, a large language ocean.
                    </p>
                    <p>
                        <a href="#" class="btn btn-get-started">Get Started</a>
                    </p>
                </div>
                <div class="col-md-6 col-lg-6 ps-lg-5">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="services-item" data-aos="fade-up" data-aos-delay="">
                                <div class="services-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                                <div>
                                    <h3>Square</h3>
                                    <p>Separated they live in Bookmarksgrove right at the coast</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="services-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="services-icon">
                                    <i class="bi bi-command"></i>
                                </div>
                                <div>
                                    <h3>Technology</h3>
                                    <p>Separated they live in Bookmarksgrove right at the coast</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="services-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="services-icon">
                                    <i class="bi bi-grid"></i>
                                </div>
                                <div>
                                    <h3>Brilliant Ideas</h3>
                                    <p>Separated they live in Bookmarksgrove right at the coast</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="services-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="services-icon">
                                    <i class="bi bi-globe"></i>
                                </div>
                                <div>
                                    <h3>Blueprint</h3>
                                    <p>Separated they live in Bookmarksgrove right at the coast</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Services 2 Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>Plans</p>
            <h2>Frequently Asked Questions</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-12">
                    <div class="custom-accordion" id="accordion-faq">
                        <div class="accordion-item">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-faq-1">
                                    How to download and register?
                                </button>
                            </h2>

                            <div id="collapse-faq-1" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion-faq">
                                <div class="accordion-body">
                                    Far far away, behind the word mountains, far from the countries
                                    Vokalia and Consonantia, there live the blind texts. Separated
                                    they live in Bookmarksgrove right at the coast of the Semantics,
                                    a large language ocean.
                                </div>
                            </div>
                        </div>
                        <!-- .accordion-item -->

                        <div class="accordion-item">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-faq-2" "="">
            How to create your paypal account?
          </button>
        </h2>
        <div id=" collapse-faq-2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion-faq">
                                    <div class="accordion-body">
                                        A small river named Duden flows by their place and supplies it
                                        with the necessary regelialia. It is a paradisematic country, in
                                        which roasted parts of sentences fly into your mouth.
                                    </div>
                        </div>
                    </div>
                    <!-- .accordion-item -->

                    <div class="accordion-item">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-faq-3">
                                How to link your paypal and bank account?
                            </button>
                        </h2>

                        <div id="collapse-faq-3" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion-faq">
                            <div class="accordion-body">
                                When she reached the first hills of the Italic Mountains, she
                                had a last view back on the skyline of her hometown
                                Bookmarksgrove, the headline of Alphabet Village and the subline
                                of her own road, the Line Lane. Pityful a rethoric question ran
                                over her cheek, then she continued her way.
                            </div>
                        </div>
                    </div>
                    <!-- .accordion-item -->

                </div>
            </div>
        </div>
        </div>
    </section><!-- /Faq Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>Happy Customers</p>
            <h2>Testimonials</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
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
                                <div class="testimonial mx-auto">
                                    <figure class="img-wrap">
                                        <img src="assets/img/testimonials/testimonials-1.jpg" alt="Image"
                                            class="img-fluid">
                                    </figure>
                                    <h3 class="name">Adam Aderson</h3>
                                    <blockquote>
                                        <p>
                                            “There live the blind texts. Separated they live in
                                            Bookmarksgrove right at the coast of the Semantics, a large
                                            language ocean.”
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial mx-auto">
                                    <figure class="img-wrap">
                                        <img src="assets/img/testimonials/testimonials-2.jpg" alt="Image"
                                            class="img-fluid">
                                    </figure>
                                    <h3 class="name">Lukas Devlin</h3>
                                    <blockquote>
                                        <p>
                                            “There live the blind texts. Separated they live in
                                            Bookmarksgrove right at the coast of the Semantics, a large
                                            language ocean.”
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial mx-auto">
                                    <figure class="img-wrap">
                                        <img src="assets/img/testimonials/testimonials-3.jpg" alt="Image"
                                            class="img-fluid">
                                    </figure>
                                    <h3 class="name">Kayla Bryant</h3>
                                    <blockquote>
                                        <p>
                                            “There live the blind texts. Separated they live in
                                            Bookmarksgrove right at the coast of the Semantics, a large
                                            language ocean.”
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Testimonials Section -->

</main>

<style>
.swiper-slide {
    display: flex;
    align-items: center;
}

.slide-image img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

.slide-content {
    padding-left: 30px;
}

.slide-content h2 {
    font-size: 2em;
    margin-bottom: 10px;
}

.slide-content p {
    font-size: 1.2em;
    line-height: 1.6;
}

/* Ensure pagination is centered */
.swiper-pagination {
    display: flex !important;
    justify-content: center !important;
    margin-top: 20px;
    margin-left: 50%;
    width: 100% !important;
}

/* Custom width for 5 items per row on large screens */
.col-lg-2-4 {
    flex: 0 0 20%;
    /* 20% width for each item */
    max-width: 20%;
}

/* Product card styles */
.product-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    border: 2px solid transparent;
    /* Transparent border initially */
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1);
    /* Subtle shadow */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    background-color: #fff;
    height: 100%;
    position: relative;
    /* Needed for pseudo-element */
    overflow: hidden;
    /* Ensures pseudo-element stays within bounds */
}

/* Hover effect for card shadow and slight lift */
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 123, 255, 0.2);
}

/* Dynamic border effect using pseudo-element */
.product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 10px;
    border: 2px solid green;
    /* Green border effect */
    z-index: 1;
    pointer-events: none;
    /* Ensure no interaction */
    clip-path: circle(0% at 50% 50%);
    /* Initially hidden */
    transition: clip-path 0.3s ease-out;
    /* Smooth transition */
}

/* Expand border from the cursor position on hover */
.product-card:hover::before {
    clip-path: circle(150% at var(--x, 50%) var(--y, 50%));
}

/* Image container styles */
.image-container {
    width: 100%;
    height: 200px;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 10px;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease-in-out;
}

/* Zoom effect on hover */
.image-container:hover img {
    transform: scale(1.1);
}

/* Title styling */
.product-content h8 {
    font-size: 12px;
    text-transform: capitalize;
    color: #333;
    margin: 0;
}

.product-content h8:hover {
    color: #007bff;
}

/* Custom column width for 5 per row */
.col-lg-2-4 {
    flex: 0 0 20%;
    max-width: 20%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-lg-2-4 {
        flex: 0 0 33.33%;
        max-width: 33.33%;
    }
}

@media (max-width: 576px) {
    .col-lg-2-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}
</style>

<script>
const imageSwiper = new Swiper('.image-swiper', {
    loop: true,
    autoplay: {
        delay: 5000,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

const textSwiper = new Swiper('.text-swiper', {
    loop: true,
    autoplay: {
        delay: 5000,
    },
});

// Synchronize both Swipers
imageSwiper.on('slideChange', () => {
    textSwiper.slideTo(imageSwiper.realIndex);
});

textSwiper.on('slideChange', () => {
    imageSwiper.slideTo(textSwiper.realIndex);
});

document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.setProperty('--x', `${x}px`);
        card.style.setProperty('--y', `${y}px`);
    });
});
</script>

<?php include('footer.php'); ?>