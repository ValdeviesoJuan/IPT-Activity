<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

require '../../vendor/PHPMailer-master/src/PHPMailer.php';
require '../../vendor/PHPMailer-master/src/SMTP.php';
require '../../vendor/PHPMailer-master/src/Exception.php';

$messageSent = false;
$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if (empty($name) || empty($email) || empty($message)) {
        $errorMsg = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = 'Please enter a valid email address.';
    } else {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ratunil.josiah30@gmail.com';
            $mail->Password = 'btva uxzy njob fwuh';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('ratunil.josiah30@gmail.com');

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'New Message from ComicZone';
            $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

            $mail->send();
            $messageSent = true;
        } catch (Exception $e) {
            $errorMsg = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
?>

<div class="container mt-4">
    <h2 class="text-white">Contact Us</h2>

    <!-- Contact Information -->
    <div class="card bg-dark text-white p-3">
        <h4>Our Contact Details</h4>
        <p><i class="bi bi-envelope-fill"></i> Email: CommicZone404@gmail.com</p>
        <p><i class="bi bi-telephone-fill"></i> Phone: 09603306689</p>
        <p><i class="bi bi-geo-alt-fill"></i> Address: Zone 9E Hilltop, Macanhan, CDO</p>
    </div>

    <!-- Contact Form -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Send Us a Message</h4>

        <?php if ($messageSent): ?>
            <div class="alert alert-success">Message sent successfully!</div>
        <?php elseif ($errorMsg): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="name" placeholder="Your Name" required
                        value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control mb-2" name="email" placeholder="Your Email" required
                        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                </div>
            </div>
            <textarea class="form-control mb-2" name="message" rows="4" placeholder="Your Message" required><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>

<?php
include("./includes/footer.php");
?>
