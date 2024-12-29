<?php
$body_class = 'index-page';
include('header.php');
include 'admin/connection.php';

// Fetch categories for filters
$categories_query = "SELECT cat.categories_id, cat.category_name 
                     FROM categories cat 
                     INNER JOIN product pr on pr.categories_id = cat.categories_id
                     GROUP BY cat.categories_id
                     ORDER BY cat.categories_id ASC";
$categories_result = mysqli_query($conn, $categories_query);

// Fetch brands with associated categories
$brands_query = "SELECT br.*, pr.categories_id AS categories_ids 
                 FROM brands br
                 LEFT JOIN product pr ON br.brand_id = pr.brand_id
                 GROUP BY pr.categories_id,br.brand_id
                 ORDER BY br.brand_name ASC";
$brands_result = mysqli_query($conn, $brands_query);
?>


<main class="main" style="width:100%;">

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <h1>Portfolio</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Portfolio</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <div class="container">

            <div class="col-md-12 isotope-layout" data-default-filter="*" data-layout="masonry"
                data-sort="original-order">

                <!-- <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".aaa">AAA</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-product">Card</li>
            <li data-filter=".filter-branding">Web</li>
          </ul>End Portfolio Filters -->

                <!-- Portfolio Filters -->
                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active" onclick="filterBrands('all')">All</li>
                    <?php while ($row = mysqli_fetch_assoc($categories_result)): ?>
                        <li data-filter=".filter-<?= $row['categories_id'] ?>"
                            onclick="filterBrands(<?= $row['categories_id'] ?>)">
                            <?= $row['category_name'] ?><?= $row['categories_id'] ?>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    <div id="brands-container" class="row gy-4 isotope-container" data-aos="fade-up"
                        data-aos-delay="200">
                        <?php if (mysqli_num_rows($brands_result) > 0): ?>
                            <?php while ($brand = mysqli_fetch_assoc($brands_result)): ?>
                                <div class="col-4 portfolio-item isotope-item filter-<?= $brand['categories_ids'] ?>"
                                    data-categories="<?= $brand['categories_ids'] ?>">
                                    <div class="brand-card"
                                        onclick="window.location.href='brand-details.php?brand_id=<?= $brand['brand_id'] ?>'">
                                        <img src="<?= $brand['b_image'] ?>" class="brand-logo"
                                            alt="<?= $brand['brand_name'] ?>">
                                        <h4><?= $brand['brand_name'] ?><?= $brand['categories_ids'] ?></h4>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No brands found for this category.</p>
                        <?php endif; ?>
                    </div>





                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" title="App 1"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 1</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" title="Product 1"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 1</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-3.jpg" title="Branding 1"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-4.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-4.jpg" title="App 2"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-5.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 2</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-5.jpg" title="Product 2"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-6.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 2</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-6.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-7.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 3</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-7.jpg" title="App 3"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-8.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 3</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-8.jpg" title="Product 3"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="assets/img/masonry-portfolio/masonry-portfolio-9.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 3</h4>
                            <p>Lorem ipsum, dolor sit</p>
                            <a href="assets/img/masonry-portfolio/masonry-portfolio-9.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

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
<?php include('footer.php'); ?>