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
$brands_query = "SELECT br.*, GROUP_CONCAT(DISTINCT pr.categories_id) AS categories_ids 
                 FROM brands br
                 INNER JOIN product pr ON br.brand_id = pr.brand_id
                 GROUP BY br.brand_id
                 ORDER BY br.brand_name ASC";
$brands_result = mysqli_query($conn, $brands_query);
?>


<main class="main" style="width:100%;">

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
                    <li data-filter="*" class="filter-active" onclick="filterBrand(0)">All</li>
                    <?php while ($row = mysqli_fetch_assoc($categories_result)): ?>
                        <li data-filter=".filter-<?= $row['categories_id'] ?>"
                            onclick="filterBrand(<?= $row['categories_id'] ?>)">
                            <?= $row['category_name'] ?>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

                    <div id="brands-container" class="row gy-4 isotope-containerss" data-aos="fade-up"
                        data-aos-delay="200">
                        <?php if (mysqli_num_rows($brands_result) > 0): ?>
                            <?php while ($brand = mysqli_fetch_assoc($brands_result)): ?>
                                <div class="col-4 portfolio-item isotope-itemss filter-<?= $brand['categories_ids'] ?>"
                                    data-categories="0,<?= $brand['categories_ids'] ?>">
                                    <div class="brand-card"
                                        onclick="window.location.href='brand-details.php?brand_id=<?= $brand['brand_id'] ?>'">
                                        <img src="admin/<?= $brand['b_image'] ?>" class="brand-logo"
                                            alt="<?= $brand['brand_name'] ?>">
                                        <h4><?= $brand['brand_name'] ?></h4>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No brands found for this category.</p>
                        <?php endif; ?>
                    </div>

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->


</main>


<script>
function filterBrand(categoryId) {
    const brandCards = document.querySelectorAll('.portfolio-item'); // Select all brand cards

    // Loop through each card to check its category
    brandCards.forEach(card => {
        const categories = card.dataset.categories ? card.dataset.categories.split(',') : []; // Categories for the card

        if (categories.includes(String(categoryId))) {
            card.classList.remove('d-none'); // Show card
        } else {
            card.classList.add('d-none'); // Hide card
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

<?php include('footer.php'); ?>