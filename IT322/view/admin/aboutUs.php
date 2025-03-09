<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">About Us</h2>

    <!-- About Section -->
    <div class="card bg-dark text-white p-3">
        <h4>Our Mission</h4>
        <p>ComicZone is dedicated to providing the best comic recommendations, helping users discover amazing stories across various genres.</p>
    </div>

    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Our Vision</h4>
        <p>We aim to become the go-to platform for comic lovers, offering personalized suggestions and fostering a passionate community.</p>
    </div>

    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Our Team</h4>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="../../assets/img/geloImage.jpg" class="rounded-circle mb-2" alt="John Doe" 
                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid white; box-shadow: 0px 4px 8px rgba(255,255,255,0.3);">
                <h5>John Doe</h5>
                <p>Founder & CEO</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="../../assets/img/geloImage.jpg" class="rounded-circle mb-2" alt="Jane Smith" 
                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid white; box-shadow: 0px 4px 8px rgba(255,255,255,0.3);">
                <h5>Jane Smith</h5>
                <p>Lead Developer</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="../../assets/img/geloImage.jpg" class="rounded-circle mb-2" alt="Mike Johnson" 
                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid white; box-shadow: 0px 4px 8px rgba(255,255,255,0.3);">
                <h5>Mike Johnson</h5>
                <p>Content Curator</p>
            </div>
        </div>
    </div>

</div>

<?php
include("./includes/footer.php");
?>
