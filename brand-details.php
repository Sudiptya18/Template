<?php
$body_class = 'brand-details-page';
include('header.php');
include 'admin/connection.php';

// Fetch brand ID from the query parameter
if (!isset($_GET['brand_id']) || empty($_GET['brand_id'])) {
    die("Brand ID is required.");
}

$brand_id = $_GET['brand_id'];

// Fetch brand details
$brand_query = "
    SELECT 
        b.brand_name, 
        b.b_image, 
        bd.details_1, bd.details_2, bd.details_3, bd.details_4, 
        bd.details_5, bd.details_6, bd.details_7, 
        bdi.image_1, bdi.image_2, bdi.image_3, bdi.image_4, bdi.image_5
    FROM 
        brands b
    LEFT JOIN brand_details bd ON b.brand_id = bd.brand_id
    LEFT JOIN brand_details_image bdi ON b.brand_id = bdi.brand_id
    WHERE b.brand_id = ?";

$stmt = $conn->prepare($brand_query);

// Check if prepare() succeeded
if ($stmt === false) {
    die("Failed to prepare query: " . $conn->error);
}

$stmt->bind_param("i", $brand_id);
$stmt->execute();
$brand_data = $stmt->get_result()->fetch_assoc();

if (!$brand_data) {
    die("Brand not found.");
}

// Query to fetch product details with JOINs to fetch category, format, and origin details
$query = "
    SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.pack_size, p.description,
           c.category_name, f.format_name, o.origin_name, p.p_image1
    FROM product p
    LEFT JOIN categories c ON p.categories_id = c.categories_id
    LEFT JOIN format f ON p.format_id = f.format_id
    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
    WHERE p.brand_id = ? AND p.active = 1
";

$stmt = $conn->prepare($query);

// Check if prepare() succeeded for product query
if ($stmt === false) {
    die("Failed to prepare product query: " . $conn->error);
}

$stmt->bind_param("i", $brand_id);
$stmt->execute();
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$sku_query = "SELECT COUNT(*) AS total_skus FROM product WHERE brand_id = $brand_id";
$sku_result = mysqli_query($conn, $sku_query);
$sku_data = mysqli_fetch_assoc($sku_result);
$total_skus = $sku_data['total_skus'] ?? 0;

// Query to count the number of categories for the given brand
$category_query = "
    SELECT COUNT(DISTINCT categories_id) AS total_categories 
    FROM product 
    WHERE brand_id = $brand_id";
$category_result = mysqli_query($conn, $category_query);
$category_data = mysqli_fetch_assoc($category_result);
$total_categories = $category_data['total_categories'] ?? 0;

?>


<!DOCTYPE html>
<html lang="en">

<body class="brand-details-page">
    <main class="main">
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1><?php echo $brand_data['brand_name']; ?></h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li class="current">Brand Details (<?php echo $brand_data['brand_name']; ?>)</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Page Title -->

        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-4 sidebar">
                    <div class="widgets-container">
                        <!-- Card 1: Brand Details -->
                        <div class="brand-card floating-card">
                            <img src="<?php echo $brand_data['b_image']; ?>" class="brand-details-image"
                                alt="<?php echo $brand_data['brand_name']; ?>">
                            <h4><?php echo $brand_data['brand_name']; ?></h4>
                            <p><?php echo $brand_data['details_1']; ?></p>
                        </div>

                        <!-- Card 2: Additional Info (optional content) -->
                        <div class="brand-card floating-card">
                            <p><?php echo $brand_data['details_6']; ?></p>
                        </div>
                    </div>
                    <div class="e-con-inner">
                        <!-- SKUs Card -->
                        <div class="card hover-card">
                            <div class="card-left">
                                <i class="fa fa-box" style=" font-size: 30px; color: #3498db;"></i>
                                <p>SKUs</p>
                            </div>
                            <div class="card-right">
                                <h3><?= htmlspecialchars($total_skus) ?></h3>
                            </div>
                        </div>

                        <!-- Categories Card -->
                        <div class="card hover-card">
                            <div class="card-left">
                                <i class="fa fa-tags" style="float: left; font-size: 30px; color: #2ecc71;"></i>
                                <p>Categories</p>
                            </div>
                            <div class="card-right">
                                <h3><?= htmlspecialchars($total_categories) ?></h3>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Main Content -->
                <div class="col-8">
                    <section id="brand-details" class="brand-details section">
                        <div class="content-image-container">
                            <img src="<?php echo $brand_data['image_1']; ?>" class="content-image" alt="Brand Image">
                        </div>
                        <div class="content-text">
                            <blockquote>
                                <p><?php echo $brand_data['details_2']; ?></p>
                            </blockquote>
                            <p><?php echo $brand_data['details_3']; ?></p>
                            <p><?php echo $brand_data['details_4']; ?></p>

                        </div>
                    </section>
                </div>

                <!-- Fixed Background Section -->
                <div class="col-lg-12 fixed-background-section">
                    <div class="content-overlay">
                        <h7><?php echo $brand_data['details_5']; ?></h7>
                    </div>
                    <h4 class="paddi"> Available SKU under this Brand </h4>

                    <!-- Transparent Table -->
                    <table class="table table-bordered table-transparent">
                        <thead>
                            <tr>
                                <th>Global Code</th>
                                <th>SKU Name</th>
                                <th>Pack Size</th>
                                <th>Category</th>
                                <th>Format</th>
                                <th>Origin</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['global_code']; ?></td>
                                <td><?php echo $product['sku_name']; ?></td>
                                <td><?php echo $product['pack_size']; ?></td>
                                <td><?php echo $product['category_name']; ?></td>
                                <td><?php echo $product['format_name']; ?></td>
                                <td><?php echo $product['origin_name']; ?></td>
                                <td><img src="admin/uploads/products/<?php echo $product['p_image1']; ?>"
                                        alt="Product Image" style="width: 50px; height: 50px;"></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </main>
</body>

<!-- Optional: Add custom CSS for transparency -->
<style>
.table-transparent {
    background-color: rgba(255, 255, 255, 0.8);
    /* Transparent white */
    border: 1px solid #ddd;
    color: #333;
}

.table-transparent th,
.table-transparent td {
    text-align: center;
    padding: 10px;
}

.table-transparent img {
    max-width: 50px;
    max-height: 50px;
}

.paddi {
    padding: 20px;
    text-align: center;
    color: white;
}
</style>

</html>

<?php include('footer.php'); ?>