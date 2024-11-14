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
include('./header.php');
include('./switcher.php');
include('./connection.php');

// Handle Deletion
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM product WHERE product_id = '$product_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            setTimeout(function() {
                successModal.hide();
                window.location.href = 'updateproducts.php';
            }, 1000);
        });
        </script>";
    } else {
        echo "<script>alert('Error deleting product');</script>";
    }
}

// Fetch Products
$sql = "SELECT p.product_id, p.product_title, p.global_code, p.sku_name, p.pack_size, p.description, p.p_image1, p.p_image2,
               b.brand_name, c.category_name, f.format_name, p.active
        FROM product p
        JOIN brands b ON p.brand_id = b.brand_id
        JOIN categories c ON p.categories_id = c.categories_id
        JOIN format f ON p.format_id = f.format_id";
$result = $conn->query($sql);
?>
<html>
<head>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" />
</head>
    <style>
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .dataTables_wrapper .dataTables_filter {
            float: right;
        }
        /* Toggle Switch CSS */
        .switch {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 17px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 13px;
            width: 13px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: 0.4s;
        }

        input:checked + .slider {
            background-color: #4CAF50;
        }

        input:checked + .slider:before {
            transform: translateX(13px);
        }

        .slider.round {
            border-radius: 17px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        .gap{
            padding-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Global Code</th>
                                    <th>SKU Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Format</th>
                                    <th>Product Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['global_code']; ?></td>
                                        <td><?php echo $row['sku_name']; ?></td>
                                        <td><?php echo $row['brand_name']; ?></td>
                                        <td><?php echo $row['category_name']; ?></td>
                                        <td><?php echo $row['format_name']; ?></td>
                                        <td><img src="uploads/products/<?php echo $row['p_image1']; ?>" width="100" height="100"></td>
                                        <td>
                                            <div class="d-flex order-actions justify-content-center">
                                                <a href="update_p.php?product_id=<?php echo $row['product_id']; ?>" class="">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="javascript:;" class="ms-3" data-bs-toggle="modal" data-bs-target="#deleteproducts<?php echo $row['product_id']; ?>">
                                                    <i class='bx bxs-trash'></i>
                                                </a>
                                            </div>
                                            <div class="mt-2 d-flex justify-content-center">
                                                <!-- Toggle Button for Active Status -->
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-active" data-product-id="<?php echo $row['product_id']; ?>" <?php echo $row['active'] ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteproducts<?php echo $row['product_id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    Are you sure you want to delete this product?
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <form method="POST">
                                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                                        <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal for Deletion -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Product deleted successfully!
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search
            });
        });

        // Toggle Button for Active Status
        document.querySelectorAll('.toggle-active').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                const productId = this.getAttribute('data-product-id');
                const isActive = this.checked ? 1 : 0;

                // Send an AJAX request to update the product's active status
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_p.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log('Product active status updated successfully');
                    }
                };
                xhr.send('product_id=' + productId + '&active=' + isActive);
            });
        });
    </script>
</body>
</html>