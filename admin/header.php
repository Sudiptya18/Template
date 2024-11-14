<?php

// Ensure the user is logged in before displaying the header
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: signin.php");
    exit();
}
include('./connection.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch user data from database
$username = $_SESSION['username'];
$sql = "SELECT name, designation FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($name, $designation);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/logo-2-1.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
	<!-- jQuery (necessary for DataTables) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<title>Artisan: Admin Panel</title>
</head>
<!--start header -->
<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item mobile-search-icon">
						<a class="nav-link" href="#">	<i class='bx bx-search'></i>
						</a>
					</li>
					<li class="nav-item dropdown dropdown-large">
						<div class="dropdown-menu dropdown-menu-end">

							<div class="header-notifications-list">
							</div>
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large">
						<div class="dropdown-menu dropdown-menu-end">
							<div class="header-message-list">
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="user-box dropdown">	
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<!-- Dynamically fetch user image (optional) and name from session -->
					<img src="assets/images/avatars/user.png" class="user-img" alt="user avatar">
					<div class="user-info ps-3">
						<!-- Display the logged-in user's name -->
						<p class="user-name mb-0"><?php echo htmlspecialchars($name); ?></p>
						<!-- Display the logged-in user's designation -->
						<p class="designation mb-0"><?php echo htmlspecialchars($designation ? $designation : 'Administrator'); ?></p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="user_profile.php"><i class='bx bx-user'></i><span>Profile</span></a></li>
					<li><a class="dropdown-item" href="authentication/signup.php"><i class='bx bx-user-plus'></i><span>Add new user</span></a></li>
					<li><a class="dropdown-item" href="authentication/logout.php"><i class='bx bx-log-out'></i><span>Logout</span></a></li>
				</ul>
			</div>
		</nav>
	</div>
</header>
<!--end header -->
<body>
    	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="assets/images/logo-2-1.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Artisan</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="index.php">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="allproducts.php">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">All Products</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Products</div>
					</a>
					<ul>
						<li> <a href="addproducts.php"><i class="bx bx-right-arrow-alt"></i>Add New Products</a>
						</li>
						<li> <a href="updateproducts.php"><i class="bx bx-right-arrow-alt"></i>Update Products</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Brands</div>
					</a>
					<ul>
						<li> <a href="brands.php"><i class="bx bx-right-arrow-alt"></i> View Brands</a>
						</li>
						<li> <a href="addbrands.php"><i class="bx bx-right-arrow-alt"></i>Add New Brand</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Other Content</div>
					</a>
					<ul>
						<li> <a href="category.php"><i class="bx bx-right-arrow-alt"></i>Category</a>
						</li>
						<li> <a href="format.php"><i class="bx bx-right-arrow-alt"></i>Format</a>
						</li>
						<li> <a href="origin.php"><i class="bx bx-right-arrow-alt"></i>Country of Origin</a>
						</li>
					</ul>
				</li>

			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->

        <!-- Bootstrap JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="assets/plugins/chartjs/js/Chart.min.js"></script>
        <script src="assets/plugins/chartjs/js/Chart.extension.js"></script>
        <script src="assets/js/index.js"></script>
        <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <!--app JS-->
        <script src="assets/js/app.js"></script>
	

</body>