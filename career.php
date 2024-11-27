<?php
$body_class = 'index-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';

// Fetch all job posts from the career table
$query = "SELECT * FROM career ORDER BY `id` ASC";
$result = mysqli_query($conn, $query);
?>

<section id="career" class="career section">
    <div class="containers">
        <div class="intro text-center mb-5">
            <h1>Career Opportunity</h1>
            <p>Join with us and explore exciting job opportunities that match your skills and ambitions.</p>
        </div>

        <div class="row gap-4 justify-content-center">
            <?php while ($job = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-5 card career-card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($job['job_name']) ?></h3>
                        <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($job['job_location']) ?></p>
                        <p class="card-text"><strong>Experience:</strong> <?= htmlspecialchars($job['experience']) ?></p>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="career_details.php?id=<?= htmlspecialchars($job['id']) ?>" class="btn btn-details">See Details</a>
                            <a href="apply.php?id=<?= htmlspecialchars($job['id']) ?>" class="btn btn-apply">Apply</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
