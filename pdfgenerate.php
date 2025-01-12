<?php
// Include TCPDF library
require_once('TCPDF/tcpdf.php');

// Database connection
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

// Extend the TCPDF class to create a custom footer
class CustomPDF extends TCPDF {
    // Custom footer
    public function Footer() {
        // Set position at 15 mm from bottom
        $this->SetY(-25);
        // Add the Unilever logo in the footer
        $image_file = 'assets/img/unilever.png'; // Path to the Unilever logo
        $this->Image($image_file, $this->GetPageWidth() - 30, $this->GetPageHeight() - 25, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }
}

// Create a new PDF document using the CustomPDF class
$pdf = new CustomPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Artisan Business Network Bangladesh-ABNB');
$pdf->SetTitle($product['global_code'] . '_' . $product['product_title']);
$pdf->SetSubject('Product Details PDF');
$pdf->SetKeywords('PDF, product, details, Artisan-IT, ABNB, SCCSEGUB201');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// Set margins
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 10);

// Add a page in landscape mode
$pdf->AddPage('L');

// HTML content for the PDF
$html = '
<table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', Times, serif;">
    <tr>
        <!-- Product Image -->
        <td style="width: 40%; text-align: center; vertical-align: top;">
            <img src="admin/uploads/products/' . $product['p_image1'] . '" style="width: 300px; height: auto;" alt="Product Image">
        </td>

        <!-- Product Details -->
        <td style="width: 60%; vertical-align: top;">
            <h1 style="font-size: 20px; color: #000; font-family: \'Times New Roman\', Times, serif;">' . $product['product_title'] . '</h1>
            <table style="width: 100%; border-collapse: collapse; font-family: \'Times New Roman\', Times, serif; border-spacing: 0;">
                <tr>
                    <td width="100px">UAPL CODE</td>
                    <td width="20px">:</td>
                    <td width="500px">' . $product['global_code'] . '</td>
                </tr>
                <tr>
                    <th>SKU</th>
                    <td width="20px">:</td>
                    <td >' . $product['sku_name'] . '</td>
                </tr>
                <tr><td font-weight: bold;>CATEGORY</td><td width="20px">:</td><td >' . $product['category_name'] . '</td></tr>
                <tr><td>FORMAT</td><td width="20px">:</td><td >' . $product['format_name'] . '</td></tr>
                <tr><td>BRAND</td><td width="20px">:</td><td >' . $product['brand_name'] . '</td></tr>
                <tr><td>MADE IN</td><td width="20px">:</td><td >' . $product['origin_name'] . '</td></tr>
                <tr><td>PACK SIZE</td><td width="20px">:</td><td >' . $product['pack_size'] . '</td></tr>
                
            </table>
            <br>
            <h3 style="font-family: \'Times New Roman\', Times, serif;">PRODUCT INFORMATION</h3>
            <p style="text-align: justify; font-family: \'Times New Roman\', Times, serif;">' . $product['description'] . '</p>
            <h3 style="font-family: \'Times New Roman\', Times, serif;">BENEFITS</h3>
            <p style="text-align: justify; font-family: \'Times New Roman\', Times, serif;">
                <ul style="list-style-type: square; font-family: \'Times New Roman\', Times, serif;">
                    ' . implode('', array_map(function($benefit) {
                        return '<li>' . trim($benefit) . '</li>';
                    }, explode("\n", $product['benefits']))) . '
                </ul>
            </p>
        </td>
    </tr>
</table>
';

// Add the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output('product_details.pdf', 'I');
?>
