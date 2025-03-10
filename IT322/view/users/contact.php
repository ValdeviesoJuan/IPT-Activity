<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">Contact Us</h2>

    <!-- Contact Information -->
    <div class="card bg-dark text-white p-3">
        <h4>Our Contact Details</h4>
        <p><i class="bi bi-envelope-fill"></i> Email: support@comiczone.com</p>
        <p><i class="bi bi-telephone-fill"></i> Phone: +1 234 567 890</p>
        <p><i class="bi bi-geo-alt-fill"></i> Address: 123 Comic Street, Gotham City</p>
    </div>

    <!-- Contact Form -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Send Us a Message</h4>
        <form action="contact_process.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control mb-2" name="email" placeholder="Your Email" required>
                </div>
            </div>
            <textarea class="form-control mb-2" name="message" rows="4" placeholder="Your Message" required></textarea>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>

</div>

<?php
include("./includes/footer.php");
?>
