<?php
$body_class = 'index-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';

// Validate the job ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $job_id = intval($_GET['id']);

    // Fetch job details from the database
    $query = "SELECT * FROM career WHERE id = $job_id";
    $result = mysqli_query($conn, $query);

    // Check if the job exists
    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);
    } else {
        echo "<p class='text-center'>Job not found.</p>";
        include('footer.php');
        exit();
    }
} else {
    echo "<p class='text-center'>Invalid job ID.</p>";
    include('footer.php');
    exit();
}
?>
<section class="job-details-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h1 class="text-primaryz"><?= htmlspecialchars($job['job_name']) ?></h1>
                <p class="text-muted"><?= htmlspecialchars($job['start_date']) ?> - <?= htmlspecialchars($job['end_date']) ?></p>
            </div>
        </div>
        <div class="row gy-4">
            <!-- Card 1: Job Information, Skills, and Additional Information -->
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card shadow-sm border-0 w-100">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Job Information</h4>
                        <p><strong>Vacancy:</strong> <?= htmlspecialchars($job['vacancy']) ?></p>
                        <p><strong>Location:</strong> <?= htmlspecialchars($job['job_location']) ?></p>
                        <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
                        <p><strong>Experience:</strong> <?= htmlspecialchars($job['experience']) ?></p>
                        <hr>
                        <h4 class="card-title mb-3">Skills</h4>
                        <ul>
                            <?php
                            $skills = explode("\n", htmlspecialchars($job['skills']));
                            foreach ($skills as $skill) {
                                echo "<li>" . trim($skill) . "</li>";
                            }
                            ?>
                        </ul>
                        <hr>
                        <h4 class="card-title mb-3">Additional Information</h4>
                        <p><strong>Education:</strong> <?= htmlspecialchars($job['education']) ?></p>
                        <p><strong>Age:</strong> <?= htmlspecialchars($job['age']) ?></p>
                        <p><strong>Employment Status:</strong> <?= htmlspecialchars($job['status']) ?></p>
                        <p><strong>Additional Facilities:</strong> <?= htmlspecialchars($job['others']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Responsibilities -->
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card shadow-sm border-0 w-100">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Responsibilities</h4>
                        <ul>
                            <?php
                            $responsibilities = explode("\n", htmlspecialchars($job['responsibility']));
                            foreach ($responsibilities as $item) {
                                echo "<li>" . trim($item) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="career.php" class="btn btn-outline-secondary me-2">Back to Careers</a>
                <a href="apply.php?id=<?= htmlspecialchars($job_id) ?>" class="btn btn-primary">Apply Now</a>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>

<style>
    .job-details-section .card {
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .job-details-section .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }

    .job-details-section .card-title {
        font-weight: bold;
        color: #2c3e50;
    }

    .job-details-section ul {
        list-style: disc;
        padding-left: 20px;
    }

    .job-details-section ul li {
        margin-bottom: 8px;
        color: #34495e;
    }

    .job-details-section .btn-primary {
        background-color: #27ae60;
        border-color: #27ae60;
    }

    .job-details-section .btn-primary:hover {
        background-color: #229954;
        border-color: #229954;
    }

    .text-primaryz {
        color: rgb(24 169 80) !important;
    }

    .d-flex {
        display: flex !important;
    }

    .align-items-stretch {
        align-items: stretch !important;
    }

    .w-100 {
        width: 100% !important;
    }
</style>
