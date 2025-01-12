<?php

include 'admin/connection.php';

$per_page = 10;

if (isset($_POST['action'])) {
    $sql = "SELECT p.product_id, p.sku_name, p.product_title, p.global_code, p.description, p.pack_size, 
                           p.brand_id, p.categories_id, p.format_id, p.origin_id, p.p_image1, p.p_image2, p.active,
                           b.brand_name, c.category_name, o.origin_name, f.format_name 
                    FROM product p
                    LEFT JOIN brands b ON p.brand_id = b.brand_id
                    LEFT JOIN categories c ON p.categories_id = c.categories_id
                    LEFT JOIN country_of_origin o ON p.origin_id = o.origin_id
                    LEFT JOIN format f ON p.format_id = f.format_id
                    WHERE p.brand_id !=''";
                    
    if (isset($_POST['origin']) && $_POST['origin'] != '0') {
        $origin = $_POST['origin'];
        $sql .= " AND p.origin_id IN (" . $origin . ")";
    }
    if (isset($_POST['brand'])) {
        $brand =  implode(",", $_POST['brand']);
        $sql .= " AND p.brand_id IN (" . $brand . ")";
    }
    if (isset($_POST['category'])) {
        $category = implode(",", array: $_POST['category']);
        $sql .= " AND p.categories_id IN (" . $category . ")";
    }
    if (isset($_POST['format'])) {
        $format = implode(",", $_POST['format']);
        $sql .= " AND p.format_id IN (" . $format . ")";
    }
    $aaa = $conn->query($sql)->num_rows;
    if (isset($_POST['page_id'])) {

        $page_id =   number_format($_POST['page_id']);
        $start = ($page_id-1) * $per_page;
        $st = number_format($start);
        $sql .= " ORDER BY p.product_title  LIMIT $st,$per_page";
        
    }

    $result = $conn->query($sql);
    $output = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= "<div class='job-list-one style-two position-relative border-style mb-20'>
                                            <div class='row justify-content-between align-items-center'>
                                                <div class='col-md-5'>
                                                    <div class='job-title d-flex align-items-center'>
                                                        <a href='product-details.php?id=$row[product_id];'
                                                            class='logo'><img
                                                                src='admin/uploads/products/$row[p_image1]'
                                                                alt=' $row[brand_name]'
                                                                class='lazy-img m-auto' /></a>
                                                        <div class='split-box1'>
                                                            <a href='brand-details.php?brand_id=$row[brand_id]'
                                                                class='job-duration fw-500'>$row[brand_name]</a>
                                                            <a href='product-details.php?id=$row[product_id]'
                                                                class='title fw-500 tran3s'>$row[product_title]</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-md-4 col-sm-6'>
                                                    <div class='job-location'>
                                                        <p>$row[origin_name]</p>
                                                    </div>
                                                    <div class='job-salary'>
                                                        <span
                                                            class='fw-500 text-dark'>$row[category_name]</span>
                                                        <br> $row[format_name]
                                                    </div>
                                                </div>
                                                <div class='col-md-3 col-sm-6' style='display:flex; flex-direction: column; align-items: center; justify-content: center;'>
                                                <div class='job-btn'>
                                                    <a href='product-details.php?id=$row[product_id];'
                                                        class='btn-one tran3s'>View Details</a>
                                                </div>
                                                <div class='job-btn' style='padding-top: 5%;'>
                                                    <a href='pdfgenerate.php?id=$row[product_id]'
                                                        class='btn-one tran3s' target='_blank'> Download</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>";
        }
    } else {
        $output = '<p class="text-center text-danger">No product found</p>';
    }

    $datas = array(

        "prod" => $output,
    
        "total_page"=> ceil($aaa/$per_page),
    
        "total_prod" => $aaa,
        "page_no" => $page_id

    
    );
    
    echo json_encode($datas);
}
