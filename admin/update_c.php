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

// Fetch category data
if (isset($_GET['categories_id'])) {
    $category_id = $_GET['categories_id'];
    $sql = "SELECT * FROM categories WHERE categories_id = '$category_id'";
    $result = $conn->query($sql);
    $category = $result->fetch_assoc();
}

// Handle Update
if (isset($_POST['update_category'])) {
    $category_id = $_POST['categories_id'];
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);

    // Update category name
    $sql = "UPDATE categories SET category_name = '$category_name' WHERE categories_id = '$category_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show success modal
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // After 1 second, hide the modal and redirect to category.php
            setTimeout(function() {
                successModal.hide();
                window.location.href = 'category.php';
            }, 1000);
        });
        </script>";
    } else {
        echo "<script>alert('Error updating category');</script>";
    }
}
?>

<body>
    <div class="wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Update Category</h5>
                        <hr/>
                        <div class="form-body mt-6">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <form method="POST">
                                            <input type="hidden" name="categories_id" value="<?php echo $category['categories_id']; ?>">
                                            <div class="mb-3">
                                                <label for="inputCategoryName" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" name="category_name" value="<?php echo $category['category_name']; ?>" required>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" name="update_category" class="btn btn-primary">Save changes</button>
                                                <a href="category.php" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success Modal for Update -->
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Success</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Category updated successfully!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
