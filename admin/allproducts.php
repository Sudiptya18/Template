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
?>
<html>
<style>
        /* Product Card Hover Effect */
        .product-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }

        /* Remove underline from card link */
        .card-link {
            text-decoration: none;
            color: inherit;
        }

        /* Pagination Styles */
        .pagination-wrapper {
            margin-top: 20px;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination .page-link {
            color: #007bff;
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
        }

        .pagination {
            margin-top: 10px;
        }
    </style>

<body>
    <div class="wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="card">
                    <!-- Add New Product Button and Search Bar -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-3 col-xl-2">
                                            <a href="addproducts.php" class="btn btn-primary mb-3 mb-lg-0">
                                                <i class='bx bxs-plus-square'></i> New Product
                                            </a>
                                        </div>
                                        <div class="col-lg-9 col-xl-10">
                                            <form class="float-lg-end">
                                                <div class="row row-cols-lg-auto g-2">
                                                    <div class="col-12">
                                                        <div class="position-relative">
                                                            <input type="text" id="productSearch" class="form-control ps-5" placeholder="Search Product..."> 
                                                            <span class="position-absolute top-50 product-show translate-middle-y">
                                                                <i class="bx bx-search"></i>
                                                            </span>
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

                    <!-- Product Grid -->
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid" id="productGrid">
                        <?php
                        // Fetch all products from the database
                        $sql = "SELECT product_id, product_title, global_code, p_image1 FROM product";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Loop through all products and display them in the grid
                            while ($row = $result->fetch_assoc()) {
                                $product_id = $row['product_id'];
                                $product_title = $row['product_title'];
                                $global_code = $row['global_code'];
                                $product_image = $row['p_image1'] ? 'uploads/products/' . $row['p_image1'] : 'assets/images/no_image_available.png'; // Show a default image if no image is found
                                ?>
                                <div class="col product-item">
                                    <div class="card product-card">
                                        <a href="productdetails.php?product_id=<?php echo $product_id; ?>" class="card-link">
                                            <img src="<?php echo $product_image; ?>" class="card-img-top" alt="<?php echo $product_title; ?>" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo $global_code; ?></h6>
                                                <h6 class="card-title"><?php echo $product_title; ?></h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p>No products found.</p>";
                        }
                        ?>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="pagination-wrapper">
                        <ul id="pagination" class="pagination justify-content-center"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function () {
            // Search functionality for products
            $('#productSearch').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('#productGrid .col').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>
