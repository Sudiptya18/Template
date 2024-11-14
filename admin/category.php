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
if (isset($_POST['insert_category'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);

    // Insert category into database
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    if ($conn->query($sql) === TRUE) {
        // echo "<script>alert('Category added successfully');window.location.href='category.php';</script>";
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Show success modal
			var successModal1 = new bootstrap.Modal(document.getElementById('successModal1'));
			successModal1.show();

			After 2 seconds, hide the modal and reload the page
			setTimeout(function() {
			    successModal1.hide();
			    window.location.href = 'category.php';
			}, 2000);
		});
	</script>";
    } else {
        echo "<script>
				alert('Error adding Category');
			</script>";
;
    }
}

// Handle Delete
if (isset($_POST['delete_category'])) {
    $category_id = $_POST['categories_id'];

    // Delete category from database
    $sql = "DELETE FROM categories WHERE categories_id = '$category_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                // Show success modal
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                After 2 seconds, hide the modal and reload the page
                setTimeout(function() {
                    successModal.hide();
                    window.location.href = 'category.php';
                }, 2000);
            });
        </script>";
    } else {
        echo "<script>alert('Error deleting category');</script>";
    }
}


// Fetch all categories
$sql = "SELECT * FROM categories";
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
            <!-- Insert Category Form -->
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Category</h5>
                    <hr/>
                    <div class="form-body mt-6">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="inputcategory" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" name="category_name" id="inputcategory" placeholder="Enter Category Name" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="insert_category" class="btn btn-primary">Insert Category</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>SL No.</th>
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['category_name']; ?></td>
                                        <td>
                                            <div class="d-flex order-actions justify-content-center">
                                                <!-- Edit Button redirects to update.php -->
                                                <a href="update_c.php?categories_id=<?php echo $row['categories_id']; ?>" class="">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <!-- Delete Button triggers the modal -->
                                                <a href="javascript:;" class="ms-3" data-bs-toggle="modal" data-bs-target="#deletecategory<?php echo $row['categories_id']; ?>">
                                                    <i class='bx bxs-trash'></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deletecategory<?php echo $row['categories_id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    Are you sure you want to delete this category?
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <form method="POST">
                                                        <input type="hidden" name="categories_id" value="<?php echo $row['categories_id']; ?>">
                                                        <button type="submit" name="delete_category" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
												Category deleted successfully!
											</div>
										</div>
									</div>
								</div>
								<!-- Success Modal for addition -->
								<div class="modal fade" id="successModal1" tabindex="-1" aria-labelledby="successModalLabel1" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="successModalLabel1">Success</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												Category added successfully!
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

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
