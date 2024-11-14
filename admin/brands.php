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
if (isset($_POST['delete_brand'])) {
    $brands_id = $_POST['brands_id'];
    $sql = "DELETE FROM brands WHERE brand_id = '$brands_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                // Show success modal
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                // After 2 seconds, hide the modal and reload the page
                setTimeout(function() {
                    successModal.hide();
                    window.location.href = 'brands.php';
                }, 1000);
            });
        </script>";
    } else {
        echo "<script>
                alert('Error deleting brand');
            </script>";
    }
}

// Fetch all brands
$sql = "SELECT * FROM brands";
$result = $conn->query($sql);
?>

<style>
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
</style>

<head>
    <link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
</head>
<body>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Brand Name</th>
                                    <th>Brand Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['brand_name']; ?></td>
                                        <td><img src="<?php echo $row['b_image']; ?>" width="100" height="100"></td>
                                        <td>
                                            <div class="d-flex order-actions justify-content-center">
                                                <!-- Edit Button redirects to update.php -->
                                                <a href="update_b.php?brand_id=<?php echo $row['brand_id']; ?>" class="">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <!-- Delete Button triggers the modal -->
                                                <a href="javascript:;" class="ms-3" data-bs-toggle="modal" data-bs-target="#deletebrands<?php echo $row['brand_id']; ?>">
                                                    <i class='bx bxs-trash'></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deletebrands<?php echo $row['brand_id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    Are you sure you want to delete this Brand?
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <form method="POST">
                                                        <input type="hidden" name="brands_id" value="<?php echo $row['brand_id']; ?>">
                                                        <button type="submit" name="delete_brand" class="btn btn-danger">Delete</button>
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
                    Brand deleted successfully!
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#update-brand-image').imageuploadify();
        });
    </script>
</body>
