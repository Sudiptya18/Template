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
$products_query = "SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.description, p.pack_size, 
                           p.brand_id, p.categories_id, p.format_id, p.origin_id, p.p_image1, p.p_image2, p.active,
                           b.brand_name, c.category_name, o.origin_name, f.format_name 
                    FROM product p
                    LEFT JOIN brands b ON p.brand_id = b.brand_id
                    LEFT JOIN categories c ON p.categories_id = c.categories_id
                    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
                    LEFT JOIN format f ON p.format_id = f.format_id";
$products_result = mysqli_query($conn, $products_query);
?>

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
                                            href="#collapseLocation" role="button" aria-expanded="false">Country of
                                            Origin</a>
                                        <div class="collapse show" id="collapseLocation">
                                            <div class="main-body">
                                                <select class="nice-select bg-white" style="display: none">
                                                    <option value="0">All</option>
                                                    <?php while ($origin = mysqli_fetch_assoc($origin_result)) { ?>
                                                        <option value="<?php echo $origin['origin_id']; ?>">
                                                            <?php echo $origin['origin_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="nice-select bg-white" tabindex="0">
                                                    <span class="current">ALL</span>
                                                    <ul class="list">
                                                        <li data-value="0" class="option selected">All</li>
                                                        <?php while ($origin = mysqli_fetch_assoc($origin_result)) { ?>
                                                            <li data-value="<?php echo $origin['origin_id']; ?>"
                                                                class="option"><?php echo $origin['origin_name']; ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Brand Filter -->
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark" data-bs-toggle="collapse"
                                            href="#collapseJobType" role="button" aria-expanded="false">Brands</a>
                                        <div class="collapse show" id="collapseJobType">
                                            <div class="main-body">
                                                <ul class="style-none filter-input">
                                                    <?php while ($brand = mysqli_fetch_assoc($brands_result)) { ?>
                                                        <li>
                                                            <input type="checkbox" name="brand[]"
                                                                value="<?php echo $brand['brand_id']; ?>" />
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
                                                <ul class="style-none filter-input">
                                                    <?php while ($category = mysqli_fetch_assoc($categories_result)) { ?>
                                                        <li>
                                                            <input type="checkbox" name="category[]"
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
                                        <div class="collapse" id="collapseCategory">
                                            <div class="main-body">
                                                <ul class="style-none filter-input">
                                                    <?php while ($format = mysqli_fetch_assoc($format_result)) { ?>
                                                        <li>
                                                            <input type="checkbox" name="format[]"
                                                                value="<?php echo $format['format_id']; ?>" />
                                                            <label for=""><?php echo $format['format_name']; ?></label>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                                <div class="more-btn">
                                                    <i class="bi bi-plus"></i> Show More
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" class="btn-ten fw-500 text-white w-100 text-center tran3s mt-30">Apply
                                        Filter</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8">
                            <div class="job-post-item-wrapper ms-xxl-5 ms-xl-3">
                                <div class="upper-filter d-flex justify-content-between align-items-center mb-20">
                                    <div class="total-job-found">
                                        Total <span
                                            class="text-dark"><?php echo mysqli_num_rows($products_result); ?></span>
                                        Products found
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="style-changer-btn text-center rounded-circle tran3s ms-2 list-btn"
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
                                                            <a href="brand-details.php?id=<?php echo $brand['brand_id']; ?>"
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
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="job-btn">
                                                        <a href="product-details.php?id=<?php echo $product['product_id']; ?>"
                                                            class="btn-one tran3s">View Details</a>
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
                                        while ($product = mysqli_fetch_assoc($products_result)) {
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
                                                        <img src="<?php echo $p_image1; ?>"
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
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
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
    </script>
</body>

<?php include('footer.php'); ?>