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

$modalTitle = "";
$modalBody = "";
$modalSuccess = false;

// Clear the session if the page is loaded fresh (this prevents modal on back navigation)
if (!isset($_SESSION['brand_added'])) {
    $_SESSION['brand_added'] = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    
    // File upload setup
    $target_dir = "uploads/brands/";
    $target_file = $target_dir . basename($_FILES["brand_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a real image
    $check = getimagesize($_FILES["brand_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $modalBody = "File is not an image.";
        $uploadOk = 0;
    }

    // // Check if file already exists
    // if (file_exists($target_file)) {
    //     $modalBody = "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size (e.g., 5MB max)
    if ($_FILES["brand_image"]["size"] > 5000000) {
        $modalBody = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $modalBody = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Try to upload if everything is okay
    if ($uploadOk == 0) {
        $modalTitle = "Failed!";
    } else {
        if (move_uploaded_file($_FILES["brand_image"]["tmp_name"], $target_file)) {
            // Insert the brand into the database
            $sql = "INSERT INTO brands (Brand_Name, B_Image) VALUES ('$brand_name', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                $modalTitle = "Success!";
                $modalBody = "New brand added successfully.";
                $modalSuccess = true;

                // Set session to indicate brand was added
                $_SESSION['brand_added'] = true;

                // Redirect to brands.php after a short delay
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'brands.php';
                    }, 2000); // Redirect after 2 seconds
                </script>";
            } else {
                $modalTitle = "Failed!";
                $modalBody = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $modalTitle = "Failed!";
            $modalBody = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<head>
    <link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Add New Brand</h5>
                        <hr/>
                        <div class="form-body mt-6">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="inputProductTitle" class="form-label">Brand Name</label>
                                                <input type="text" class="form-control" id="inputProductTitle" name="brand_name" placeholder="Enter Brand Name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputBrandImage" class="form-label">Brand Image</label>
                                                <input id="brand-image-upload" type="file" name="brand_image" accept="image/*" required>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Save Brand</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $modalTitle ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $modalBody ?>
                </div>
                <!-- <div class="modal-footer">
                    <?php if ($modalSuccess): ?>
                        <a href="brands.php" class="btn btn-primary">Okay</a>
                    <?php else: ?>
                        <button type="button" class="btn btn-secondary" onclick="location.reload()">Try Again</button>
                    <?php endif; ?>
                </div> -->
            </div>
        </div>
    </div>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#brand-image-upload').imageuploadify();

            // Show modal after form submission only if it's a POST request
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                var resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
                resultModal.show();
            <?php endif; ?>
        });
    </script>

    <?php 
    // Clear the session after showing the modal
    if ($_SESSION['brand_added']) {
        $_SESSION['brand_added'] = false;
    }
    ?>
</body>
