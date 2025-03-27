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

    $query = "SELECT c.comicId, c.title, au.authorName, ar.artistName, c.synopsis, c.cover, c.url, c.publicationDate, 
                     c.publicationStatus, c.contentRating,
                    GROUP_CONCAT(DISTINCT g.genre ORDER BY g.genre ASC) AS genres,
                    GROUP_CONCAT(DISTINCT t.theme ORDER BY t.theme ASC) AS themes
            FROM comics c
            LEFT JOIN comicgenre cg ON c.comicId = cg.comicId
            LEFT JOIN genres g ON cg.genreId = g.genreId
            LEFT JOIN comictheme ct ON c.comicId = ct.comicId
            LEFT JOIN themes t ON ct.themeId = t.themeId
            LEFT JOIN comicauthor cau ON c.comicId = cau.comicId
            LEFT JOIN authors au ON cau.authorId = au.authorId
            LEFT JOIN comicartist car ON c.comicId = car.comicId
            LEFT JOIN artists ar ON car.artistId = ar.artistId
            GROUP BY c.comicId
            ORDER BY c.comicId DESC
            LIMIT 5;";

    $result = mysqli_query($conn, $query);
    $count = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($count % 2 == 0) echo "<div class='manga-row'>";
        // Determine Publication Status Color
        $status_color = match ($row['publicationStatus']) {
            'Ongoing' => '#04d000',
            'Hiatus' => 'red',
            'Completed' => '#00c9f5',
            default => 'gray'
        };

        // Determine Content Rating Color
        $rating_color = match ($row['contentRating']) {
            'Safe' => '#f8f9fa', 
            'Suggestive' => 'orange',
            'Erotica' => 'red',
            default => '#ccc'
        };
        
        $genres = explode(",", $row['genres']);
    ?>
    
    <div class="manga-card">
        <a href="<?= $row['url'] ?>" target="_blank">
            <img src="../../assets/<?= $row['cover'] ?>" alt="Comic Cover" class="manga-cover">
        </a>
        <div class="manga-details">
            <h3><?= $row["title"] ?></h3>
            
            <!-- Publication Status -->
            <div class="status-box">
                <span class="status-circle" style="background-color: <?= $status_color ?>;"></span>
                <span class="status-text"><?= $row['publicationStatus'] ?></span>
            </div>
            
            <!-- Content Rating, Genres, and Themes -->
            <div class="info-row">
                <span class="rating-box" style="background-color: <?= $rating_color ?>;">
                    <?= $row['contentRating'] ?>
                </span>

                <?php  
                if (!empty($row['genres'])) {
                    $genresArray = explode(',', $row['genres']);
                    foreach ($genresArray as $genre) {
                        echo "<span class='genre'>$genre</span>";
                    }
                }
 
                if (!empty($row['themes'])) {
                    $themesArray = explode(',', $row['themes']);
                    foreach ($themesArray as $theme) {
                        echo "<span class='theme'>$theme</span>";
                    }
                }
                ?>
            </div>
            
            <!-- Synopsis -->
            <p class="synopsis"><?= $row['synopsis'] ?></p>
        </div>
    </div>

    <?php 
        if ($count % 2 == 1) echo "</div>"; // Close row after two items
        $count++;
    }

    if ($count % 2 == 1) echo "</div>"; // Close any unclosed row
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
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
        margin-top: 40px;
    }
    
    .manga-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .manga-card {
        flex: 1;
        max-width: calc(50% - 10px); /* 50% width with spacing */
        display: flex;
        background: #2c2c2e;
        border-radius: 5px;
        padding: 15px;
        align-items: flex-start;
    }

    .manga-cover {
        width: 150px;
        height: 220px;
        border-radius: 5px;
        object-fit: cover;
    }

    .manga-details {
        margin-left: 15px;
        flex-grow: 1;
    }

    .manga-details h3 {
        font-size: 16px;
        font-weight: bold;
        margin: 0;
        margin-bottom: 10px;
        color: #fff;
    }

    /* Publication Status */
    .status-box {
        display: flex;
        align-items: center;
        background: gray;
        color: white;
        padding: 3px 10px;
        border-radius: 5px;
        width: fit-content;
        font-size: 12px;
    }

    .status-circle {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    /* Info Row */
    .info-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;  
    }

    /* Content Rating */
    .rating-box {
        flex-shrink: 0; /* Prevents shrinking */
        padding: 0 10px;
        color: black;
        border-radius: 5px;
        font-size: 12px;
        width: fit-content;
        font-weight: bold;
        white-space: nowrap;
    }

    .genre, .theme { 
        color: white;
        padding: 4px 8px; 
        font-size: 12px;
        width: fit-content; 
        white-space: nowrap;
    }

    /* Synopsis */
    .synopsis {
        position: relative;
        height: 100px;
        overflow: hidden;
        line-height: 1.4;
        color: #ccc;
    }
    
    .synopsis::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 10px; /* Adjust the height of the fading effect */
        background: linear-gradient(transparent, #2c2c2e); /* Background should match the container */
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
