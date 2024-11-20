<?php
$body_class = 'index-page';
include('header.php'); 
// Connect to the database
include 'admin/connection.php';

// Fetch the data for id = 1
$sql = "SELECT image, name, designation FROM team WHERE id = 1";
$result = $conn->query($sql);

// Fetch the data for id = 2
$sql2 = "SELECT image, name, designation FROM team WHERE id = 2";
$result2 = $conn->query($sql2);

// Initialize variables
$image = '';
$name = '';
$designation = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image = htmlspecialchars($row['image']);
    $name = htmlspecialchars($row['name']);
    $designation = htmlspecialchars($row['designation']);
}
if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $image2 = htmlspecialchars($row2['image']);
    $name2 = htmlspecialchars($row2['name']);
    $designation2 = htmlspecialchars($row2['designation']);
}
?>
<!DOCTYPE html>
<html lang="en">

<body class="blog-details-page">

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>Statement</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Statement</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <!-- Starts of Statement 1 -->
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Statement 1 Section -->
                    <div id="blog-details" class="blog-details sectionp">
                        <div class="container">

                            <article class="article">

                                <div class="content">
                                    <p>
                                        We are dedicated to providing high-quality products to businesses and consumers
                                        in the local market. As an import, distribution, and marketing company, we
                                        specialize in sourcing and delivering exceptional products from overseas
                                        suppliers to our customers.
                                    </p>

                                    <p>
                                        Our commitment to ethical and sustainable business practices is at the forefront
                                        of our mission. We take pride in supporting fair trade and promoting
                                        sustainability throughout our supply chain. Our team works closely with our
                                        suppliers to ensure that we source products that are ethically produced,
                                        environmentally friendly, and socially responsible. We are proud to be
                                        associated with Artisan Outfitters Ltd, one of the best clothing companies in
                                        Bangladesh. They have successfully positioned themselves as a reliable and
                                        high-quality supplier of clothing products to clients worldwide. Artisan
                                        Outfitters Ltd takes pride in its commitment to sustainability and social
                                        responsibility, and we are happy to partner with them. Our company was founded
                                        with the aim of bringing unique and high-quality products from around the world
                                        to the local market. Starting with a small team and a handful of suppliers, we
                                        have grown steadily over the years to become a leading importer and distributor
                                        in our industry.

                                    </p>

                                    <blockquote>
                                        <p>
                                            At Artisan Business Network, we are always looking for ways to improve and
                                            innovate as we expand our offerings and services to meet the evolving needs
                                            of our customers. We are grateful for your continued support and look
                                            forward to serving you in the future.

                                        </p>
                                    </blockquote>

                                    <p>
                                        We offer a wide range of products from various categories, including personal
                                        care products, household items, food and beverage, and more. Our team of experts
                                        carefully selects each product, ensuring that it meets our strict quality
                                        standards and aligns with our values of sustainability and fair trade. Our team
                                        consists of experienced professionals who are passionate about our products and
                                        committed to delivering the highest level of quality and value to our customers.
                                        We serve a diverse range of customers, including small businesses, retail
                                        stores, restaurants, and individual consumers. We pride ourselves on our ability
                                        to provide customized solutions to meet the unique needs of each of our
                                        customers.

                                    </p>
                                    <p>
                                        We are committed to providing our customers with exceptional service and
                                        products at competitive prices. Our strong distribution network enables us to
                                        efficiently deliver products to our customers across the local market. Our
                                        logistics team works closely with our suppliers to ensure timely and reliable
                                        deliveries, while also providing tracking and communication to keep our
                                        customers informed every step of the way. Product diversification is a key
                                        aspect of our strategy, responding to the ever-evolving needs of our diverse
                                        customer base. From household essentials to lifestyle indulgences, our portfolio
                                        caters to discerning tastes, and we continually expand our offerings to bring
                                        the best of the global market to our customers' doorsteps.
                                    </p>
                                    <p>
                                        Navigating the complexities of international trade regulations is a forte at
                                        ABNB, ensuring legally sound cross-border operations. We proactively identify
                                        and mitigate risks within the supply chain, employing robust risk management
                                        strategies that encompass comprehensive assessments, contingency planning, and
                                        continuous monitoring.
                                    </p>
                                    <p>
                                        Thank you for your continued trust and partnership.
                                    </p>
                                </div><!-- End post content -->
                            </article>

                        </div>
                    </div><!-- /Statement 1 Section -->


                </div>

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container">

                        <!-- Statement Author Widget -->
                        <div class="blog-author-widget widget-item">
                            <div class="d-flex flex-column align-items-center">
                                <img src="<?= $image ?>" class="rounded-circle flex-shrink-0" alt="<?= $name ?>">
                                <h3><?= $name ?></h3>
                                <p><?= $designation ?></p>
                            </div>
                        </div>
                        <!--/Statement Author Widget -->

                    </div>

                </div>


            </div>
        </div>
        <!-- End of Statement 1 -->
        <!-- Starts of Statement 2 -->
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Statement 1 Section -->
                    <div id="blog-details" class="blog-details sectionp">
                        <div class="container">

                            <article class="article">

                                <div class="content">
                                    <p>
                                        I am proud to lead an organization that stands at the forefront of import and
                                        distribution excellence. Our commitment to providing high-quality products to
                                        businesses and consumers in Bangladesh is unwavering, and our strategic
                                        alliances and seasoned team ensure that we excel in every aspect of our
                                        operations.
                                    </p>

                                    <p>
                                        We offer a wide range of products from various categories, including personal
                                        care products, household items, food and beverage, and more. Our team of experts
                                        carefully selects each product, ensuring that it meets our strict quality
                                        standards and aligns with our values of sustainability and fair trade. Our team
                                        consists of experienced professionals who are passionate about our products and
                                        committed to delivering the highest level of quality and value to our customers.
                                        We serve a diverse range of customers, including small businesses, retail
                                        stores, restaurants, and individual consumers. We pride ourselves on our ability
                                        to provide customized solutions to meet the unique needs of each of our
                                        customers.


                                    </p>

                                    <blockquote>
                                        <p>
                                            At Artisan Business Network, our mission is clear—to facilitate seamless
                                            connections between global suppliers and the local market, ensuring a
                                            diverse range of quality products reaches our customers. We have swiftly
                                            emerged as the master importer and national distributor of Unilever
                                            International in Bangladesh, and our proud partnership with Ximiso, a
                                            globally acclaimed fast-fashion franchise, further solidifies our position
                                            in the market.

                                        </p>
                                    </blockquote>

                                    <p>
                                        Our vision is to foster global connections and deliver excellence through
                                        strategic partnerships, elevating businesses and ensuring sustainable growth.
                                        Our import and distribution expertise is unparalleled, with a focus on
                                        understanding market trends, maintaining compliance with quality standards, and
                                        orchestrating an efficient supply chain. This proficiency positions us as the
                                        go-to master importer and national distributor, setting the industry benchmark.
                                        Product diversification is a key aspect of our strategy, responding to the
                                        ever-evolving needs of our diverse customer base. From household essentials to
                                        lifestyle indulgences, our portfolio caters to discerning tastes, and we
                                        continually expand our offerings to bring the best of the global market to our
                                        customers' doorsteps.
                                    </p>
                                    <p>
                                        Our meticulous global sourcing strategy allows us to select suppliers
                                        strategically and tap into diverse regions, resulting in a rich and varied
                                        product portfolio that aligns with international market trends. We invest in
                                        continuous market research and trends analysis, enabling us to anticipate shifts
                                        and proactively adapt our offerings to meet consumer expectations.
                                    </p>
                                    <p>
                                        Product diversification is a key aspect of our strategy, responding to the
                                        ever-evolving needs of our diverse customer base. From household essentials to
                                        lifestyle indulgences, our portfolio caters to discerning tastes, and we
                                        continually expand our offerings to bring the best of the global market to our
                                        customers' doorsteps. Navigating the complexities of international trade
                                        regulations is a forte at Artisan Business Network, ensuring seamless and
                                        legally sound cross-border operations. We proactively identify and mitigate
                                        risks within the supply chain, employing robust risk management strategies that
                                        encompass comprehensive assessments, contingency planning, and continuous
                                        monitoring.
                                    </p>
                                    <p>
                                        Our agile response mechanisms enable us to adapt swiftly to market fluctuations,
                                        leveraging changes to our advantage and staying ahead in a dynamic business
                                        landscape. As we explore a world of premium choices through our diverse product
                                        portfolio, we invite you to discover excellence in every product curated by
                                        Artisan Business Network.
                                    </p>
                                    <p>
                                        Thank you for your continued trust and partnership.
                                    </p>
                                </div><!-- End post content -->
                            </article>

                        </div>
                    </div><!-- /Statement 1 Section -->


                </div>

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container">

                        <!-- Statement 1 Author Widget -->
                        <div class="blog-author-widget widget-item">
                            <div class="d-flex flex-column align-items-center">
                                <img src="<?= $image2 ?>" class="rounded-circle flex-shrink-0" alt="<?= $name2 ?>">
                                <h3><?= $name2 ?></h3>
                                <p><?= $designation2 ?></p>
                            </div>
                        </div>
                        <!--/Statement 1 Author Widget -->

                    </div>

                </div>


            </div>
        </div>
        <!-- End of Statement 2 -->

    </main>

</body>

</html>
<?php include('footer.php'); ?>