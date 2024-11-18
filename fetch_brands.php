<?php
include 'admin/connection.php';

// Check if a category ID is passed
$category_id = isset($_GET['category_id']) && $_GET['category_id'] !== 'all' ? intval($_GET['category_id']) : null;

// Query for fetching brands
if ($category_id) {
    $query = "SELECT pr.categories_id, pr.brand_id, br.brand_name, cat.`category_name` 
          FROM product pr 
          INNER JOIN brands br ON br.brand_id = pr.brand_id
          INNER JOIN `categories` cat ON cat.`categories_id` = pr.categories_id
          GROUP BY pr.categories_id, br.brand_id 
          ORDER BY cat.categories_id ASC";
} else {
    $query = "SELECT * FROM brands"; // Default query for "All"
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0):
    while ($brand = mysqli_fetch_assoc($result)): ?>
      <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
        <div class="brand-card">
        <?php $brand['b_image'] ;?>
          <img src="<?php $brand['b_image']?>" class="brand-logo" alt="<?php $brand['brand_name'] ?>">
          <h4><?php $brand['brand_name'] ?></h4>
          <a href="brand-details.php?brand_id=<?php $brand['brand_id'] ?>" class="details-link">View Details</a>
        </div>
      </div>
    <?php endwhile;
else: ?>
  <p>No brands found for this category.</p>
<?php endif; ?>
