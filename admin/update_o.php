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
include('./connection.php');

// Get the origin ID from the URL
if (isset($_GET['origin_id'])) {
    $origin_id = $_GET['origin_id'];

    // Fetch the existing origin data
    $sql = "SELECT * FROM country_of_origin WHERE origin_id = '$origin_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $origin_name = $row['origin_name'];
    } else {
        echo "<script>alert('Country of Origin not found'); window.location.href = 'origin.php';</script>";
        exit();
    }
}

// Handle update
if (isset($_POST['update_origin'])) {
    $origin_name = mysqli_real_escape_string($conn, $_POST['origin_name']);

    $sql = "UPDATE country_of_origin SET origin_name = '$origin_name' WHERE origin_id = '$origin_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            setTimeout(function() {
                successModal.hide();
                window.location.href = 'origin.php';
            }, 1000);
        });
        </script>";
    } else {
        echo "<script>alert('Error updating Country of Origin');</script>";
    }
}
?>

<body>
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Update Country of Origin Form -->
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Update Country of Origin</h5>
                    <hr/>
                    <div class="form-body mt-6">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="inputOrigin" class="form-label">Country of Origin Name</label>
                                            <input type="text" class="form-control" name="origin_name" id="inputOrigin" value="<?php echo $origin_name; ?>" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="update_origin" class="btn btn-primary">Update Country of Origin</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                            Country of Origin updated successfully!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
