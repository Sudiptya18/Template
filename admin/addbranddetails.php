<?php
session_start(); // Start the session

// Set session timeout to 30 minutes (optional)
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); // Unset session variables
    session_destroy(); // Destroy session
    header("Location: authentication/signin.php"); // Redirect to login page
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: authentication/signin.php");
    exit();
}

// Include necessary files
include('./header.php');
include('./switcher.php');
include('./connection.php');

// Handle the form submission
if (isset($_POST['add_brand_details'])) {
    $brand_id = mysqli_real_escape_string($conn, $_POST['brand_id']);
    $details_1 = mysqli_real_escape_string($conn, $_POST['details_1']);
    $details_6 = mysqli_real_escape_string($conn, $_POST['details_6']);
    $details_2 = mysqli_real_escape_string($conn, $_POST['details_2']);
    $details_3 = mysqli_real_escape_string($conn, $_POST['details_3']);
    $details_4 = mysqli_real_escape_string($conn, $_POST['details_4']);
    $details_5 = mysqli_real_escape_string($conn, $_POST['details_5']);

    // File upload directory
    $target_dir = "admin/uploads/brands_details/";
    $images = [];
    for ($i = 1; $i <= 5; $i++) {
        $key = "image_$i";
        if (!empty($_FILES[$key]['name'])) {
            $file_name = basename($_FILES[$key]["name"]);
            $target_file = $target_dir . $file_name;
            if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                $images[$i] = $file_name;
            } else {
                echo "<script>alert('Failed to upload image $i');</script>";
                $images[$i] = '';
            }
        } else {
            $images[$i] = '';
        }
    }

    // Insert data into `brand_details` table
    $sql1 = "INSERT INTO brand_details (brand_id, details_1, details_2, details_3, details_4, details_5, details_6) 
             VALUES ('$brand_id', '$details_1', '$details_2', '$details_3', '$details_4', '$details_5', '$details_6')";

    // Insert data into `brand_details_image` table
    $sql2 = "INSERT INTO brand_details_image (brand_id, image_1) 
             VALUES ('$brand_id', '{$images[1]}')";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            setTimeout(function() {
                successModal.hide();
                window.location.href = 'brands.php';
            }, 1000);
        });
        </script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
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
                        <h5 class="card-title">Add Brand Details</h5>
                        <hr />
                        <div class="form-body mt-4">
                            <div style="justify-content: center;" class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="brandName" class="form-label">Brand Name</label>
                                                <select class="form-select" name="brand_id" required>
                                                    <option value="">Select Brand</option>
                                                    <?php
                                                    $brand_query = "SELECT * FROM brands";
                                                    $brand_result = $conn->query($brand_query);
                                                    while ($brand = $brand_result->fetch_assoc()) {
                                                        echo "<option value='" . $brand['brand_id'] . "'>" . $brand['brand_name'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="details1" class="form-label">Brand Details 1
                                                    (Tagline)</label>
                                                <textarea class="form-control" name="details_1" rows="2"
                                                    required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="details6" class="form-label">Brand Details 2 (Under
                                                    Tagline)</label>
                                                <textarea class="form-control" name="details_6" rows="2"
                                                    required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="details2" class="form-label">Brand Details 3 (Under Image
                                                    Blockquote)</label>
                                                <textarea class="form-control" name="details_2" rows="2"
                                                    required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="details3" class="form-label">Brand Details 4 (Information
                                                    1)</label>
                                                <textarea class="form-control" name="details_3" rows="2"
                                                    required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="details4" class="form-label">Brand Details 5 (Information
                                                    2)</label>
                                                <textarea class="form-control" name="details_4" rows="2"
                                                    required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="details5" class="form-label">Brand Details 6 (Above the
                                                    Table)</label>
                                                <textarea class="form-control" name="details_5" rows="2"
                                                    required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="brandImages" class="form-label">Brand Details Images</label>
                                                    <input type="file" class="form-control mb-2" name="image_<?= $i ?>"
                                                        accept="image/*">
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" name="add_brand_details"
                                                    class="btn btn-primary">Save Brand Details</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Success Modal -->
                                <div class="modal fade" id="successModal" tabindex="-1"
                                    aria-labelledby="successModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="successModalLabel">Success</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Brand details added successfully!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image-upload1').imageuploadify();
        });
    </script>
</body>