<?php
$body_class = 'index-page';
include('header.php'); 
// Connect to the database
include 'admin/connection.php';

// Fetch categories for filters
$categories_query = "SELECT pr.categories_id, pr.brand_id, br.brand_name, cat.category_name 
          FROM product pr 
          INNER JOIN brands br ON br.brand_id = pr.brand_id
          INNER JOIN categories cat ON cat.categories_id = pr.categories_id
          GROUP BY pr.categories_id, br.brand_id 
          ORDER BY cat.categories_id ASC";
$categories_result = mysqli_query($conn, $categories_query);

// Check if a category ID is passed for filtering (AJAX request)
 $categories_id = isset($_GET['categories_id']) && $_GET['categories_id'] !== 'all' ? intval($_GET['categories_id']) : null;

// Default brands query or filtered brands query based on the selected category
if ($categories_id) {
    $brands_query = "SELECT br.brand_id, br.brand_name, br.b_image 
          FROM product pr 
          INNER JOIN brands br ON br.brand_id = pr.brand_id
          INNER JOIN categories cat ON cat.categories_id = pr.categories_id
          WHERE pr.categories_id = $categories_id
          GROUP BY br.brand_id 
          ORDER BY br.brand_name ASC";
} else {
    $brands_query = "SELECT * FROM brands ORDER BY brand_name ASC"; // Default query for "All"
}

$brands_result = mysqli_query($conn, $brands_query);

// Check if this is an AJAX request to return only the brands section
if (isset($_GET['categories_id'])):
  echo $_GET['categories_id']; // Only return brands on AJAX call
    if (mysqli_num_rows($brands_result) > 0):
        while ($brand = mysqli_fetch_assoc($brands_result)): ?>
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
            <div class="brand-card">
              <img src="<?= $brand['b_image'] ?>" class="brand-logo" alt="<?= $brand['brand_name'] ?>">
              <h4><?= $brand['brand_name'] ?></h4>
              <a href="brand-details.php?brand_id=<?= $brand['brand_id'] ?>" class="details-link">View Details</a>
            </div>
          </div>
        <?php endwhile;
    else: ?>
      <p>No brands found for this category.</p>
    <?php endif;
    exit(); // Exit after responding to AJAX request
endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="assets/css/main.css"> <!-- Add your CSS file -->
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
    </div><!-- End Page Title -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <div class="container">

        <!-- Portfolio Filters -->
        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active" onclick="filterBrands('all', $categories_result)">All</li>
          <?php while ($row = mysqli_fetch_assoc($categories_result)): ?>
            <li data-filter=".filter-<?= $row['categories_id'] ?>" onclick="filterBrands(<?= $row['categories_id'] ?>)">
              <?= $row['category_name'] ?>
            </li>
          <?php endwhile; ?>
        </ul><!-- End Portfolio Filters -->

        <!-- Portfolio Container -->
        <div id="brands-container" class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          <?php if (mysqli_num_rows($brands_result) > 0): ?>
            <?php while ($brand = mysqli_fetch_assoc($brands_result)): ?>
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                <div class="brand-card">
                  <img src="<?= $brand['b_image'] ?>" class="brand-logo" alt="<?= $brand['brand_name'] ?>">
                  <h4><?= $brand['brand_name'] ?></h4>
                  <a href="brand-details.php?brand_id=<?= $brand['brand_id'] ?>" class="details-link">View Details</a>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p>No brands found for this category.</p>
          <?php endif; ?>
        </div><!-- End Portfolio Container -->

      </div>

    </section><!-- /Portfolio Section -->

  </main>

<script>
// JavaScript for filtering brands without reloading the page
function filterBrands(categoryId) {
  console.log($categories_result);
  let xhr = new XMLHttpRequest();
  let url = 'brands.php'; // The same page for filtering
  
  if (categoryId !== 'all') {
    url += '?category_id=' + categoryId;  // Send category_id for filtering
  }

  xhr.open('GET', url, true);  // Send GET request to the same page with the category_id
  xhr.onload = function () {
    if (this.status === 200) {
      document.getElementById('brands-container').innerHTML = this.responseText;  // Update the brands container
    }
  };
  xhr.send();
}
</script>

</body>

<?php include('footer.php'); ?>
</html>
