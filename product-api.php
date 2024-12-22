<?php
require 'admin/connection.php';

$wh_status = 0;
$add_and = '';
$count=0;
$return_arr = array();
$per_page = 10;
// f.format_id ,o.origin_id,c.categories_id,b.brand_id

if(!isset($_POST['page_id']) || !$_POST['page_id'] == ""){
    $page_ids = 0;    
}else{
    $page_ids = $_POST['page_id']*$per_page; 
}

if(!isset($_POST['brand']) || $_POST['brand'] == ""){
    $brand_ids = "";    
}else{
    $brand_id = $conn->real_escape_string($_POST['brand']);
    $brand_ids = "b.brand_id in ($brand_id)";
    $wh_status++;
}

if(!isset($_POST['catagory']) || $_POST['catagory'] == ""){
    $catagory_ids = "";  
}else{
    if($wh_status > 0){
        $add_and = ' AND ';
    }
    $catagory_id = $_POST['catagory'];
    $catagory_ids = $add_and."c.categories_id IN ($catagory_id)";
    $wh_status++;
}

if(!isset($_POST['origin']) || $_POST['origin'] == ""){
    $origin_ids = "";  
}else{
    if($wh_status > 0){
        $add_and = ' AND ';
    }
    $origin_id = $_POST['origin'];
    $origin_ids = $add_and."o.origin_id IN ($origin_id)";
    $wh_status++;
}


if(!isset($_POST['format']) || $_POST['format'] == ""){
    $format_ids = "";  
}else{
    if($wh_status > 0){
        $add_and = ' AND ';
    }
    $format_id = $_POST['format'];
    $format_ids = $add_and."f.format_id IN ($format_id)";
    $wh_status++;
}


if($wh_status == 0){
    $query = "SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.description, p.pack_size, 
                p.brand_id, p.categories_id, p.format_id, p.origin_id, p.p_image1, p.p_image2, p.active,
                b.brand_name, c.category_name, o.origin_name, f.format_name 
            FROM product p
                    LEFT JOIN brands b ON p.brand_id = b.brand_id
                    LEFT JOIN categories c ON p.categories_id = c.categories_id
                    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
                    LEFT JOIN format f ON p.format_id = f.format_id 
            LIMIT $page_ids,$per_page";

$count = "SELECT count(1) as page_count FROM product";
}else{
    $query = "SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.description, p.pack_size, 
                    p.brand_id, p.categories_id, p.format_id, p.origin_id, p.p_image1, p.p_image2, p.active,
                    b.brand_name, c.category_name, o.origin_name, f.format_name 
            FROM product p
                    LEFT JOIN brands b ON p.brand_id = b.brand_id
                    LEFT JOIN categories c ON p.categories_id = c.categories_id
                    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
                    LEFT JOIN format f ON p.format_id = f.format_id 
            WHERE $brand_ids $catagory_ids $origin_ids $format_ids LIMIT $page_ids,$per_page";            
}

echo $query;

$result = $conn -> query($query);
while($product = mysqli_fetch_array($result)){
    echo "<div class='job-list-one style-two position-relative border-style mb-20'>
        <div class='row justify-content-between align-items-center'>
            <div class='col-md-5'>
                <div class='job-title d-flex align-items-center'>
                    <a href='product-details.php?id= $product[product_id];'
                        class='logo'><img
                            src='admin/uploads/products/$product[p_image1]'
                            alt=' $product[brand_name]'
                            class='lazy-img m-auto' /></a>
                    <div class='split-box1'>
                        <a href='brand-details.php?id=$product[brand_id]'
                            class='job-duration fw-500'>$product[brand_name]</a>
                        <a href='product-details.php?id=$product[product_id]'
                            class='title fw-500 tran3s'>$product[product_title]</a>
                    </div>
                </div>
            </div>
            <div class='col-md-4 col-sm-6'>
                <div class='job-location'>
                    <p><?php echo $product[origin_name]; ?></p>
                </div>
                <div class='job-salary'>
                    <span
                        class='fw-500 text-dark'><?php echo $product[category_name]; ?></span>
                    <br> <?php echo $product[format_name]; ?>
                </div>
            </div>
            <div class='col-md-3 col-sm-6'>
                <div class='job-btn'>
                    <a href='product-details.php?id=<?php echo $product[product_id]; ?>'
                        class='btn-one tran3s'>View Details</a>
                </div>
            </div>
        </div>
    </div>";
};

// while($row = mysqli_fetch_array($result)){
//     $product_id = $row['product_id']; 
//    $product_title = $row['product_title'];
//    $SKU = $row['SKU'];
//    $product_description = $row['Descripyion'];
//    $Product_keyword = $row['Product_keyword']; 
//    $product_image1 = $row['product_image1'];
//    $product_image2 = $row['product_image'];
//    $catagory_id = $row['catagory_id']; 
//    $Brand_Id = $row['Brand_ID'];
//    $origin_name = $row['origin_name'];
//    $format   = $row['format'];
//    $return_arr[] = array(
//       "product_id"=> $product_id, 
//        "product_title"=> $product_title,
//        "SKU" => $SKU, 
//        "Descripyion"=> $product_description,
//        "Product_keyword"=> $product_keyword,  
//        "product_image1"=> $product_image1,
//        "product_image2"=> $product_image2,
//        "catagory_id"=> $catagory_id,
//        "Brand_ID"=> $Brand_Id,
//        "origin_name"=> $origin_name,
//        "format"=> $format,
//    );
// }



// $my_return = array(
//     // "prod" => $return_arr,
//     "total_page"=> ceil(($page_count["page_count"])/$per_page),
//     "query" => $query
// );



// // Encoding array in JSON format

// echo json_encode($my_return); //$return_arr







































