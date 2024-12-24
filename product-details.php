<?php
$body_class = 'product-details-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';

// Get the product ID from the query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details from the database
$query = "
    SELECT 
        p.*, 
        b.brand_name, 
        c.category_name, 
        f.format_name, 
        o.origin_name 
    FROM 
        product p
    LEFT JOIN brands b ON p.brand_id = b.brand_id
    LEFT JOIN categories c ON p.categories_id = c.categories_id
    LEFT JOIN format f ON p.format_id = f.format_id
    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
    WHERE 
        p.product_id = $product_id AND p.active = 1
";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "<p>Product not found or inactive.</p>";
    include('footer.php');
    exit();
}
?>

<head>
    <link href="assets/css/0._YIa9mqy.css" rel="stylesheet">
    <link href="assets/css/Preloader.BHFBcupA.css" rel="stylesheet">
</head>
<style>
    .product-images {
        text-align: center;
        margin-top: 20px;
    }

    .thumbnail {
        border: 2px solid transparent;
        transition: border 0.3s;
    }

    .thumbnail:hover {
        border: 2px solid #007bff;
    }
</style>

<body data-sveltekit-preload-data="hover" data-new-gr-c-s-check-loaded="14.1212.0" data-gr-ext-installed=""
    style="overflow: visible;">
    <div style="display: contents">
        <div class="main-page-wrapper">
            <div class="inner-banner-one position-relative">
                <div class="container">
                    <div class="position-relative">
                        <div class="product-images">
                            <!-- Main Image -->
                            <div class="main-image">
                                <img id="current-image" src="admin/uploads/products/<?php echo $product['p_image1']; ?>"
                                    alt="Main Product Image"
                                    style="width: 300px; height: 300px; display: block; margin: 0 auto;">
                            </div>

                            <!-- Thumbnail Images -->
                            <div class="thumbnail-images"
                                style="display: flex; justify-content: center; gap: 10px; margin-top: 15px;">
                                <img class="thumbnail" src="admin/uploads/products/<?php echo $product['p_image1']; ?>"
                                    alt="Thumbnail 1" style="width: 100px; height: 100px; cursor: pointer;"
                                    onclick="changeImage(this)">
                                <img class="thumbnail" src="admin/uploads/products/<?php echo $product['p_image2']; ?>"
                                    alt="Thumbnail 2" style="width: 100px; height: 100px; cursor: pointer;"
                                    onclick="changeImage(this)">
                                <img class="thumbnail" src="admin/uploads/products/<?php echo $product['p_image1']; ?>"
                                    alt="Thumbnail 3" style="width: 100px; height: 100px; cursor: pointer;"
                                    onclick="changeImage(this)">
                                <img class="thumbnail" src="admin/uploads/products/<?php echo $product['p_image2']; ?>"
                                    alt="Thumbnail 4" style="width: 100px; height: 100px; cursor: pointer;"
                                    onclick="changeImage(this)">
                            </div>
                        </div>

                        <script>
                            // JavaScript to switch the main image when a thumbnail is clicked
                            function changeImage(thumbnail) {
                                document.getElementById('current-image').src = thumbnail.src;
                            }
                        </script>

                    </div>
                </div>
                <section class="job-details style-two pt-100 lg-pt-80 pb-130 lg-pb-80">
                    <div slot="container" class="container">
                        <div class="row">
                            <div class="col-xxl-9 col-xl-10 m-auto">
                                <div class="details-post-data ps-xxl-4 pe-xxl-4">
                                    <ul
                                        class="job-meta-data-two d-flex flex-wrap justify-content-center justify-content-lg-between style-none">
                                        <div class="bg-wrapper bg-white text-center">
                                            <img src="assets/img/icons/brand-icon.png" alt=""
                                                class="lazy-img m-auto icon">
                                            <span>Brand</span>
                                            <div><?php echo htmlspecialchars($product['brand_name']); ?></div>
                                        </div>
                                        <div class="bg-wrapper bg-white text-center">
                                            <img src="assets/img/icons/category-icon.png" alt=""
                                                class="lazy-img m-auto icon">
                                            <span>Categories</span>
                                            <div><?php echo htmlspecialchars($product['category_name']); ?></div>
                                        </div>
                                        <div class="bg-wrapper bg-white text-center">
                                            <img src="assets/img/icons/format-icon.png" alt=""
                                                class="lazy-img m-auto icon">
                                            <span>Format</span>
                                            <div><?php echo htmlspecialchars($product['format_name']); ?></div>
                                        </div>
                                        <div class="bg-wrapper bg-white text-center">
                                            <img src="assets/img/icons/origin-icon.png" alt=""
                                                class="lazy-img m-auto icon">
                                            <span>Country of Origin</span>
                                            <div><?php echo htmlspecialchars($product['origin_name']); ?></div>
                                        </div>
                                        <div class="bg-wrapper bg-white text-center">
                                            <img src="assets/img/icons/pack-icon.png" alt=""
                                                class="lazy-img m-auto icon">
                                            <span>Pack Size</span>
                                            <div><?php echo htmlspecialchars($product['pack_size']); ?></div>
                                        </div>
                                    </ul>
                                    <div class="post-block mt-50 lg-mt-40">
                                        <h4 class="block-title">Product Description</h4>
                                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                                    </div>
                                    <div class="post-block mt-70 lg-mt-40">
                                        <h4 class="block-title">Benefits</h4>
                                        <!-- Product Benefits -->
                                        <ul class="list-type-one style-none mb-15">
                                            <?php
                                            $benefits = explode("\n", $product['benefits']);
                                            foreach ($benefits as $benefit) {
                                                echo "<li>" . htmlspecialchars($benefit) . "</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>