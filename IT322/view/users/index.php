<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");
?>

<!-- Recently Added Comics Section -->
<div class="card text-white p-3" style="background-color: #1a1a1c; color: white;">
    <h2 class="mb-4">Recently Added</h2>
    <div class="recently-added-container">
        <div class="recently-added">
            <?php
            include("../../dB/config.php");

            $query = "SELECT * FROM comics ORDER BY createdAt DESC LIMIT 10"; // Adjust limit as needed
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a href='{$row['url']}' target='_blank'>";
                        echo "<div class='comic-item'>";
                            echo "<img src='../../assets/uploads/{$row['cover']}' alt='Comic Cover' class='comic-cover'>";
                            echo "<p>{$row["title"]}</p>";
                        echo '</div>';
                    echo "</a>";
                }
            } else {
                echo "<div class='no-comics-found'>";
                    echo "<p>No comics found</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <h2 class="mt-5 mb-2">Latest Updates</h2>
    <div class="latest-updates-container">
        <?php
        include("../../dB/config.php");

        $query = "SELECT c.comicId, c.title, au.authorName, ar.artistName, c.cover, c.url, c.updatedAt,
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
                    LIMIT 5";

        $result = mysqli_query($conn, $query);

        $comics = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $comics[] = $row;
        }

        // Split comics into two columns (6 per column)
        if (count($comics) > 0) {
            $chunks = array_chunk($comics, 6);
            foreach ($chunks as $chunk) {
                echo '<div class="update-column">';
                foreach ($chunk as $comic) {
                    echo '<div class="comic-item">';
                        echo "<a class='comic-link' href='{$comic['url']}' target='_blank'>";
                            echo "<img src='../../assets/uploads/{$comic['cover']}' alt='Comic Cover' class='comic-cover'>";
                        echo "</a>";
                        echo "<div class='comic-info'>";
                            echo "<a class='comic-link' href='{$comic['url']}' target='_blank'>";
                                echo "<p class='comic-title'>{$comic["title"]}</p>";
                            echo "</a>";
                            echo "<div class='comic-meta'>";
                                echo "<p><i class='ri-user-line icon-link' style='color: #fff; margin-right: 5px;'></i>{$comic["authorName"]}</p>";
                                echo "<p class='update-time'>" . date("M d, Y H:i", strtotime($comic["updatedAt"])) . "</p>";
                            echo "</div>";
                        echo "</div>";
                    echo '</div>';
                }
                echo '</div>';
            }
        } else {
            echo "<div class='no-comics-found'>";
                echo "<p>No comics found</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<style>
.no-comics-found {
    display: flex; 
    justify-content: center;
    align-items: center; 
    text-align: center; 
    width: 100%;
    min-height: 100px;
    border-radius: 5px;
    background-color: #2C2C2C;
    color: white; 
    font-size: 18px;
    font-weight: bold;
}

.recently-added-container {
    overflow-x: auto;
    white-space: nowrap; 
    direction: ltr;  
}

.recently-added {
    display: flex;
    flex-direction: row;
    gap: 15px; 
} 

.recently-added .comic-item {
    display: flex;
    flex-direction: column; 
    min-width: 150px; /* Adjust based on cover size */ 
    margin-right: 25px;
    cursor: pointer;
    color: #fff;
}

.recently-added .comic-item p {
    margin-top: 5px;
    font-size: 18px;
    font-weight: bold;
    word-wrap: break-word; 
    white-space: normal;  
    max-width: 150px; 
    overflow-wrap: break-word; 
}

.recently-added .comic-item .comic-cover {
    width: 150px;
    height: 200px;
    object-fit: cover; 
    border-radius: 3px;  
}

.latest-updates-container {
    display: flex;
    justify-content: space-between;  
    gap: 20px;
}

.update-column {
    display: flex;
    flex-direction: column;
    padding: 25px;
    gap: 15px;  
    width: 48%; 
    background-color: #2c2c2c;
}

.update-column .comic-item {
    display: flex;
    flex-direction: row;
}

.update-column .comic-item .comic-cover {
    width: 75px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
}

.update-column .comic-item .comic-info {
    display: flex;
    flex-direction: column; 
    justify-content: center;
    margin-left: 5px;
    width: 100%;
}

.update-column .comic-item .comic-link .comic-title { 
    font-size: 18px;
    font-weight: bold;
    color: white;
}

.update-column .comic-item .comic-info p { 
    font-size: 16px;
    color: white;
}

.update-column .comic-item .comic-info .comic-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.update-column .comic-item .comic-info .comic-meta .update-time {
    font-size: 14px;
    color: #aaa;
    margin-left: auto;
}
</style>

<?php
include("../users/includes/footer.php");
?>
