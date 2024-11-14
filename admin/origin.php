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

// Handle Insert
if (isset($_POST['insert_origin'])) {
    $origin_name = mysqli_real_escape_string($conn, $_POST['origin_name']);

    // Insert origin into database
    $sql = "INSERT INTO country_of_origin (origin_name) VALUES ('$origin_name')";
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
        echo "<script>alert('Error adding Country of Origin');</script>";
    }
}

// Handle Delete
if (isset($_POST['delete_origin'])) {
    $origin_id = $_POST['origin_id'];

    $sql = "DELETE FROM country_of_origin WHERE origin_id = '$origin_id'";
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
        echo "<script>alert('Error deleting Country of Origin');</script>";
    }
}

// Fetch all countries of origin
$sql = "SELECT * FROM country_of_origin";
$result = $conn->query($sql);
?>
<style>
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
</style>

<body>
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Insert Country of Origin Form -->
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Country of Origin</h5>
                    <hr/>
                    <div class="form-body mt-6">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="inputOrigin" class="form-label">Country of Origin Name</label>
                                            <input type="text" class="form-control" name="origin_name" id="inputOrigin" placeholder="Enter Country of Origin" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="insert_origin" class="btn btn-primary">Insert Country of Origin</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Country of Origin Table -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Country of Origin</h5>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>SL No.</th>
                                    <th>Country of Origin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['origin_name']; ?></td>
                                        <td>
                                            <div class="d-flex order-actions justify-content-center">
                                                <a href="update_o.php?origin_id=<?php echo $row['origin_id']; ?>" class="">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="javascript:;" class="ms-3" data-bs-toggle="modal" data-bs-target="#deleteOrigin<?php echo $row['origin_id']; ?>">
                                                    <i class='bx bxs-trash'></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteOrigin<?php echo $row['origin_id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    Are you sure you want to delete this country of origin?
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <form method="POST">
                                                        <input type="hidden" name="origin_id" value="<?php echo $row['origin_id']; ?>">
                                                        <button type="submit" name="delete_origin" class="btn btn-danger">Delete</button>
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

            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Operation completed successfully!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
