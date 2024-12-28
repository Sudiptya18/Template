<?php
$body_class = 'index-page';
include('header.php');
include 'admin/connection.php';

// Fetch categories for filters
$categories_query = "SELECT cat.categories_id, cat.category_name 
                     FROM categories cat 
                     ORDER BY cat.categories_id ASC";
$categories_result = mysqli_query($conn, $categories_query);

// Fetch brands with associated categories
$brands_query = "SELECT br.*, GROUP_CONCAT(pr.categories_id) AS categories_ids 
                 FROM brands br
                 LEFT JOIN product pr ON br.brand_id = pr.brand_id
                 GROUP BY br.brand_id
                 ORDER BY br.brand_name ASC";
$brands_result = mysqli_query($conn, $brands_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .brand-card {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .brand-card:hover {
            transform: scale(1.05);
        }

        .brand-logo {
            max-height: 150px;
            object-fit: contain;
            margin-bottom: 10px;
        }



        /* .hidden {
            display: hidden;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        } */

        .hidden {
            display: none !important;
        }

        #brands-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Adjust spacing as needed */
}
.portfolio-item {
    flex: 0 0 calc(33.333% - 15px); /* 3 cards per row with spacing */
    max-width: calc(33.333% - 15px);
    box-sizing: border-box;
}

@media (max-width: 768px) {
    .portfolio-item {
        flex: 0 0 50%;
        max-width: 50%;
    }
}





        @media (max-width: 768px) {
            .portfolio-item {
                flex: 0 0 50%;
                /* Two cards per row on smaller screens */
                max-width: 50%;
            }
        }
    </style>
</head>

<body class="portfolio-page">

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>Brands</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li class="current">Brands</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">
            <div class="container">

                <!-- Portfolio Filters -->
                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active" onclick="filterBrands('all')">All</li>
                    <?php while ($row = mysqli_fetch_assoc($categories_result)): ?>
                        <li data-filter=".filter-<?= $row['categories_id'] ?>"
                            onclick="filterBrands(<?= $row['categories_id'] ?>)">
                            <?= $row['category_name'] ?>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <!-- Portfolio Container -->
                <div id="brands-container" class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    <?php if (mysqli_num_rows($brands_result) > 0): ?>
                        <?php while ($brand = mysqli_fetch_assoc($brands_result)): ?>
                            <div class="col-4 portfolio-item isotope-item" data-categories="<?= $brand['categories_ids'] ?>">
                                <div class="brand-card"
                                    onclick="window.location.href='brand-details.php?brand_id=<?= $brand['brand_id'] ?>'">
                                    <img src="<?= $brand['b_image'] ?>" class="brand-logo" alt="<?= $brand['brand_name'] ?>">
                                    <h4><?= $brand['brand_name'] ?></h4>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No brands found for this category.</p>
                    <?php endif; ?>
                </div>

            </div>
        </section>

    </main>

    <script>
        // JavaScript for filtering brands without reloading the page
        // function filterBrands(categoryId) {
        //     const brandCards = document.querySelectorAll('.portfolio-item'); // Select all brand cards

        //     // Loop through each card to check its category
        //     brandCards.forEach(card => {
        //         const categories = card.dataset.categories ? card.dataset.categories.split(',') : []; // Categories for the card

        //         if (categoryId === 'all' || categories.includes(String(categoryId))) {
        //             card.classList.remove('hidden');
        //         } else {
        //             card.classList.add('hidden');
        //         }
        //     });

        //     // Trigger a reflow for isotope layout (or equivalent layout engine)
        //     const container = document.getElementById('brands-container');
        //     container.style.display = 'none'; // Force reflow
        //     setTimeout(() => {
        //         container.style.display = 'flex'; // Restore layout
        //     }, 1);
        // }

        function filterBrands(categoryId) {
            const brandCards = document.querySelectorAll('.portfolio-item'); // Select all brand cards

            // Loop through each card to check its category
            brandCards.forEach(card => {
                const categories = card.dataset.categories ? card.dataset.categories.split(',') : []; // Categories for the card

                if (categoryId === 'all' || categories.includes(String(categoryId))) {
                    card.classList.remove('hidden'); // Show card
                } else {
                    card.classList.add('hidden'); // Hide card
                }
            });

            // Force reflow of layout
            const container = document.getElementById('brands-container');
            container.classList.remove('isotope-container'); // Temporarily remove class to reset layout
            setTimeout(() => {
                container.classList.add('isotope-container'); // Reapply class after layout adjustment
            }, 0);
        }
    </script>

</body>
<?php include('footer.php'); ?>

</html>