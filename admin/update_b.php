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

if (isset($_GET['brand_id'])) {
    $brand_id = $_GET['brand_id'];

    // Fetch brand data
    $sql = "SELECT * FROM brands WHERE brand_id = '$brand_id'";
    $result = $conn->query($sql);
    $brand = $result->fetch_assoc();
}

// Handle Update
if (isset($_POST['update_brand'])) {
    $brand_id = $_POST['brand_id'];
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $b_image = $_FILES['b_image']['name'];

    if ($b_image != '') {
        // Image uploaded
        $target_dir = "uploads/brands/";
        $target_file = $target_dir . basename($_FILES["b_image"]["name"]);
        move_uploaded_file($_FILES["b_image"]["tmp_name"], $target_file);

        $sql = "UPDATE brands SET brand_name = '$brand_name', b_image = '$target_file' WHERE brand_id = '$brand_id'";
    } else {
        // Only update brand name if no image uploaded
        $sql = "UPDATE brands SET brand_name = '$brand_name' WHERE brand_id = '$brand_id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show success modal
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // After 1 second, hide the modal and redirect to brands.php
            setTimeout(function() {
                successModal.hide();
                window.location.href = 'brands.php';
            }, 1000);
        });
        </script>";
    } else {
        echo "<script>alert('Error updating brand');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Brand</title>
    <link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Update Brand</h5>
                        <hr/>
                        <div class="form-body mt-6">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <form method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="brand_id" value="<?php echo $brand['brand_id']; ?>">
                                            <div class="mb-3">
                                                <label for="inputBrandTitle" class="form-label">Brand Name</label>
                                                <input type="text" class="form-control" name="brand_name" value="<?php echo $brand['brand_name']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="updatebrandimage" class="form-label">Brand Image</label>
                                                <input id="update-brand-image" type="file" name="b_image" accept="image/*">
                                                <!-- Display existing brand image -->
                                                <img src="<?php echo $brand['b_image']; ?>" width="100" height="100" alt="Brand Image">
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" name="update_brand" class="btn btn-primary">Save changes</button>
                                                <a href="brands.php" class="btn btn-secondary">Cancel</a>
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
                                Brand updated successfully!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize imageuploadify plugin
            $('#update-brand-image').imageuploadify();
        });
    </script>
</body>
</html>
