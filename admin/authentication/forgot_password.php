<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists
    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Here you would send the reset link to the user's email
        // Typically, this is a unique token that is stored in the database and sent via email
        header("Location: reset_password.php?email=$email");
    } else {
        $error = "No account found with that email address";
    }
    $stmt->close();
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
	<title>Artisan Admin-Forget Password</title>
</head>
<style>
	.bg{
		background-color: #008000;
		border-color: black;
		
	}
	.bg:hover{
		background-color: #00b33c;
	}
</style>
<body class="bg-forgot">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">
			<div class="card forgot-box">
				<div class="card-body">
					<div class="p-4 rounded  border">
						<div class="text-center">
							<img src="../assets/images/admin_logo.png" width="120" alt="" />
						</div>
						<h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
						<p class="text-muted">Enter your registered email to reset the password</p>
						<form method="POST" action="">
							<label class="form-label">Email</label>
							<input type="email" class="form-control mb-4" name="email" placeholder="example@user.com" required>
							<div class="d-grid gap-2">
								<button type="submit" class="btn bg btn-primary">Send</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>