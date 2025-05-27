<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-white">Announcements</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['code'] == 'success' ? 'success' : 'danger'; ?> mt-3">
            <?= $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['code']); ?>
    <?php endif; ?>
    
    <!-- Add Announcement Form -->
    <div class="card bg-dark text-white p-3">
        <h4>Add Announcement</h4>
        <form action="./addAnnouncement.php" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="title" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="message" rows="3" placeholder="Announcement Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Announcement</button>
        </form>
    </div>

    <!-- Announcements Table -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Recent Announcements</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Date Posted</th>
                    <th>Time Posted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
            include("../../dB/config.php");
            $query = "SELECT `announcementId`, `userId`, `title`, `message`, 
                             DATE(`datePosted`) AS `postDate`, 
                             TIME(`datePosted`) AS `postTime`, 
                             `updatedAt` 
                      FROM `announcements` 
                      ORDER BY `announcementId` DESC 
                      LIMIT 5";
            $result = mysqli_query($conn, $query);
            ?>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        echo "<td>{$row['announcementId']}</td>";
                        echo "<td style='max-width: 160px;'>{$row['title']}</td>";
                        echo "<td style='max-width: 500px;'>{$row['message']}</td>";
                        echo "<td style='width: 120px;'>{$row['postDate']}</td>";
                        echo "<td style='width: 120px;'>{$row['postTime']}</td>";
                        echo "<td>";
                            echo "<a href='editAnnouncement.php?id={$row['announcementId']}' class='btn btn-warning btn-sm mx-1'>Edit</a>";
                            echo "<a href='deleteAnnouncement.php?id={$row['announcementId']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this announcement?');\">Delete</a>";
                        echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("./includes/footer.php"); ?>
