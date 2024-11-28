<?php
$body_class = 'index-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';

// Validate and fetch job information
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $job_id = intval($_GET['id']);

    // Fetch job name from the career table
    $query = "SELECT job_name FROM career WHERE id = $job_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);
        $job_name = htmlspecialchars($job['job_name']);
    } else {
        die("Job not found."); // Exit if job ID is invalid
    }
} else {
    die("Invalid job ID.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $present_address = mysqli_real_escape_string($conn, $_POST['present_address']);
    $linkedin_profile = mysqli_real_escape_string($conn, $_POST['linkedin_profile']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $attachment = $_FILES['attachment']['name'];
    $created_at = date('Y-m-d H:i:s');

    // File upload handling
    $target_dir = "assets/resume/";
    $target_file = $target_dir . basename($_FILES['attachment']['name']);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['pdf', 'doc', 'docx'];

    if (!in_array($file_type, $allowed_types)) {
        $error = "Only PDF, DOC, and DOCX files are allowed.";
    } elseif (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
        // Insert into the `job_apply` table
        $insert_query = "INSERT INTO job_apply (job_id, name, email, phone, gender, present_address, linkedin_profile, message, attachment, created_at)
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepared statement to avoid SQL injection
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("isssssssss", $job_id, $name, $email, $phone, $gender, $present_address, $linkedin_profile, $message, $attachment, $created_at);

        if ($stmt->execute()) {
            $success = "Your application has been submitted successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Failed to upload your file. Please try again.";
    }
}
?>

<section class="apply-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h1 class="text-primaryz">Apply for: <?= $job_name ?></h1>
            </div>
        </div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="row gy-4">
                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control styled-input" id="name" name="name" required>
                </div>
                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control styled-input" id="email" name="email" required>
                </div>
                <!-- Phone -->
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone *</label>
                    <input type="tel" class="form-control styled-input" id="phone" name="phone" required>
                </div>
                <!-- Gender -->
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender *</label>
                    <select class="form-select styled-input" id="gender" name="gender" required>
                        <option value="" disabled selected>Choose...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <!-- Address -->
                <div class="col-md-12">
                    <label for="present_address" class="form-label">Present Address *</label>
                    <textarea class="form-control styled-input" id="present_address" name="present_address" rows="3" required></textarea>
                </div>
                <!-- LinkedIn -->
                <div class="col-md-6">
                    <label for="linkedin_profile" class="form-label">LinkedIn Profile (Optional)</label>
                    <input type="url" class="form-control styled-input" id="linkedin_profile" name="linkedin_profile">
                </div>
                <!-- Message -->
                <div class="col-md-6">
                    <label for="message" class="form-label">Comments (If Any)</label>
                    <textarea class="form-control styled-input" id="message" name="message" rows="3"></textarea>
                </div>
                <!-- File -->
                <div class="col-md-12">
                    <label for="attachment" class="form-label">Attach Your CV *</label>
                    <input type="file" class="form-control styled-input" id="attachment" name="attachment" required>
                </div>
                <!-- Submit -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    // Automatically hide the success alert after 3 seconds
    document.addEventListener("DOMContentLoaded", function () {
        const successAlert = document.querySelector(".alert-success");
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = "opacity 0.5s ease";
                successAlert.style.opacity = "0";
                setTimeout(() => successAlert.remove(), 500); // Remove the element after fading out
            }, 3000); // 3 seconds delay
        }
    });
</script>
<?php include('footer.php'); ?>

<!-- CSS -->
<style>
    .apply-section .form-control.styled-input, .apply-section .form-select.styled-input {
        border: 2px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .apply-section .form-control.styled-input:focus, .apply-section .form-select.styled-input:focus {
        border-color: #27ae60;
        outline: none;
    }

    .apply-section .btn-primary {
        background-color: #27ae60;
        border-color: #27ae60;
        padding: 10px 20px;
        font-size: 18px;
    }

    .apply-section .btn-primary:hover {
        background-color: #229954;
        border-color: #229954;
    }

    .text-primaryz {
        color: rgb(24 169 80) !important;
    }

    .alert {
        margin-bottom: 20px;
        text-align: center;
    }
</style>
