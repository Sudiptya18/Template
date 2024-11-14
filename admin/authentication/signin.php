<?php
session_start(); // Start the session at the top of the page

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = $_POST['email_or_username']; // Get the email or username
    $password = $_POST['password'];

    // Check the user in the database using either username or email
    $stmt = $conn->prepare("SELECT id, password FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $email_or_username, $email_or_username); // Bind both username and email to the same value
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $id; // Store user ID or any other user info
            $_SESSION['username'] = $email_or_username; // Store the username or email

            // Redirect to the dashboard or any protected page
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "No user found with that username or email";
    }
    $stmt->close();
}
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../assets/images/logo-2-1.png" type="image/png" />
    <!--plugins-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <title>Artisan Admin-Login</title>
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
    .check:checked {
        background-color: #198754;
        border-color: #198754;
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
                                        <h3 class="">Sign In</h3>
                                        <!-- <p>Don't have an account? <a class="a" href="signup.php">Sign up here</a></p> -->
                                    </div>
                                    <div class="form-body">
                                        <!-- Display error if exists -->
                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php } ?>
                                        
                                        <form class="row g-3" method="POST" action="">
                                            <div class="col-12">
                                                <label for="email_or_username" class="form-label">Username or Email</label>
                                                <input type="text" class="form-control" name="email_or_username" placeholder="Enter Username or Email" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                            </div>
                                            <!-- Forgot Password Link -->
                                            <div class="col-12 text-end">
                                                <a href="forgot_password.php" class="text-muted">Forgot Password?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn bg btn-primary">Sign In</button>
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
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>
