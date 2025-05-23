<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");
?>

<!-- Recently Added Comics Section -->
<h2 class="mb-4" style="font-weight: bold; margin: 20px 0;">Recently Added</h2>
<div class="recently-added-container">
    <div class="recently-added">
        <?php
        include("../../dB/config.php");

        $query = "SELECT * FROM comics ORDER BY createdAt DESC LIMIT 10"; // Adjust limit as needed
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $titleEscaped = htmlspecialchars($row['title'], ENT_QUOTES);
                $coverEscaped = htmlspecialchars($row['cover'], ENT_QUOTES);
                echo "<div class='comic-item'>";
                    echo "<a href='{$row['url']}' target='_blank'>";
                        echo "<img src='../../assets/{$row['cover']}' alt='Comic Cover' class='comic-cover'>";
                    echo "</a>";
                    echo "<a href='{$row['url']}' target='_blank'>{$row["title"]}</a>";
                    echo "<button class='add-library-btn' onclick='openModal({$row['comicId']}, \"{$titleEscaped}\", \"{$coverEscaped}\")'>";
                        echo "</i> <i class='ri-bookmark-line'></i>Add to Library";
                    echo "</button>";
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
                        echo "<img src='../../assets/{$comic['cover']}' alt='Comic Cover' class='comic-cover'>";
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

<!-- Modal -->
<div id="libraryModal" class="library-modal">
  <div class="modal-content">
    <h5>Add to Library</h5>
    <div class="library-comic-info">
        <img id="modalComicCover" src="" class="library-comic-cover" alt="Comic Cover">
        <div class="library-comic-text">
            <div class="library-comic-title">
                <h1 id="modalComicTitle">Comic Title</h1>
            </div>
            <label class="status-label" for="readingStatus">Reading Status</label>
            <select id="readingStatus" class="status-dropdown">
                <option value="Reading">Reading</option>
                <option value="On Hold">On Hold</option>
                <option value="Dropped">Dropped</option>
                <option value="Plan to Read">Plan to Read</option>
                <option value="Completed">Completed</option>
                <option value="Re-reading">Re-reading</option>
            </select>
        </div>
    </div>
    <div class="library-comic-buttons">
        <button onclick="closeModal()" class="cancel-btn">Cancel</button>
        <button onclick="addToLibrary()" class="add-btn">Add</button>
    </div>
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
    min-width: 150px; 
    margin-right: 25px;
    cursor: pointer;
    color: #fff; 
}

.recently-added .comic-item a {
    margin-top: 5px;
    font-size: 18px;
    color: #fff;
    font-weight: bold;
    word-wrap: break-word; 
    white-space: normal;  
    max-width: 120px; 
    overflow-wrap: break-word; 
    text-decoration: none;
    cursor: pointer;
}

.recently-added .comic-item a:hover {
    text-decoration: underline ;
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

.recently-added .comic-item .add-library-btn {
    margin-top: 5px;
    width: 150px;
    background-color: #444;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    gap: 5px;
    align-items: center;
}

.recently-added .comic-item .add-library-btn:hover {
    background-color: #666;
}

.library-modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
}

.modal-content {
    background-color: #2c2c2c;
    margin: 10% auto;
    padding: 20px;
    width: 600px;
    color: white;
    border-radius: 8px;
    text-align: center;
}

.library-modal .modal-content h5 {
    display: flex;
    justify-content: baseline;
    margin-bottom: 25px;
}

.library-comic-info {
    display: flex;
    flex-direction: row;
}

.library-comic-cover {
    width: 200px;
    height: 300px;
    object-fit: cover; 
    border-radius: 5px;   
    margin-right: 15px;
    margin-bottom: 15px;
}

.library-comic-title h1{
    text-align: start;
    font-weight: bold;
    font-size: 24px;
}

.status-label {
    display: flex;
    justify-content: baseline;
    font-weight: bold;
}

.status-dropdown {
    display: flex;
    justify-content: baseline;
    width: 250px;
    padding: 8px;
    margin: 15px 0;
    border-radius: 4px;
    border: none;
    outline: none;
}

.library-comic-buttons {
    display: flex;
    justify-content:end;
}

.cancel-btn, .add-btn {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 150px;
}

.library-comic-buttons {
    gap: 15px;
}

.cancel-btn {
    background-color: #555;
    color: white;
}

.add-btn {
    background-color: #FFEB3B;
    color: white;
}
</style>

<script>
    let selectedComicId = null;

    function openModal(comicId, title, cover) {
        selectedComicId = comicId;
        document.getElementById("modalComicTitle").innerText = title;
        document.getElementById("modalComicCover").src = "../../assets/" + cover;
        document.getElementById("libraryModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("libraryModal").style.display = "none";
    }

    function addToLibrary() {
        const status = document.getElementById("readingStatus").value;

        fetch('../../controller/addToLibrary.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                comicId: selectedComicId,
                readStatus: status
            })
        })
        .then(response => response.json())
        .then(data => { 
            console.log(data);
            closeModal();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Something went wrong!", error);
            closeModal();
        });
    }

    // Optional: Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById("libraryModal");
        if (event.target == modal) {
        closeModal();
        }
    }
</script>

<?php
include("../users/includes/footer.php");
?>
