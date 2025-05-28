<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-white text-center mb-4">📢 Latest Announcements</h2>

    <?php
    include("../../dB/config.php");
    $query = "SELECT `announcementId`, `title`, `message`, 
                     DATE(`datePosted`) AS `postDate`, 
                     TIME(`datePosted`) AS `postTime`
              FROM `announcements`
              ORDER BY `announcementId` DESC
              LIMIT 10";
    $result = mysqli_query($conn, $query);
    $announcements = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $announcements[] = $row;
    }

    if (count($announcements) > 0):
    ?>

    <div id="announcementCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" data-bs-pause="hover">
        <div class="carousel-inner">

            <?php foreach ($announcements as $index => $announcement): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <div class="card bg-dark text-white mx-auto shadow-lg" style="max-width: 700px;">
                        <div class="card-body">
                            <h4 class="card-title text-warning"><?= htmlspecialchars($announcement['title']) ?></h4>
                            <p class="card-text"><?= nl2br(htmlspecialchars($announcement['message'])) ?></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Posted on <?= $announcement['postDate'] ?> at <?= $announcement['postTime'] ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            No announcements available at the moment.
        </div>
    <?php endif; ?>
</div>

<?php include("./includes/footer.php"); ?>
