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

// Fetch format data
if (isset($_GET['format_id'])) {
    $format_id = $_GET['format_id'];
    $sql = "SELECT * FROM format WHERE format_id = '$format_id'";
    $result = $conn->query($sql);
    $format = $result->fetch_assoc();
}

// Handle Update
if (isset($_POST['update_format'])) {
    $format_id = $_POST['format_id'];
    $format_name = mysqli_real_escape_string($conn, $_POST['format_name']);

    // Update format name
    $sql = "UPDATE format SET format_name = '$format_name' WHERE format_id = '$format_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            setTimeout(function() {
                successModal.hide();
                window.location.href = 'format.php';
            }, 1000);
        });
        </script>";
    } else {
        echo "<script>alert('Error updating format');</script>";
    }
}
?>

<body>
    <div class="wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Update Format</h5>
                        <hr/>
                        <div class="form-body mt-6">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <form method="POST">
                                            <input type="hidden" name="format_id" value="<?php echo $format['format_id']; ?>">
                                            <div class="mb-3">
                                                <label for="inputFormatName" class="form-label">Format Name</label>
                                                <input type="text" class="form-control" name="format_name" value="<?php echo $format['format_name']; ?>" required>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" name="update_format" class="btn btn-primary">Save changes</button>
                                                <a href="format.php" class="btn btn-secondary">Cancel</a>
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
                                Format updated successfully!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
