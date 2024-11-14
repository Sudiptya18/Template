<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_GET['email']; // Assuming the email is passed via the GET request
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        if ($stmt->execute()) {
            header("Location: signin.php");
        } else {
            $error = "Password reset failed, please try again";
        }
        $stmt->close();
    } else {
        $error = "Passwords do not match";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../assets/images/logo-2-1.png" type="image/png" />
	<!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<title>Artisan Admin-Reset Password</title>
</head>
<style>
	.bgimg{
		background-image: url('assets/images/login-images/bg-login-img.jpg');
	}
	.bg{
		background-color: #008000;
		border-color: black;
		
	}
	.bg:hover{
		background-color: #00b33c;
	}
</style>

<body>
	<!-- wrapper -->
	<div class="wrapper bgimg">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card">
						<div class="row g-0">
							<div class="col-12 border-end">
								<div class="card-body">
									<div class="p-5">
										<div class="text-start">
											<img src="../assets/images/admin_logo.png" width="180" alt="">
										</div>
										<h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
										<p class="text-muted">We received your reset password request. Please enter your new password!</p>
										<form method="POST" action="">
											<label class="form-label">New Password</label>
											<input type="password" class="form-control mb-2" name="new_password" placeholder="New Password" required>
											<label class="form-label">Confirm New Password</label>
											<input type="password" class="form-control mb-4" name="confirm_password" placeholder="Confirm New Password" required>
											<div class="d-grid gap-2">
												<button type="submit" class="btn bg btn-primary">Change Password</button>
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
	<!-- end wrapper -->
</body>

</html>