<?php
$body_class = 'index-page';
include('header.php'); 
include 'admin/connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filters and pagination data from request
$brand_filter = isset($_GET['brand']) ? $_GET['brand'] : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 16; // Number of products per page
$offset = ($page - 1) * $limit;

// Fetch brands for filter
$brands_result = $conn->query("SELECT brand_id, brand_name FROM brands");
$brands = [];
while ($row = $brands_result->fetch_assoc()) {
    $brands[] = $row;
}

// Fetch categories for filter
$categories_result = $conn->query("SELECT categories_id, category_name FROM categories");
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row;
}

// Fetch products with filters
$query = "SELECT 
            p.product_id, 
            p.sku_name, 
            p.product_title, 
            p.p_image1, 
            p.p_image2, 
            p.pack_size, 
            b.brand_name, 
            c.category_name
          FROM product p
          JOIN brands b ON p.brand_id = b.brand_id
          JOIN categories c ON p.categories_id = c.categories_id
          WHERE p.active = 1";

if ($brand_filter) {
    $query .= " AND p.brand_id = '$brand_filter'";
}
if ($category_filter) {
    $query .= " AND p.categories_id = '$category_filter'";
}

$query .= " LIMIT $offset, $limit";
$products_result = $conn->query($query);

// Count total products for pagination
$count_query = "SELECT COUNT(*) AS total FROM product p WHERE p.active = 1";
if ($brand_filter) {
    $count_query .= " AND p.brand_id = '$brand_filter'";
}
if ($category_filter) {
    $count_query .= " AND p.categories_id = '$category_filter'";
}
$count_result = $conn->query($count_query);
$total_products = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_products / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">
        <!-- Filters Section -->
        <div class="filters">
            <h3>Filters</h3>
            <div class="filter-box">
                <h4>Brand</h4>
                <div class="filter-group">
                    <?php foreach ($brands as $brand): ?>
                        <label>
                            <input type="radio" name="brand" class="filter-option" data-filter="brand" value="<?= $brand['brand_id'] ?>" <?= $brand_filter == $brand['brand_id'] ? 'checked' : '' ?>>
                            <?= $brand['brand_name'] ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="filter-box">
                <h4>Category</h4>
                <div class="filter-group">
                    <?php foreach ($categories as $category): ?>
                        <label>
                            <input type="radio" name="category" class="filter-option" data-filter="category" value="<?= $category['categories_id'] ?>" <?= $category_filter == $category['categories_id'] ? 'checked' : '' ?>>
                            <?= $category['category_name'] ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Products Grid Section -->
        <div class="product-grid">
            <?php if ($products_result->num_rows > 0): ?>
                <?php while ($product = $products_result->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="admin/uploads/products/<?= $product['p_image1'] ?>" alt="<?= $product['product_title'] ?>">
                        <h8><?= $product['product_title'] ?></h8>
                        <p><strong>Pack Size:</strong> <?= $product['pack_size'] ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&brand=<?= $brand_filter ?>&category=<?= $category_filter ?>" class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</body>
<?php include('footer.php'); ?>
</html>
