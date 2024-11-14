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
// Include necessary files
include('./header.php');
include('./switcher.php');
include('./connection.php');

// Handle the form submission when the 'Save Product' button is clicked
if (isset($_POST['add_product'])) {
    // Capture form data and escape special characters
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $sku_name = mysqli_real_escape_string($conn, $_POST['sku_name']);
    $global_code = mysqli_real_escape_string($conn, $_POST['global_code']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $pack_size = mysqli_real_escape_string($conn, $_POST['pack_size']);
    $brand_id = mysqli_real_escape_string($conn, $_POST['brand_id']);
    $categories_id = mysqli_real_escape_string($conn, $_POST['categories_id']);
    $format_id = mysqli_real_escape_string($conn, $_POST['format_id']);
    $origin_id = mysqli_real_escape_string($conn, $_POST['origin_id']);

    // File upload directory
    $target_dir = "uploads/products/";
    $p_image1 = $_FILES['p_image1']['name'];
    $p_image2 = $_FILES['p_image2']['name'];

    // Move uploaded files
    $target_file1 = $target_dir . basename($_FILES["p_image1"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["p_image2"]["name"]);
    
    if (move_uploaded_file($_FILES["p_image1"]["tmp_name"], $target_file1) && move_uploaded_file($_FILES["p_image2"]["tmp_name"], $target_file2)) {
        // Insert data into the database
        $sql = "INSERT INTO product (product_title, sku_name, global_code, description, pack_size, brand_id, categories_id, format_id, origin_id, p_image1, p_image2, active)
                VALUES ('$product_title', '$sku_name', '$global_code', '$description', '$pack_size', '$brand_id', '$categories_id', '$format_id', '$origin_id', '$p_image1', '$p_image2', 1)";

        if ($conn->query($sql) === TRUE) {
            // Display success modal
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                setTimeout(function() {
                    successModal.hide();
                    window.location.href = 'allproducts.php';
                }, 1000);
            });
            </script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload product images');</script>";
    }
}
?>


<head>
    <link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Product</h5>
                    <hr/>
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Product Title</label>
                                            <input type="text" class="form-control" name="product_title" placeholder="Enter Product Title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputSKUTitle" class="form-label">SKU Name</label>
                                            <input type="text" class="form-control" name="sku_name" placeholder="Enter SKU Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputGlobalCode" class="form-label">Global Code</label>
                                            <input type="number" class="form-control" name="global_code" placeholder="Enter Global Code" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductImage1" class="form-label">Product Image 1</label>
                                            <input id="image-upload1" type="file" name="p_image1" accept="image/*" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductImage2" class="form-label">Product Image 2</label>
                                            <input id="image-upload2" type="file" name="p_image2" accept="image/*">
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputPacksize" class="form-label">Pack Size</label>
                                            <input type="text" class="form-control" name="pack_size" placeholder="Pack Size" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputBrand" class="form-label">Brand</label>
                                            <select class="form-select" name="brand_id" required>
                                                <option value="">Select Brand</option>
                                                <?php
                                                $brand_query = "SELECT * FROM brands";
                                                $brand_result = $conn->query($brand_query);
                                                while($brand = $brand_result->fetch_assoc()) {
                                                    echo "<option value='".$brand['brand_id']."'>".$brand['brand_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCategory" class="form-label">Category</label>
                                            <select class="form-select" name="categories_id" required>
                                                <option value="">Select Category</option>
                                                <?php
                                                $category_query = "SELECT * FROM categories";
                                                $category_result = $conn->query($category_query);
                                                while($category = $category_result->fetch_assoc()) {
                                                    echo "<option value='".$category['categories_id']."'>".$category['category_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputFormat" class="form-label">Format</label>
                                            <select class="form-select" name="format_id" required>
                                                <option value="">Select Format</option>
                                                <?php
                                                $format_query = "SELECT * FROM format";
                                                $format_result = $conn->query($format_query);
                                                while($format = $format_result->fetch_assoc()) {
                                                    echo "<option value='".$format['format_id']."'>".$format['format_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCOO" class="form-label">Country of Origin</label>
                                            <select class="form-select" name="origin_id" required>
                                                <option value="">Select Country</option>
                                                <?php
                                                $origin_query = "SELECT * FROM country_of_origin";
                                                $origin_result = $conn->query($origin_query);
                                                while($origin = $origin_result->fetch_assoc()) {
                                                    echo "<option value='".$origin['origin_id']."'>".$origin['origin_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="add_product" class="btn btn-primary">Save Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Success Modal -->
                            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Product added successfully!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
<script>
    $(document).ready(function () {
        $('#image-upload1').imageuploadify();
        $('#image-upload2').imageuploadify();
    });
</script>
</body>
