<?php
include('header.php');
// include 'admin/connection.php';
?>

<body class="blog-page">
  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Blog</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Blog</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section -->
    <section id="blog-posts-2" class="blog-posts-2 section">

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-6 col-md-6">
            <article>

            <a href="blog-details_1.php"><div class="post-img">
              <img src="assets/img/blog-image-1.jpg" alt="" class="img-fluid">
              </div>
              </a>

              <div class="meta-top">
                <ul>
                  <li class="d-flex align-items-center"><a href="blog-details_1.php">Sorts</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-dot"></i> <a href="blog-details_1.php"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                </ul>
              </div>

              <h2 class="title">
                <a href="blog-details_1.php">UNILEVER INTERNATIONAL APPOINTS ARTISAN</a>
              </h2>

            </article>
          </div>
          <!-- End post list item -->

          <!-- <div class="col-lg-4 col-md-6">

            <article>

              <div class="post-img">
                <img src="assets/img/blog/blog-2.jpg" alt="" class="img-fluid">
              </div>

              <div class="meta-top">
                <ul>
                  <li class="d-flex align-items-center"><a href="blog-details.html">Fashion</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-dot"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                </ul>
              </div>

              <h2 class="title">
                <a href="blog-details.html">Nisi magni odit consequatur autem nulla dolorem</a>
              </h2>

            </article>

          </div> -->
          <!-- End post list item -->

          <!-- <div class="col-lg-4 col-md-6">

            <article>

              <div class="post-img">
                <img src="assets/img/blog/blog-3.jpg" alt="" class="img-fluid">
              </div>

              <div class="meta-top">
                <ul>
                  <li class="d-flex align-items-center"><a href="blog-details.html">Laws</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-dot"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jul 5, 2022</time></a></li>
                </ul>
              </div>

              <h2 class="title">
                <a href="blog-details.html">Possimus soluta ut id suscipit soluta</a>
              </h2>

            </article>

          </div> -->
          <!-- End post list item -->

        </div><!-- End blog posts list -->

      </div>

    </section>
    <!-- /Blog Posts Section -->

    <!-- Blog Pagination Section -->
    <!-- <section id="blog-pagination" class="blog-pagination section">

      <div class="container">
        <div class="d-flex justify-content-center">
          <ul>
            <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#" class="active">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li>...</li>
            <li><a href="#">10</a></li>
            <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>

    </section> -->
    <!-- /Blog Pagination Section -->

  </main>

  <?php include('footer.php'); ?>