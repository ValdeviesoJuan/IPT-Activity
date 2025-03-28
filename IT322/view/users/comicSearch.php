<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");
include("../../dB/config.php");

$query = isset($_GET['query']) ? trim($_GET['query']) : "";
$comics = [];

if (!empty($query)) {
    $stmt = $conn->prepare("
        SELECT c.comicId, c.title, c.cover, c.url, c.publicationStatus, c.contentRating, c.synopsis,
                GROUP_CONCAT(DISTINCT g.genre ORDER BY g.genre ASC) AS genres,
                GROUP_CONCAT(DISTINCT t.theme ORDER BY t.theme ASC) AS themes
        FROM comics c
        LEFT JOIN comicgenre cg ON c.comicId = cg.comicId
        LEFT JOIN genres g ON cg.genreId = g.genreId
        LEFT JOIN comictheme ct ON c.comicId = ct.comicId
        LEFT JOIN themes t ON ct.themeId = t.themeId
        WHERE c.title LIKE CONCAT('%', ?, '%')
        GROUP BY c.comicId
        ORDER BY c.comicId DESC 
        LIMIT 10
    ");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $row['position'] = stripos($row['title'], $query);
        $comics[] = $row;
    }

    usort($comics, function ($a, $b) {
        return $a['position'] <=> $b['position'];
    });
}
?>

<h2 class="search-title">Search</h2>

<div class="search-container">
    <div class="search-bar">
        <i class="ri-search-line search-icon"></i>
        <input type="text" id="search-input" value="<?php echo htmlspecialchars($query); ?>" placeholder="Search comics..."> 
        <button id="clear-btn" class="clear-btn" onclick="clearSearch()"><i class="ri-close-large-line"></i></button> 
    </div>
</div>

<div class="manga-results">
    <?php if (count($comics) > 0): ?>
        <?php $count = 0; ?>
        <?php foreach ($comics as $comic): ?>
            <?php if ($count % 2 == 0) echo "<div class='manga-row'>"; ?>
            
            <!-- Determine Publication Status Color -->
            <?php 
            $status_colors = [
                'Ongoing' => '#04d000',
                'Hiatus' => 'red',
                'Completed' => '#00c9f5'
            ];
            $status_color = $status_colors[$comic['publicationStatus']] ?? 'gray';

            // Determine Content Rating Color
            $rating_colors = [
                'Safe' => '#f8f9fa',
                'Suggestive' => 'orange',
                'Erotica' => 'red'
            ];
            $rating_color = $rating_colors[$comic['contentRating']] ?? '#ccc';
            ?>

            <div class="manga-card">
                <a href="<?= htmlspecialchars($comic['url']) ?>" target="_blank">
                    <img src="../../assets/<?= htmlspecialchars($comic['cover']) ?>" alt="Comic Cover" class="manga-cover">
                </a>
                <div class="manga-details">
                    <a href="<?= htmlspecialchars($comic['url']) ?>" target="_blank">
                        <h3><?= htmlspecialchars($comic["title"]) ?></h3>
                    </a>

                    <!-- Publication Status -->
                    <div class="status-box">
                        <span class="status-circle" style="background-color: <?= $status_color ?>;"></span>
                        <span class="status-text"><?= htmlspecialchars($comic['publicationStatus']) ?></span>
                    </div>
                    
                    <!-- Content Rating, Genres, and Themes -->
                    <div class="info-row">
                        <span class="rating-box" style="background-color: <?= $rating_color ?>;">
                            <?= htmlspecialchars($comic['contentRating']) ?>
                        </span>

                        <?php  
                        if (!empty($comic['genres'])) {
                            $genresArray = explode(',', $comic['genres']);
                            foreach ($genresArray as $genre) {
                                echo "<span class='genre'>" . htmlspecialchars($genre) . "</span>";
                            }
                        }
         
                        if (!empty($comic['themes'])) {
                            $themesArray = explode(',', $comic['themes']);
                            foreach ($themesArray as $theme) {
                                echo "<span class='theme'>" . htmlspecialchars($theme) . "</span>";
                            }
                        }
                        ?>

                        <p class="synopsis"><?= $comic['synopsis'] ?></p>
                    </div>
                </div>
            </div>

            <?php 
            if ($count % 2 == 1) echo "</div>"; // Close row after two items
            $count++;
            ?>

        <?php endforeach; ?>
        
        <?php if ($count % 2 == 1) echo "</div>"; // Close any unclosed row ?>
    <?php else: ?>
        <div class='no-results-found'> 
            <p>No matching results found.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .search-title {
        font-weight: bold;
        margin: 20px 0;
    }

    .search-container {
        display: flex;
        align-items: center;
        justify-content: space-between;  
        border-radius: 8px;
        width: 100%; 
    }

    .search-container .search-bar {
        position: relative;
        display: flex;
        align-items: center;
        flex-grow: 1;
        background-color: #2c2c2e;  
    }

    .search-container .search-bar .search-icon { 
        padding: 0 15px;
    }

    .search-container .search-bar input {
        flex-grow: 1;
        padding: 8px 30px 8px 10px;
        background: #1e1e20;
        border: none;
        color: white;
        border-radius: 5px;
        background-color: #2c2c2e;  
    }

    .search-container .search-bar input::placeholder {
        color: white;
    }

    .search-container .search-bar input:focus {
        outline-style: solid;
        outline-color: #ffd900;
        outline-width: 1px;
    }

    .search-container .search-bar .clear-btn { 
        position: absolute;
        right: 10px;
        background-color: #ffd900;
        outline: none;
        border-radius: 5px;
        font-size: 18px;
        color: #fff;
        cursor: pointer;
        display: none;
    }

    .search-container .search-btn {
        background: #ff5733;
        border: none;
        padding: 8px 12px;
        color: white;
        background-color: #ffd900;
        cursor: pointer;
        border-radius: 5px;
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
        height: 100%;
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .manga-row {
            flex-direction: column;
        }
        .manga-card {
            max-width: 100%; /* Full width on smaller screens */
        }
    }

    .no-results-found {
        display: flex;  
        padding: 10px 0;
        text-align: center; 
        flex-direction: row; 
        justify-content: center; 
        align-items: center; 
        border-radius: 5px; 
        background-color: #2c2c2c; 
    }
</style>

<script>
    const searchInput = document.getElementById("search-input");
    const clearBtn = document.getElementById("clear-btn");

    searchInput.addEventListener("input", function() {
        if (searchInput.value.trim() !== "") {
            clearBtn.style.display = "block";
        } else {
            clearBtn.style.display = "none";
        }
    });

    function clearSearch() {
        searchInput.value = "";
        clearBtn.style.display = "none";
        searchInput.focus();
    }
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search-input");
        const resultsContainer = document.querySelector(".manga-results");

        searchInput.addEventListener("input", function () {
            const query = searchInput.value.trim();
            
            if (query.length > 0) {
                fetch(`fetchComics.php?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        resultsContainer.innerHTML = "";

                        if (data.length === 0) {
                            resultsContainer.innerHTML = "<p class='no-results-found'>No matching results found.</p>";
                            return;
                        }

                        let row;
                        data.forEach((comic, index) => {
                            if (index % 2 === 0) {
                                row = document.createElement("div");
                                row.classList.add("manga-row");
                                resultsContainer.appendChild(row);
                            }

                            const statusColors = {
                                'Ongoing': '#04d000',
                                'Hiatus': 'red',
                                'Completed': '#00c9f5'
                            };
                            const ratingColors = {
                                'Safe': '#f8f9fa',
                                'Suggestive': 'orange',
                                'Erotica': 'red'
                            };

                            const comicCard = document.createElement("div");
                            comicCard.classList.add("manga-card");

                            comicCard.innerHTML = `
                                <a href="${comic.url}" target="_blank">
                                    <img src="../../assets/${comic.cover}" alt="Comic Cover" class="manga-cover">
                                </a>
                                <div class="manga-details">
                                    <a href="${comic.url}" target="_blank">
                                        <h3>${comic.title}</h3>
                                    </a>
                                    <div class="status-box">
                                        <span class="status-circle" style="background-color: ${statusColors[comic.publicationStatus] || 'gray'};"></span>
                                        <span class="status-text">${comic.publicationStatus}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="rating-box" style="background-color: ${ratingColors[comic.contentRating] || '#ccc'};">
                                            ${comic.contentRating}
                                        </span>
                                        ${comic.genres.map(genre => `<span class='genre'>${genre}</span>`).join('')}
                                        ${comic.themes.map(theme => `<span class='theme'>${theme}</span>`).join('')}
                                    </div>
                                    <p class="synopsis">${comic.synopsis}</p>
                                </div>
                            `;

                            row.appendChild(comicCard);
                        });
                    })
                    .catch(error => console.error("Error fetching comics:", error));
            } else {
                resultsContainer.innerHTML = "<p class='no-results-found'>No matching results found.</p>";
                return;
            }
        });
    });
</script>

<?php
include("../users/includes/footer.php");
?>