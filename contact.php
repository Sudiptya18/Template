<?php
include('header.php');
// Connect to the database
include 'admin/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    $attachment = null;

    // Validate form inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $response['message'] = "All fields are required.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email address.";
    } else {
        // Handle file upload (if "Submit Your Resume" is selected)
        if ($subject === "Submit Your Resume" && isset($_FILES['attachment'])) {
            $file = $_FILES['attachment'];

            // Check for upload errors
            if ($file['error'] === 0) {
                $allowedExtensions = ['pdf', 'doc', 'docx', 'txt'];
                $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    $uploadDir = 'assets/resume/';
                    $newFileName = 'resume_' . $name . '.' . $fileExtension;
                    $uploadPath = $uploadDir . $newFileName;

                    // Create the uploads directory if it doesn't exist
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // Move the uploaded file to the uploads directory
                    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                        $attachment = $newFileName;
                    } else {
                        $response['message'] = "Failed to upload the file.";
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    $response['message'] = "Invalid file type. Allowed types are: " . implode(', ', $allowedExtensions);
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = "Error uploading file.";
                echo json_encode($response);
                exit;
            }
        }

        // Save data to the database
        $sql = "INSERT INTO contact (name, email, subject, message, attachment) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $subject, $message, $attachment);


        if ($stmt->execute()) {
          $response['success'] = true;
          $response['message'] = "Your message has been successfully submitted.";
      
          // Redirect to the contact page with a query parameter
          header("Location: contact.php?submitted=true");
          exit; // Make sure no further code is executed after the redirect
      } else {
          $response['message'] = "Failed to save your message. Please try again.";
      }
      
    }
}

?>

<body class="contact-page">
    <main class="main">
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>Contact</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li class="current">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">
            <div class="container" data-aos="fade">
                <div class="row gy-5 gx-lg-5">
                    <!-- Contact Info -->
                    <div class="col-lg-4">
                        <div class="info">
                            <h3>Get in touch</h3>
                            <p>If You Have Any Query, Please Contact Us.</p>
                            <div class="info-item d-flex">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h4>Location:</h4>
                                    <p>Level # A-1, The Legend, House # 13 Rd 09, Dhaka 1212</p>
                                </div>
                            </div>
                            <div class="info-item d-flex">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h4>Email:</h4>
                                    <p>info@artisanbn.com</p>
                                </div>
                            </div>
                            <div class="info-item d-flex">
                                <i class="bi bi-phone flex-shrink-0"></i>
                                <div>
                                    <h4>Call:</h4>
                                    <p>+02222-292198</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Contact Info -->

                    <!-- Contact Form -->
                    <div class="col-lg-8">
                        <form action="contact.php" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <select class="form-control" name="subject" id="subject" onchange="toggleAttachment()" required>
                                    <option value="">Select a Subject</option>
                                    <option value="Feedback about the product">Feedback about the product</option>
                                    <option value="Complain">Complain</option>
                                    <option value="Business Proposal">Business Proposal</option>
                                    <option value="Corporate Partnership Proposal">Corporate Partnership Proposal</option>
                                    <option value="Submit Your Resume">Submit Your Resume</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group mt-3" id="attachment-group" style="display: none;">
                                <label for="attachment">Upload Your Resume:</label>
                                <input type="file" name="attachment" id="attachment" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div><!-- End Contact Form -->

                    <!-- Google Map -->
                    <div class="col-lg-12 d-flex justify-content-center align-items-center mt-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.1111390737333!2d90.41232027440861!3d23.779056387677358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c77f568e5c73%3A0x5ca3849b592b373!2sARTISAN%20BUSINESS%20NETWORK%20BANGLADESH!5e0!3m2!1sen!2sbd!4v1698063631853!5m2!1sen!2sbd" 
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div><!-- End Google Map -->
                </div>
            </div>
        </section><!-- /Contact Section -->
    </main>
</body>

<script>
    function toggleAttachment() {
        const subject = document.getElementById('subject').value;
        const attachmentGroup = document.getElementById('attachment-group');
        if (subject === "Submit Your Resume") {
            attachmentGroup.style.display = 'block';
        } else {
            attachmentGroup.style.display = 'none';
        }
    }
    // Check if the 'submitted' query parameter exists
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('submitted')) {
        // Refresh the page after submission
        setTimeout(function() {
            location.reload(); // Reload the page
        }, 2000); // 2 seconds delay before reload to allow the user to see the success message
    }

</script>

<?php include('footer.php');?>
