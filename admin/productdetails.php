<?php
session_start(); // Start the session

// Set session timeout to 30 minutes (optional)
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Last activity was over 30 minutes ago
    session_unset();     // Unset session variables
    session_destroy();   // Destroy session
    header("Location: authentication/signin.php"); // Redirect to login page after session timeout
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: authentication/signin.php");
    exit();
}
// Include header, switcher, and database connection
include('./header.php');
include('./switcher.php');
include('./connection.php');

// Fetch the product ID from the URL
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 0;

// Fetch product details from the database, joining the relevant tables
$sql = "SELECT p.product_id, p.product_title, p.sku_name, p.global_code, p.pack_size, p.description, p.benefits, p.p_image1, p.p_image2, 
               b.brand_name, b.b_image AS brand_logo, 
               c.category_name, 
               f.format_name, 
               o.origin_name 
        FROM product p
        LEFT JOIN brands b ON p.brand_id = b.brand_id
        LEFT JOIN categories c ON p.categories_id = c.categories_id
        LEFT JOIN format f ON p.format_id = f.format_id
        LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
        WHERE p.product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit;
}
?>

<style>
    .row {
        padding: 1rem 1rem;
    }
    .img-container {
        position: relative;
        overflow: hidden;
    }
    .img-container img {
        max-width: 100%;
        transition: transform 0.3s ease;
    }
    .img-container:hover img {
        transform: scale(1.2);
    }
    .thumbnail img {
        cursor: pointer;
    }
    .brand-logo img {
        width: 150px;
        height: 150px;
    }
</style>

<body>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="row g-0">
                    <!-- Left Column: Main Product Image and Thumbnails -->
                    <div class="col-md-4 border-end">
                        <div class="img-container">
                            <img id="mainImage" src="uploads/products/<?php echo $product['p_image1']; ?>" class="img-fluid" alt="<?php echo $product['product_title']; ?>">
                        </div>
                        <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3 thumbnail">
                            <div class="col">
                                <img onclick="changeImage('uploads/products/<?php echo $product['p_image1']; ?>')" src="uploads/products/<?php echo $product['p_image1']; ?>" width="70" class="border rounded" alt="">
                            </div>
                            <div class="col">
                                <img onclick="changeImage('uploads/products/<?php echo $product['p_image2']; ?>')" src="uploads/products/<?php echo $product['p_image2']; ?>" width="70" class="border rounded" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Right Column: Product Details -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $product['product_title']; ?></h4>
                            <hr>
                            <div class="row">
                                <!-- Product Information -->
                                <div class="col-md-9">
                                    <dl class="row">
                                        <dt class="col-sm-6">SKU Name</dt>
                                        <dd class="col-sm-6"><?php echo $product['sku_name']; ?></dd>
                                        <dt class="col-sm-6">Global Code</dt>
                                        <dd class="col-sm-6"><?php echo $product['global_code']; ?></dd>
                                        <dt class="col-sm-6">Pack Size</dt>
                                        <dd class="col-sm-6"><?php echo $product['pack_size']; ?></dd>
                                        <dt class="col-sm-6">Brand</dt>
                                        <dd class="col-sm-6"><?php echo $product['brand_name']; ?></dd>
                                        <dt class="col-sm-6">Category</dt>
                                        <dd class="col-sm-6"><?php echo $product['category_name']; ?></dd>
                                        <dt class="col-sm-6">Format</dt>
                                        <dd class="col-sm-6"><?php echo $product['format_name']; ?></dd>
                                        <dt class="col-sm-6">Country of Origin</dt>
                                        <dd class="col-sm-6"><?php echo $product['origin_name']; ?></dd>
                                    </dl>
                                </div>
                                <!-- Brand Logo -->
                                <div class="col-md-3 brand-logo">
                                <img src="<?php echo $product['brand_logo']; ?>" alt="Brand Logo">
                                </div>
                            </div>
                            <hr>
                            <!-- Product Description -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5>Product Description </h5>
                                        <p><?php echo $product['description']; ?></p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5>Product Benefits </h5>
                                        <p><?php echo $product['benefits']; ?></p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Change Image on Click -->
    <script>
        function changeImage(imageSrc) {
            document.getElementById('mainImage').src = imageSrc;
        }
    </script>
</body>
</html>
