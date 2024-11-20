<?php
$body_class = 'index-page';
include('header.php'); 
// Connect to the database
include 'admin/connection.php';

// Fetch team members from the database
$query = "SELECT * FROM team";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<body class="team-page">

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>Our Team</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li class="current">Team</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Team Section -->
        <section id="team" class="team section">
            <div style="text-align: center;">
                <h1>Dedicated & Experienced Team Members</h1>
            </div>

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
                                "delay": 3000
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

</html>