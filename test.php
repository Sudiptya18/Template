<?php
// Include the database connection
include 'admin/connection.php';

// Get the product_id from the query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 12;

// Fetch product details from the database
$sql = "
    SELECT p.sku_name, p.product_title, p.global_code, p.description, p.benefits, 
           p.pack_size, b.brand_name, c.category_name, f.format_name, o.origin_name, 
           p.p_image1
    FROM product p
    LEFT JOIN brands b ON p.brand_id = b.brand_id
    LEFT JOIN categories c ON p.categories_id = c.categories_id
    LEFT JOIN format f ON p.format_id = f.format_id
    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
    WHERE p.product_id = $product_id
";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Product not found!");
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        h1, h3 {
            margin: 5px 0;
        }
        p {
            text-align: justify;
        }
        .product-image img {
            width: 250px;
            height: auto;
        }
        .unilever-logo {
            text-align: right;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        .unilever-logo img {
            width: 100px;
        }
    </style>
</head>
<body>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <!-- Product Image -->
            <td style="width: 30%; text-align: center; vertical-align: top;">
                <div class="product-image">
                    <img src="admin/uploads/products/<?php echo $product['p_image1']; ?>" alt="Product Image">
                </div>
            </td>

            <!-- Product Details -->
            <td style="width: 70%; vertical-align: top;">
                <h1 style="font-size: 20px; color: #000;"><?php echo $product['product_title']; ?></h1>
                <table style="width: 100%; font-size: 14px;">
                    <tr><td><strong>UAPL CODE:</strong></td><td><?php echo $product['global_code']; ?></td></tr>
                    <tr><td><strong>SKU:</strong></td><td><?php echo $product['sku_name']; ?></td></tr>
                    <tr><td><strong>CATEGORY:</strong></td><td><?php echo $product['category_name']; ?></td></tr>
                    <tr><td><strong>FORMAT:</strong></td><td><?php echo $product['format_name']; ?></td></tr>
                    <tr><td><strong>BRAND:</strong></td><td><?php echo $product['brand_name']; ?></td></tr>
                    <tr><td><strong>MADE IN:</strong></td><td><?php echo $product['origin_name']; ?></td></tr>
                    <tr><td><strong>PACK SIZE:</strong></td><td><?php echo $product['pack_size']; ?></td></tr>
                </table>
                <br>
                <h3>PRODUCT INFORMATION:</h3>
                <p><?php echo $product['description']; ?></p>
                <h3>BENEFITS:</h3>
                <p><?php echo $product['benefits']; ?></p>
            </td>
        </tr>
    </table>

    <!-- Unilever Logo -->
    <div class="unilever-logo">
        <img src="assets/img/unilever.png" alt="Unilever Logo">
    </div>
</body>
</html>
