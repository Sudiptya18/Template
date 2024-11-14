<?php
session_start(); // Start the session

// Set session timeout to 30 minutes
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();     // Unset session variables
    session_destroy();   // Destroy session
    header("Location: authentication/signin.php"); // Redirect to login page after session timeout
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: authentication/signin.php");
    exit();
}

include('./connection.php'); // Database connection

// Fetch user data from the database
$user_id = $_SESSION['user_id']; // Assuming the session contains the user_id

// Prepare the SQL query without 'address'
$sql = "SELECT id, name, email, phone, designation FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);

// Check if statement preparation was successful
if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id); // Bind the user_id parameter
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc(); // Fetch user data

if (!$user) {
    // Handle the case where user data is not found
    echo "User not found.";
    exit();
}

include('./header.php');
include('./switcher.php');
?>
<!doctype html>
<html lang="en">

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <!-- Left-side div showing name, designation, and phone -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="assets/images/avatars/user.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                            <div class="mt-3">
                                                <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                                                <p class="text-secondary mb-1"><?php echo htmlspecialchars($user['designation']); ?></p>
                                                <p class="text-muted font-size-sm"><?php echo htmlspecialchars($user['phone']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Right-side div for editing user info (except password) -->
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="update_profile.php">
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Full Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Phone</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
        <!--end page wrapper -->
    </div>
    <!--end wrapper-->
</body>

</html>

<?php
?>
