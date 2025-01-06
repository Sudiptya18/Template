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

<style>
    .d-flex {
        justify-content: space-between;
    }
</style>

<body class="blog-details-page">

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>Statement</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Our Supply Partner</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <!-- Starts of Statement 1 -->
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="widgets-container">
                        <!-- Uniliver Picture -->
                        <div class="blog-author-widget widget-item">
                            <div class="d-flex align-items-center">
                                <img src="assets/img/Unilever_International Logo.png">
                                <img src="assets/img/unilever.png">
                            </div>
                        </div>
                        <!--/Uniliver Picture -->
                    </div>
                </div>

                <div class="col-lg-12">

                    <!-- Statement 1 Section -->
                    <div id="blog-details" class="blog-details sectionp">
                        <div class="container">

                            <article class="article">

                                <div class="content">
                                    <p>
                                        <b>Unilever International: A Global Force in Consumer Goods</b>
                                    </p>

                                    <p>
                                        Unilever International, a division of the globally renowned Unilever Group, is a
                                        powerhouse in the consumer goods industry, known for its unwavering commitment
                                        to delivering quality products that improve
                                        the lives of people around the world.

                                        As a multinational corporation with a presence in over 190 countries, Unilever
                                        International plays a pivotal role in the global landscape of
                                        fast-moving consumer goods (FMCG).

                                    </p>

                                    <blockquote>
                                        <p>
                                            A Rich History of Excellence
                                            Unilever, the parent company of Unilever International, was established in
                                            1929 through the merger of two British soap and food manufacturers, Lever
                                            Brothers and Margarine Unie. From those early days, the company's commitment
                                            to innovation and social responsibility has been unwavering.
                                        </p>
                                    </blockquote>

                                    <p>

                                        The Unilever International division emerged to oversee the company's expansion
                                        into international markets. It has since become a driving force in the company's
                                        mission to make sustainable living commonplace, which is deeply embedded in
                                        their corporate DNA.A Portfolio of iconic Brands Unilever International manages
                                        a vast portfolio of well-known and beloved brands
                                        across multiple categories. These brands are household names and encompass a
                                        wide range of products, from food and beverages to personal care, home care, and
                                        beauty products. Some of the iconic brands under the Unilever umbrella include
                                        Dove, Lipton, Knorr, Lux, Hellmann's, and marny more. These brands have earned
                                        the trust and loyalty of consumers worldwide, making them integral to people's
                                        everyday lives. Sustainability as a Guiding Principle
                                        Unilever international is at the forefront of the global sustainability
                                        movement.
                                    </p>
                                    <p>
                                        The company's Sustainable Living Plan outlines its vision for a more
                                        sustainable and equitable future. This commitment extends to all aspects of its
                                        operations, from responsible sourcing of raw materials to reducing its
                                        environmental footprint, and actively contributing to social and environmental
                                        causes. One of the most significant commitments within the Sustainable Living
                                        Plan is the pledge to make all of Unilever's products environmentally
                                        sustainable, benefitting not only the consumers but also the planet. Initiatives
                                        like reducing plastic waste, ensuring fair wages for smallholder farmers, and
                                        promoting gender equality are just a few examples of how Unilever International
                                        is making a real impact in the world.
                                    </p>
                                    <p>
                                        Global Reach, Local Impact
                                        Unilever International's global reach extends into diverse markets with a local
                                        touch. Their commitment to local communities is deeply embedded in their
                                        corporate ethos. This approach allows the company to tailor its products to meet
                                        the specific needs and preferences of different cultures and regions while
                                        addressing local challenges. Innovation for a Brighter Tomorrow Innovation is a
                                        driving force behind Unilever International's success. The company continuously
                                        invests in research and development to create products that cater to changing
                                        consumer demands and global challenges. Whether it's developing sustainable
                                        packaging solutions, launching plant-based alternatives, or pioneering new
                                        ingredients, Unilever International strives to stay at the forefront of industry
                                        trends. An Eye to the Future As Unilever International marches ahead, it remains
                                        dedicated to its core values of quality, sustainability, and social
                                        responsibility. The company's vision is to continue shaping the future of
                                        consumer goods by creating products that enrich lives and positively impact the
                                        planet.

                                    </p>
                                    <p>
                                        Unilever International stands as a global leader, not only for its exceptional
                                        product range but also for its commitment to creating a better world for
                                        everyone. It is a beacon of hope for a more sustainable and equitable future,
                                        and its journey is a testament to the impact that a global corporation can have
                                        when guided by a deep sense of purpose.
                                    </p>
                                </div><!-- End post content -->
                            </article>

                        </div>
                    </div><!-- /Statement 1 Section -->
                </div>

            </div>
        </div>
        <!-- End of Statement 1 -->

    </main>

</body>

</html>
<?php include('footer.php'); ?>