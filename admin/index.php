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
 include ('./connection.php');

 // Total products
 $product_query = "SELECT COUNT(*) as total_products FROM product";
 $product_result = $conn->query($product_query);
 $total_products = $product_result->fetch_assoc()['total_products'];

 // Total brands
 $brands_query = "SELECT COUNT(*) as total_brands FROM brands";
 $brands_result = $conn->query($brands_query);
 $total_brands = $brands_result->fetch_assoc()['total_brands'];

 // Highest products brand-wise
 $highest_brand_query = "
     SELECT b.brand_name, COUNT(p.product_id) as product_count
     FROM product p
     JOIN brands b ON p.brand_id = b.brand_id
     GROUP BY b.brand_name
     ORDER BY product_count DESC
     LIMIT 1
 ";
 $highest_brand_result = $conn->query($highest_brand_query);
 $highest_brand = $highest_brand_result->fetch_assoc();
 $highest_brand_name = $highest_brand['brand_name'];
 $highest_product_count = $highest_brand['product_count'];

 // Fetch brand names and SKU counts for chart
 $brand_sku_query = "
     SELECT b.brand_name, COUNT(p.product_id) AS sku_count
     FROM brands b
     LEFT JOIN product p ON b.brand_id = p.brand_id
     GROUP BY b.brand_name
 ";
 $brand_sku_result = $conn->query($brand_sku_query);

 $brands = [];
 $sku_counts = [];

 if ($brand_sku_result->num_rows > 0) {
     while ($row = $brand_sku_result->fetch_assoc()) {
         $brands[] = $row['brand_name'];
         $sku_counts[] = $row['sku_count'];
     }
 }

// Fetching top importing countries SKU-wise
$importing_country_query = "
    SELECT o.origin_name, COUNT(p.product_id) as sku_count
    FROM product p
    JOIN country_of_origin o ON p.origin_id = o.origin_id
    GROUP BY o.origin_name
    ORDER BY sku_count DESC
";
$importing_country_result = $conn->query($importing_country_query);

$countries = [];
$country_sku_counts = [];

if ($importing_country_result->num_rows > 0) {
    while ($row = $importing_country_result->fetch_assoc()) {
        $countries[] = $row['origin_name'];  // Fetching the country name from 'origin_name' column
        $country_sku_counts[] = $row['sku_count'];  // SKU count per country
    }
}

// Count the total active products
$sql = "SELECT COUNT(*) as total_active_products FROM product WHERE active = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_active_products = $row['total_active_products'];

// Count the total categories
$sql = "SELECT COUNT(*) AS total_categories FROM `categories`";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_categories = $row['total_categories'];

// Count the total format
$sql = "SELECT COUNT(*) AS total_format FROM `format`";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_format = $row['total_format'];

// The total number of users from the user table
$sql = "SELECT COUNT(*) AS total_users FROM user";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'];
} else {
    $total_users = 0; // In case of an error, set to 0
}



?>

<!DOCTYPE html>
<html lang="en">

<style>
	.card-widget{
		height: 100px;
		max-height: 100px;
	}
    .bg-gradient-a {
        background-color: #85FFBD;
        background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);
    }
    .bg-gradient-b{
    background-color: #A9C9FF;
    background-image: linear-gradient(180deg, #A9C9FF 0%, #FFBBEC 100%);
    }
    .bx--git-pull-request {
            display: inline-block;
            width: 1em;
            height: 1em;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M19.01 15.163V7.997C19.005 6.391 17.933 4 15 4V2l-4 3l4 3V6c1.829 0 2.001 1.539 2.01 2v7.163c-1.44.434-2.5 1.757-2.5 3.337c0 1.93 1.57 3.5 3.5 3.5s3.5-1.57 3.5-3.5c0-1.58-1.06-2.903-2.5-3.337m-1 4.837c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5s1.5.673 1.5 1.5s-.673 1.5-1.5 1.5M9.5 5.5C9.5 3.57 7.93 2 6 2S2.5 3.57 2.5 5.5c0 1.58 1.06 2.903 2.5 3.337v6.326c-1.44.434-2.5 1.757-2.5 3.337C2.5 20.43 4.07 22 6 22s3.5-1.57 3.5-3.5c0-1.58-1.06-2.903-2.5-3.337V8.837C8.44 8.403 9.5 7.08 9.5 5.5m-5 0C4.5 4.673 5.173 4 6 4s1.5.673 1.5 1.5S6.827 7 6 7s-1.5-.673-1.5-1.5m3 13c0 .827-.673 1.5-1.5 1.5s-1.5-.673-1.5-1.5S5.173 17 6 17s1.5.673 1.5 1.5'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
    }
</style>
<body>
	<!--start page wrapper -->
	<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <!-- Total Products -->
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info card-widget">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Products</p>
								<br>
                                <h4 class="my-1 text-info"><?php echo $total_products; ?></h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <i class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Total Brands -->
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger card-widget">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Brands</p>
								<br>
                                <h4 class="my-1 text-danger"><?php echo $total_brands; ?></h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                <i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Highest Products Brand-wise -->
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success card-widget">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Top Brand (SKU Wise): <?php echo $highest_brand_name; ?></p>
                                <br>
                                <h4 class="my-1 text-success"><?php echo $highest_product_count; ?></h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Users -->
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning card-widget">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Users</p>
                                <br>
                                <h4 class="my-1 text-warning"><?php echo $total_users; ?></h4> <!-- Display total user count here -->
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Active Products -->
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success card-widget">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Active Products</p>
                                <br>
                                <h4 class="my-1 text-success"><?php echo $total_active_products; ?></h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-check-circle'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total categories -->
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success card-widget">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                             <div>
                                    <p class="mb-0 text-secondary">Total Categories</p>
                                    <br>
                                    <h4 class="my-1 text-success"><?php echo $total_categories; ?></h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-a text-white ms-auto">
                                <i class='bx bx-bulb font-30'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Format -->
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success card-widget">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Format</p>
                                <br>
                                <h4 class="my-1 text-success"><?php echo $total_format; ?></h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-b text-white ms-auto">
                                <i class='bx bx--git-pull-request'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
			
        <div class="row">
            <!-- Brand Wise SKU Chart -->
            <div class="col-md-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Brand Wise SKU</h6>
                            </div>
                        </div>
                        <div class="chart-container-0">
                            <canvas id="chart-order-status"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Importing Country SKU Wise -->
            <div class="col-md-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Top Importing Country SKU Wise</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-0">
                            <canvas id="chart-country-sku"></canvas> <!-- This canvas is where the chart will be drawn -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

	<!--Footer-->
	<?php include('./footer.php'); ?>

    <!-- Chart Script for Brand Wise SKU -->
    <script>
        const brandNames = <?php echo json_encode($brands); ?>;
        const skuCounts = <?php echo json_encode($sku_counts); ?>;

        const ctx1 = document.getElementById('chart-order-status').getContext('2d');
        const myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: brandNames,
                datasets: [{
                    label: 'No. of SKUs',
                    data: skuCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'x', // Horizontal bar chart
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
    <!-- Chart Script for Top Importing Country SKU Wise -->
    <script>
        // Country names (for the x-axis)
        const countryNames = <?php echo json_encode($countries); ?>;
        // SKU counts per country (for the y-axis)
        const countrySkuCounts = <?php echo json_encode($country_sku_counts); ?>;

        // Get the context of the canvas where the chart will be drawn
        const ctx2 = document.getElementById('chart-country-sku').getContext('2d');

        // Create a new chart instance
        const myChart2 = new Chart(ctx2, {
            type: 'bar', // Bar chart
            data: {
                labels: countryNames, // X-axis: Country names
                datasets: [{
                    label: 'No. of SKUs', // Y-axis label
                    data: countrySkuCounts, // Y-axis: SKU counts
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Bar color
                    borderColor: 'rgba(75, 192, 192, 1)', // Bar border color
                    borderWidth: 1 // Border width of the bars
                }]
            },
            options: {
                scales: {
                    x: { // X-axis configuration
                        beginAtZero: true, // Start x-axis at 0
                        title: {
                            display: true,
                            //text: 'Country Name' // Title for the x-axis
                        }
                    },
                    y: { // Y-axis configuration
                        beginAtZero: true, // Start y-axis at 0
                        title: {
                            display: true,
                            //text: 'Number of SKUs' // Title for the y-axis
                        }
                    }
                }
            }
        });
</script>

</body>
</html>