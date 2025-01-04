<?php
$body_class = 'team-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';

// Fetch team members from the database
$query = "SELECT * FROM team";
$result = mysqli_query($conn, $query);
?>

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

                    <!-- Swiper -->
                    <div class="swiper init-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            // Assuming $result contains data from the database
                            mysqli_data_seek($result, 0); // Reset the result pointer for reuse
                            while ($row = mysqli_fetch_assoc($result)): ?>
                            <div class="swiper-slide">
                                <div class="pe">
                                    <img src="<?= htmlspecialchars($row['image']) ?>"
                                        alt="<?= htmlspecialchars($row['name']) ?>">
                                    <div class="p-name"><?= htmlspecialchars($row['name']) ?></div>
                                    <div class="p-des"><?= htmlspecialchars($row['designation']) ?></div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
        document.addEventListener("DOMContentLoaded", () => {
            const swiperConfig = {
                loop: true,
                speed: 600,
                autoplay: {
                    delay: 3000,
                },
                slidesPerView: 1,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.js-custom-next',
                    prevEl: '.js-custom-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                },
            };

            // Initialize Swiper
            const swiper = new Swiper('.init-swiper', swiperConfig);
        });
        </script>


        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiperConfig = JSON.parse(document.querySelector(".swiper-config").textContent);

            new Swiper(".swiper-container", {
                ...swiperConfig,
                navigation: {
                    nextEl: ".js-custom-next",
                    prevEl: ".js-custom-prev"
                }
            });
        });
        </script>

    </main>

</body>

<?php include('footer.php'); ?>