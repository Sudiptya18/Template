<?php
session_start(); // Start session to track logged-in users

// Set session timeout to 30 minutes
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();     // Unset session variables
    session_destroy();   // Destroy session
    header("Location: signin.php"); // Redirect to login page after session timeout
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: signin.php");
    exit();
}

include '../connection.php'; // Include database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // Ensure passwords match
    if ($password === $re_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Username or Email already exists";
            } else {
                // Insert new user into the database
                $stmt = $conn->prepare("INSERT INTO user (name, email, username, phone, password, designation) VALUES (?, ?, ?, ?, ?, 'Admin')");
                if ($stmt) {
                    $stmt->bind_param("sssss", $name, $email, $username, $mobile, $hashed_password);
                    if ($stmt->execute()) {
                        header("Location: ../index.php"); // Redirect to index after successful registration
                        exit(); // Make sure to exit after header redirect
                    } else {
                        $error = "Registration failed, please try again";
                    }
                } else {
                    $error = "Failed to prepare SQL statement for insertion";
                }
            }
            $stmt->close();
        } else {
            $error = "Failed to prepare SQL statement for selection";
        }
    } else {
        $error = "Passwords do not match";
    }
    $conn->close(); // Close the connection
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/logo-2-1.png" type="image/png" />
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <title>Admin - Sign Up</title>
</head>

<style>
    .a {
        color: #207800;
    }

    .bg {
        background-color: #008000;
        border-color: black;
    }

    .bg:hover {
        background-color: #00b33c;
    }
</style>

<body class="bg-login">
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="../assets/images/admin_logo.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3>Sign Up</h3>
                                        <p>Already have an account? <a class="a" href="signin.php">Sign in here</a></p>
                                    </div>
                                    <div class="form-body">
                                        <!-- Display error message if any -->
                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php } ?>
                                        <form class="row g-3" method="POST" action="">
                                            <div class="col-12">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="mobile" class="form-label">Mobile</label>
                                                <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="re_password" class="form-label">Re-Type Password</label>
                                                <input type="password" class="form-control" name="re_password" placeholder="Re-Type Password" required>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn bg btn-primary">Sign up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
</body>

</html>
