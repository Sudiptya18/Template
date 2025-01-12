<?php
$body_class = 'products-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';

// Fetch brands, categories, country_of_origin, and format
$brands_query = "SELECT brand_id, brand_name, b_image FROM brands";
$brands_result = mysqli_query($conn, $brands_query);

$categories_query = "SELECT categories_id, category_name FROM categories";
$categories_result = mysqli_query($conn, $categories_query);

$origin_query = "SELECT origin_id, origin_name FROM country_of_origin";
$origin_result = mysqli_query($conn, $origin_query);

$format_query = "SELECT format_id, format_name FROM format";
$format_result = mysqli_query($conn, $format_query);

// Fetch products
$products_count = "SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.description, p.pack_size, 
                           p.brand_id, p.categories_id, p.format_id, p.origin_id, p.p_image1, p.p_image2, p.active,
                           b.brand_name, c.category_name, o.origin_name, f.format_name 
                    FROM product p
                    LEFT JOIN brands b ON p.brand_id = b.brand_id
                    LEFT JOIN categories c ON p.categories_id = c.categories_id
                    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
                    LEFT JOIN format f ON p.format_id = f.format_id
                    ORDER BY p.product_title";

$products_query = "SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.description, p.pack_size, 
                           p.brand_id, p.categories_id, p.format_id, p.origin_id, p.p_image1, p.p_image2, p.active,
                           b.brand_name, c.category_name, o.origin_name, f.format_name 
                    FROM product p
                    LEFT JOIN brands b ON p.brand_id = b.brand_id
                    LEFT JOIN categories c ON p.categories_id = c.categories_id
                    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
                    LEFT JOIN format f ON p.format_id = f.format_id
                    ORDER BY p.product_title limit 0,10";
$products_query2 = "SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.description, p.pack_size, 
                    p.brand_id, p.categories_id, p.format_id, p.origin_id, p.p_image1, p.p_image2, p.active,
                    b.brand_name, c.category_name, o.origin_name, f.format_name 
             FROM product p
             LEFT JOIN brands b ON p.brand_id = b.brand_id
             LEFT JOIN categories c ON p.categories_id = c.categories_id
             LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
             LEFT JOIN format f ON p.format_id = f.format_id limit 0,10";
$products_result = mysqli_query($conn, $products_query);
$products_counts = mysqli_query($conn, $products_count);
$products_result2 = mysqli_query($conn, $products_query2);
?>

<head>
    <link href="assets/css/0._YIa9mqy.css" rel="stylesheet">
    <link href="assets/css/Preloader.BHFBcupA.css" rel="stylesheet">
</head>

<body data-sveltekit-preload-data="hover" data-new-gr-c-s-check-loaded="14.1209.0" data-gr-ext-installed=""
    style="overflow: visible">
    <div style="display: contents">
        <div class="main-page-wrapper">
            <section class="job-listing-three pt-30 lg-pt-30 pb-30 xl-pb-30 lg-pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <button type="button"
                                class="filter-btn w-100 pt-2 pb-2 h-auto fw-500 tran3s d-lg-none mb-40"
                                data-bs-toggle="offcanvas" data-bs-target="#filteroffcanvas">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <div class="filter-area-tab offcanvas offcanvas-start" id="filteroffcanvas">
                                <button type="button" class="btn-close text-reset d-lg-none" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                                <div class="main-title fw-500 text-dark">Filter By</div>
                                <div class="light-bg border-20 ps-4 pe-4 pt-25 pb-30 mt-20">
                                    <!-- Country of Origin Filter -->
                                    <div class="filter-block bottom-line pb-25">
                                        <a class="filter-title fw-500 text-dark" data-bs-toggle="collapse"
                                            href="#collapseLocation" role="button" aria-expanded="false">
                                            Country of Origin
                                        </a>
                                        <div class="collapse show" id="collapseLocation">
                                            <div class="main-body">
                                                <select class="nice-select bg-white origin-dropdown product_check">
                                                    <option value="0">All</option>
                                                    <?php
                                                    if (mysqli_num_rows($origin_result) > 0) {
                                                        while ($origin = mysqli_fetch_assoc($origin_result)) { ?>
                                                    <option value="<?php echo $origin['origin_id']; ?>">
                                                        <?php echo $origin['origin_name']; ?>
                                                    </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Brand Filter -->
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark" data-bs-toggle="collapse"
                                            href="#collapseJobType" role="button" aria-expanded="false">Brands</a>
                                        <div class="collapse show" id="collapseJobType">
                                            <div class="main-body">
                                                <ul class="style-none filter-input" id="brand">
                                                    <?php while ($brand = mysqli_fetch_assoc($brands_result)) { ?>
                                                    <li>
                                                        <input class="product_check brand" type="checkbox"
                                                            name="brand[]" value="<?php echo $brand['brand_id']; ?>" />
                                                        <label for=""><?php echo $brand['brand_name']; ?></label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Category Filter -->
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark" data-bs-toggle="collapse"
                                            href="#collapseExp" role="button" aria-expanded="false">Categories</a>
                                        <div class="collapse show" id="collapseExp">
                                            <div class="main-body">
                                                <ul class="style-none filter-input" id="category">
                                                    <?php while ($category = mysqli_fetch_assoc($categories_result)) { ?>
                                                    <li>
                                                        <input class="product_check category" type="checkbox"
                                                            name="category[]"
                                                            value="<?php echo $category['categories_id']; ?>" />
                                                        <label for=""><?php echo $category['category_name']; ?></label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Format Filter -->
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark collapsed" data-bs-toggle="collapse"
                                            href="#collapseCategory" role="button" aria-expanded="false">Format</a>
                                        <div class="collapse show" id="collapseCategory">
                                            <div class="main-body">
                                                <ul class="style-none filter-input" id="format">
                                                    <?php while ($format = mysqli_fetch_assoc($format_result)) { ?>
                                                    <li>
                                                        <input class="product_check" type="checkbox" name="format[]"
                                                            value="<?php echo $format['format_id']; ?>" />
                                                        <label for=""><?php echo $format['format_name']; ?></label>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                                <!-- <div class="more-btn">
                                                    <i class="bi bi-plus"></i> Show More
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <a href="" class="btn-ten fw-500 text-white w-100 text-center tran3s mt-30">Apply
                                        Filter</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8">
                            <div class="job-post-item-wrapper ms-xxl-5 ms-xl-3">
                                <div class="upper-filter d-flex justify-content-between align-items-center mb-20">
                                    <div class="total-job-found">
                                        Total <span
                                            class="text-dark prod_count"><?php echo mysqli_num_rows($products_counts); ?></span>
                                        Products found
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="style-changer-btn text-center rounded-circle tran3s ms-2 list-btn active"
                                            title="Active List">
                                            <i class="bi bi-list"></i>
                                        </button>
                                        <button
                                            class="style-changer-btn text-center rounded-circle tran3s ms-2 grid-btn active"
                                            title="Active Grid">
                                            <i class="bi bi-grid"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="accordion-box list-style show" id="list-btn">
                                    <?php while ($product = mysqli_fetch_assoc($products_result)) { ?>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="product-details.php?id=<?php echo $product['product_id']; ?>"
                                                        class="logo"><img
                                                            src="admin/uploads/products/<?php echo $product['p_image1']; ?>"
                                                            alt="<?php echo $product['brand_name']; ?>"
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="brand-details.php?brand_id=<?php echo $brand['brand_id']; ?>"
                                                            class="job-duration fw-500"><?php echo $product['brand_name']; ?></a>
                                                        <a href="product-details.php?id=<?php echo $product['product_id']; ?>"
                                                            class="title fw-500 tran3s"><?php echo $product['product_title']; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <p><?php echo $product['origin_name']; ?></p>
                                                </div>
                                                <div class="job-salary">
                                                    <span
                                                        class="fw-500 text-dark"><?php echo $product['category_name']; ?></span>
                                                    <br> <?php echo $product['format_name']; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6" style="display:flex; flex-direction: column; align-items: center; justify-content: center;">
                                                <div class="job-btn">
                                                    <a href="product-details.php?id=$product['product_id'];"
                                                        class="btn-one tran3s">View Details</a>
                                                </div>
                                                <div class="job-btn" style="padding-top: 5%;">
                                                    <a href="pdfgenerate.php?id=<?php echo $product['product_id']; ?>" target="_blank"
                                                        class="btn-one tran3s"> Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="accordion-box grid-style" id="grid-btn">
                                    <div class="row">
                                        <?php
                                        // Fetch the products and their related details
                                        while ($product = mysqli_fetch_assoc($products_result2)) {
                                            // Fetch associated data
                                            $brand_name = $product['brand_name'];
                                            $product_title = $product['product_title'];
                                            $pack_size = $product['pack_size'];
                                            $origin_name = $product['origin_name'];
                                            $category_name = $product['category_name'];
                                            $format_name = $product['format_name'];
                                            $p_image1 = $product['p_image1']; // Image 1 for the product
                                        ?>
                                        <div class="col-sm-4 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <!-- Product Image -->
                                                <a href="product-details.php?id=<?php echo $product['product_id']; ?>"
                                                    class="logo">
                                                    <img src="admin/uploads/products/<?php echo $p_image1; ?>"
                                                        alt="<?php echo $product_title; ?>" class="lazy-img m-auto" />
                                                </a>
                                                <!-- Product Details -->
                                                <div>
                                                    <a href="product-details.php?id=<?php echo $product['product_id']; ?>"
                                                        class="job-duration fw-500">
                                                        <?php echo $product_title; ?> (<?php echo $pack_size; ?>)
                                                    </a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark"><?php echo $category_name; ?></span>
                                                    <br> <?php echo $format_name; ?>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a
                                                            href="product-details.php?id=<?php echo $product['product_id']; ?>">
                                                            <?php echo $origin_name ?>
                                                        </a>
                                                    </div>
                                                    <a href="product-details.php?id=<?php echo $product['product_id']; ?>"
                                                        class="apply-btn text-center tran3s">See Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <div class="pagination-area text-center">
                                    <ul class="pagination">
                                        <li><a href="#">Previous</a></li>
                                        <?php
                                        for ($x = 0; $x <= mysqli_num_rows($products_counts)/10; $x++) {
                                            $n=$x+1;
                                            echo "<li><a href='javascript:void(0)' class='page-link' data-page= '$n'>$n</a></li>";
                                          }
                                        ?>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div id="div1">

            </div>
        </div>
    </div>

    <!-- <script type="text/JavaScript">
    // JavaScript to toggle between list and grid views
    document.querySelector('.list-btn').addEventListener('click', function() {
        document.querySelector('.list-style').classList.add('show');
        document.querySelector('.grid-style').classList.remove('show');
        document.querySelector('.list-btn').classList.add('active');
        document.querySelector('.grid-btn').classList.remove('active');
    });

    document.querySelector('.grid-btn').addEventListener('click', function() {
        document.querySelector('.grid-style').classList.add('show');
        document.querySelector('.list-style').classList.remove('show');
        document.querySelector('.grid-btn').classList.add('active');
        document.querySelector('.list-btn').classList.remove('active');
    });
    </script> -->
    <!-- <script>
    $(document).ready(function() {

        $(".product_check").change(function() {
            var brand = get_filter_text('brand');
            var category = get_filter_text('category');
            var format = get_filter_text('format');
            var origin = $('.origin-dropdown').val();
            var page_id = 0;

            $.ajax({
                url: "product-api2.php",
                method: 'POST',
                data: {
                    action: 1,
                    origin: origin,
                    brand: brand,
                    category: category,
                    format: format,
                    page_id: page_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#list-btn").html(data.prod);
                    $(".prod_count").html(data.total_prod)
                    // $("#grid-btn").html(response);

                }
            });
        });

        function get_filter_text(text_id) {
            var filterData = [];
            $('#' + text_id + ' input:checked').each(function() {
                filterData.push($(this).val());
            });
            return filterData;
        }

        function paginate(total_prod) {
            var output = '';
            $.each(total_prod, function(index, value) {
                alert('aaa')
                output += '<li>' + value + '</li>'; // Add each item to output
            });
            $('.pagination').html(output); // Insert the result into the container
        }

    });
    </script> -->
    <script>
    $(document).ready(function() {

        $(".product_check").change(function() {
            fetch_product();
        });

        function get_filter_text(text_id) {
            var filterData = [];
            $('#' + text_id + ' input:checked').each(function() {
                filterData.push($(this).val());
            });
            return filterData;
        }

        function paginate(total_pages, current) {
            var output = '';
            var active = '';
            // Loop to create pagination links based on total pages
            for (var i = 1; i <= total_pages; i++) {
                var act = (i == current) ? 'active' : '';

                output += '<li><a href="javascript:void(0);" class="page-link ' + act + '" data-page="' + i +
                    '">' + i +
                    '</a></li>';
            }

            // Insert pagination links into the container
            $('.pagination').html(output);

            // Add click event for page links
            $(".page-link").click(function() {
                var page = $(this).data('page'); // Get the page number clicked
                loadPage(
                    page
                ); // Load the page content (you can create this function for page-specific loading)
            });
        }

        function loadPage(page_id) {

            // Implement logic to load products based on the selected page_id
            var brand = get_filter_text('brand');
            var category = get_filter_text('category');
            var format = get_filter_text('format');
            var origin = $('.origin-dropdown').val();


            $.ajax({
                url: "product-api2.php",
                method: 'POST',
                data: {
                    action: 1,
                    origin: origin,
                    brand: brand,
                    category: category,
                    format: format,
                    page_id: page_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#list-btn").html(data.prod); // Update product list
                    $(".prod_count").html(data.total_prod); // Update product count
                    paginate(data.total_page, data.page_no); // Update pagination
                }
            });
        }


        function fetch_product() {

            var brand = get_filter_text('brand');
            var category = get_filter_text('category');
            var format = get_filter_text('format');
            var origin = $('.origin-dropdown').val();
            var page_id = 1;

            $.ajax({
                url: "product-api2.php",
                method: 'POST',
                data: {
                    action: 1,
                    origin: origin,
                    brand: brand,
                    category: category,
                    format: format,
                    page_id: page_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#list-btn").html(data.prod); // Display product listings
                    $(".prod_count").html(data.total_prod); // Display total products count
                    paginate(data.total_page, data.page_no); // Generate pagination\
                }
            });
        }
        fetch_product();

    });
    </script>

    <?php include('footer.php'); ?>