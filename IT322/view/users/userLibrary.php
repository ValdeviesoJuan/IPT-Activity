<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");
?>

<h2 class="library-title">Library</h2>

<div class="library-status-container">
    <button class="status-btn active">Reading</button>
    <button class="status-btn">Plan to Read</button>
    <button class="status-btn">Completed</button>
    <button class="status-btn">On Hold</button>
    <button class="status-btn">Re-reading</button>
    <button class="status-btn">Dropped</button>
</div>

<?php
include("../../dB/config.php");

$queryCount = "SELECT COUNT(*) as total FROM comics";
$resultCount = mysqli_query($conn, $queryCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalComics = $rowCount['total'];
?>
 
<p class="comic-counter">
    <?php echo $totalComics . ($totalComics == 1 ? " Title" : " Titles"); ?>
</p> 

<div class="manga-results">
    <?php
    include("../../dB/config.php");

    $query = "SELECT * FROM comics ORDER BY updatedAt DESC LIMIT 10"; // Adjust as needed
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="manga-card">';
            echo "<a href='{$row['url']}' target='_blank'> ";
                echo "<img src='../../assets/{$row['cover']}' alt='Comic Cover' class='manga-cover'>";
            echo "</a>";
            echo '<div class="manga-details">';
                echo "<a href='{$row['url']}' target='_blank' >";
                    echo "<h3>{$row["title"]}</h3>";
                echo "</a>";
                echo "<p>{$row['genre']}</p>";
                echo "<h6><i class='ri-user-line icon-link' style='color: #fff; margin-right: 5px;'></i>{$row["author"]}</h6>";
            echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<style>
    .library-title {
        font-weight: bold;
        margin: 20px 0;
    }
    .library-status-container {
        display: inline-flex;
        padding: 3px;
        background-color: #343746;
        border-radius: 3px;
        margin-top: 30px;
    }
    .status-btn {
        border: none;
        background-color: #343746;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        border-radius: 3px;
        padding: 5px 10px;
        opacity: 0.5;
        cursor: pointer;
        transition: opacity 0.2s ease-in-out;
    }
    .status-btn.active {
        opacity: 1;
        background-color: #4f546f;
    }
    .comic-counter {
        margin: 30px 0;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
    }
    .manga-results {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
        margin-top: 40px;
    }

    .manga-results .manga-card {
        display: flex;
        background: #2c2c2e;
        border-radius: 5px;
        padding: 7px;
        width: 49%;
        align-items: flex-start;
    }

    .manga-results .manga-card .manga-cover {
        width: 150px;
        height: 220px;
        border-radius: 5px;
        object-fit: cover;
    }

    .manga-results .manga-card .manga-details {
        margin-left: 15px;
        flex-grow: 1;
    }

    .manga-results .manga-card .manga-details h3 {
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        margin-bottom: 7px;
        color: #fff;
    } 

    .manga-results .manga-card .manga-details p {
        font-size: 12px;
        color: #ffd900;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".status-btn");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                // Remove 'active' class from all buttons
                buttons.forEach(btn => btn.classList.remove("active"));

                // Add 'active' class to clicked button
                this.classList.add("active");
            });
        });
    });
</script>

<?php
include("../users/includes/footer.php");
?>
