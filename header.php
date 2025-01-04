<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABNB - Artisan Business Network Bangladesh</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
	<link rel="icon" href="admin/assets/images/logo-2-1.png" type="image/png" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <style>
        /* Initial transparent header */
        #header {
            background-color: transparent;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            z-index: 10;
        }

        /* Add background and shadow on scroll */
        #header.scrolled {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Sticky and transparent on scroll for darker sections */
        .sticky-top.scrolled {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Navigation link styling */
        .navmenu a.active {
            color: #34bf49;
            font-weight: bold;
        }
    </style>
</head>

<body class="<?php echo $body_class; ?>">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/abc.png" alt="Logo">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#"><span>About</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="statement.php">Statement</a></li>
                            <li><a href="partner.php">Our Supply Partner</a></li>
                            <li><a href="team.php">Our Team Member</a></li>
                        </ul>
                    </li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="brands.php">Brands</a></li>
                    <li class="dropdown">
                        <a href="#"><span>Products</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="products.php">Unilever Products</a></li>
                            <li><a href="#">Ximi-V Products</a></li>
                            <li><a href="#">TBA</a></li>
                        </ul>
                    </li>
                    <li><a href="blog.php">News</a></li>
                    <li><a href="career.php">Career</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <script>
        // Change header background on scroll
        window.addEventListener("scroll", function () {
            const header = document.getElementById("header");
            header.classList.toggle("scrolled", window.scrollY > 50);
        });

        // Highlight active menu item
        document.addEventListener("DOMContentLoaded", function () {
            const currentPage = window.location.pathname.split("/").pop();
            const menuItems = document.querySelectorAll("#navmenu a");

            menuItems.forEach(item => {
                if (item.getAttribute("href") === currentPage) {
                    item.classList.add("active");
                }
            });
        });
    </script>

