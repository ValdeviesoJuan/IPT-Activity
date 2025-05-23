<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");
?>

<h2 class="search-title">Advanced Search</h2>

<div class="search-container">
    <div class="search-bar">
        <i class="ri-search-line search-icon"></i>
        <input type="text" id="search-input" placeholder="Search"> 
        <button id="clear-btn" class="clear-btn" onclick="clearSearch()"><i class="ri-close-large-line"></i></button> 
    </div>
    <button class="filter-btn" id="toggle-filters">
        <i class="ri-arrow-down-s-line filter-icon"></i>Show filters
    </button>
</div>

<!-- Filter Dropdowns (Initially Hidden) -->
<div class="filter-container">
    <div class="row">
        <div class="filter-dropdown" id="filterSortBy">
            <h3>Sort By</h3>
            <select id="sortBy">
                <option value="">Any</option>
                <option value="Latest Upload">Latest Upload</option>
                <option value="Oldest Upload">Oldest Upload</option>
                <option value="Title Ascending">Title Ascending</option>
                <option value="Title Descending">Title Descending</option>
                <option value="Recently Added">Recently Added</option>
                <option value="Oldest Added">Oldest Added</option>
                <option value="Year Ascending">Year Ascending</option>
                <option value="Year Descending">Year Descending</option>
            </select>
        </div>
        <div class="filter-dropdown" id="filterGenre">
            <h3>Filter Genre</h3>
            <div class="custom-dropdown">
                <button type="button" class="btn dropdown-toggle dropdown-button" onclick="toggleDropdown('genre-dropdown')">Select Genres</button>
                <div class="dropdown-menu custom-dropdown-menu" id="genre-dropdown">
                    <?php
                    $genres = [
                        "Action", "Adventure", "Boys' Love", "Comedy", "Crime", "Drama", "Fantasy", "Girls' Love", "Historical",
                        "Horror", "Isekai", "Magical Girls", "Mecha", "Medical", "Mystery", "Philosophical", "Psychological",
                        "Romance", "Sci-Fi", "Slice of Life", "Sports", "Superhero", "Thriller", "Tragedy", "Wuxia"
                    ];
                    foreach ($genres as $genre) {
                        echo "<label class='dropdown-item'><input type='checkbox' name='genres[]' value='$genre' onchange='updateSelected(\"genre\")'>$genre</label>";
                    }
                    ?>
                </div>  
                <input type="hidden" name="genre" id="selected-genres" value="">
                <div class="selected-items" id="selected-genre-text">None selected</div>
            </div>
        </div>
        <div class="filter-dropdown" id="filterTheme">
            <h3>Filter Theme</h3> 
            <div class="custom-dropdown">
                <button type="button" class="btn dropdown-toggle dropdown-button" onclick="toggleDropdown('theme-dropdown')">Select Themes</button>
                <div class="dropdown-menu custom-dropdown-menu" id="theme-dropdown">
                    <?php
                    $themes = [
                        "Aliens", "Animals", "Cooking", "Crossdressing", "Delinquents", "Demons", "Genderswap", "Ghosts",
                        "Gyaru", "Harem", "Incest", "Loli", "Mafia", "Magic", "Martial Arts", "Military", "Monster Girls",
                        "Monsters", "Music", "Ninja", "Office Workers", "Police", "Post-Apocalyptic", "Reincarnation",
                        "Reverse Harem", "Samurai", "School Life", "Shota", "Supernatural", "Survival", "Time Travel",
                        "Traditional Games", "Vampires", "Video Games", "Villainess", "Virtual Reality", "Zombies"
                    ];
                    foreach ($themes as $theme) {
                        echo "<label class='dropdown-item'><input type='checkbox' name='themes[]' value='$theme' onchange='updateSelected(\"theme\")'> $theme</label>";
                    }
                    ?>
                </div>
                <input type="hidden" name="theme" id="selected-themes">
                <div class="selected-items" id="selected-theme-text">None selected</div>
            </div>
        </div>
        <div class="filter-dropdown" id="filterContentRating">
            <h3>Filter Content Rating</h3>
            <select id="contentRatingSelect">
                <option value="">Any</option>
                <option value="Safe">Safe</option>
                <option value="Suggestive">Suggestive</option>
                <option value="Erotica">Mature</option>
            </select>
        </div>
    </div>
        
    <div class="row">
        <div class="filter-dropdown" id="filterPublicationDate">
            <h3 for="publicationYear">Publication Year</h3>
            <input type="text" id="publicationYear" name="publicationYear" placeholder="Any" maxlength="4">
        </div> 
        <div class="filter-dropdown" id="filterPublicationStatus">
            <h3>Filter Publication Status</h3>
            <select id="publicationStatusSelect">
                <option value="">Any</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Hiatus">Hiatus</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <div class="filter-dropdown" id="filterAuthor">
            <h3>Filter Author</h3>
            <input type="text" id="authorInput" placeholder="Enter author name">
        </div>
        <div class="filter-dropdown" id="filterArtist">
            <h3>Filter Artist</h3>
            <input type="text" id="artistInput" placeholder="Enter artist name">
        </div>
    </div>
</div>

<!-- Search and Reset Filter buttons -->
<div class="search-actions">
    <button class="reset-btn" onclick="resetFilters()">
        Reset Filter
    </button>
    <button class="search-btn" id="search-btn">
        <i class="ri-search-line search-icon"></i>Search
    </button>
</div>

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
            'Hiatus' => 'yellow',
            'Completed' => '#00c9f5',
            'Cancelled' => 'red',
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
            <a href="<?= $row['url'] ?>" target="_blank">
                <h3><?= $row["title"] ?></h3>
            </a>

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

    .search-container .filter-btn {
        text-decoration: none;
        border: none;
        margin-left: 10px;
        background-color: #4f4f4f;
        padding: 2px 12px;
        color: white;
        cursor: pointer;
        border-radius: 5px;   
        display: flex;
        align-items: center; 
        gap: 5px;  
    }

    .search-container .filter-btn.active {
        background-color: #ffd900; 
        color: #fff; 
    }

    .search-container .filter-icon {
        margin-right: 15px;
        color: #fff;
        font-size: 24px;
        padding: 0; 
    }

    .filter-container {
        max-height: 0; 
        overflow: hidden;  
        transition: max-height 0.15s ease-out, padding 0.15s ease-out;
        padding: 0 10px; 
    }

    .filter-container.show {
        max-height: 500px;  
        padding: 10px; 
    }

    /* Row layout for filters */
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
    }

    /* Filter dropdown styles */
    .filter-dropdown {
        flex: 1 1 calc(25% - 10px); /* Each dropdown takes 25% width with spacing */
        max-width: calc(25% - 10px);
        background: #191a1c;
        color: white;
        border-radius: 5px;
        padding: 10px;
        transition: max-height 0.3s ease-out, padding 0.3s ease-out;
    }

    /* Titles inside filter dropdowns */
    .filter-dropdown h3 {
        margin: 5px 0;
        font-size: 16px;
        color: #8a8a8a;
    }

    /* Select dropdown styles */
    .filter-dropdown select,
    .filter-dropdown input {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: none;
        background: #2c2c2e;
        color: #8a8a8a;
    }

    /* Focus outline for inputs & select */
    .filter-dropdown select:focus,
    .filter-dropdown input:focus {
        outline-style: solid;
        outline-color: #ffd900;
        outline-width: 2px;
    }

    /* Show filters when active */
    .filter-dropdown.show {
        max-height: 200px;
        margin-bottom: 20px;
    } 
    
    /* Responsive behavior */
    @media (max-width: 1024px) {
        .filter-dropdown {
            flex: 1 1 calc(50% - 10px); /* Two per row on medium screens */
            max-width: calc(50% - 10px);
        }
    }

    @media (max-width: 768px) {
        .filter-dropdown {
            flex: 1 1 100%; /* One per row on small screens */
            max-width: 100%;
        }
    }

    .search-actions {
        display: flex;
        justify-content: flex-end; 
        gap: 20px;
        margin-top: 30px;
    }

    .search-actions .search-btn {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        font-weight: bold;
        justify-content: space-between;
    }

    .search-actions .search-btn {
        background-color: #ffd900;
    }

    .search-actions .search-icon {
        margin-right: 15px;
        font-size: 16px;
    }

    .search-actions .reset-btn {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        font-weight: bold;
        justify-content: space-between;
    }
    
    .search-actions .reset-btn {
        background-color:#532f38;
        color: #ff4040;
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
        height: 250px;
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

    .custom-dropdown {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .dropdown-button {
        width: 100%; 
        background-color: #2c2c2c;
        color: white;
        text-align: left;
    }

    .dropdown-button:focus { 
        border: #FFD700 2px solid; 
    }

    .custom-dropdown-menu {
        display: none;
        position: absolute;
        background-color: #2c2c2c;
        color: #fff;
        width: 100%;
        border: 1px solid #FFD700;
        z-index: 1000;
        max-height: 200px;
        overflow-y: auto;
    }

    .custom-dropdown-menu.show {
        display: block;
        color: white;
    }

    .custom-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        padding: 5px 10px;
        color: white;
    }

    .custom-dropdown .dropdown-item input {
        margin-right: 8px;
    }

    .selected-items {
        margin-top: 5px;
        font-size: 0.9em;
        color: #FFD700;
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

    document.getElementById("toggle-filters").addEventListener("click", function () {
        let filterContainer = document.querySelector(".filter-container");

        filterContainer.classList.toggle("show"); 
        this.classList.toggle("active");

        if (filterContainer.classList.contains("show")) {
            this.innerHTML = '<i class="ri-arrow-up-s-line filter-icon"></i>Hide filters';
        } else {
            this.innerHTML = '<i class="ri-arrow-down-s-line filter-icon"></i>Show filters';
        } 
    });
    
    //Genre and Theme
    function toggleDropdown(id) {
        let dropdown = document.getElementById(id);
        dropdown.classList.toggle("show");
    }

    // Prevent closing when clicking inside the dropdown
    document.addEventListener("click", function(event) {
        let dropdowns = document.querySelectorAll(".custom-dropdown-menu");
        let buttons = document.querySelectorAll(".dropdown-toggle");

        let isDropdownItem = event.target.closest(".custom-dropdown-menu");
        let isDropdownButton = event.target.closest(".dropdown-toggle");

        // Only close if clicking outside both dropdown and button
        if (!isDropdownItem && !isDropdownButton) {
            dropdowns.forEach(dropdown => dropdown.classList.remove("show"));
        }
    });

    // Update selected checkboxes
    function updateSelected(type) {
        let checkboxes = document.querySelectorAll(`#${type}-dropdown input[type="checkbox"]:checked`);
        let selectedValues = Array.from(checkboxes).map(cb => cb.value);
        
        // Update hidden input field
        document.getElementById(`selected-${type}s`).value = selectedValues.join(", ");

        // Show selected items
        document.getElementById(`selected-${type}-text`).innerText = selectedValues.length ? selectedValues.join(", ") : "None selected";
    }

    // Remove non-numeric characters
    document.getElementById("publicationYear").addEventListener("input", function (e) {
        this.value = this.value.replace(/\D/g, ""); 
    });

    document.addEventListener("DOMContentLoaded", function () {
        const sortBy = document.getElementById("sortBy");  
        const contentRatingSelect = document.getElementById("contentRatingSelect");
        const publicationYear = document.getElementById("publicationYear");
        const publicationStatusSelect = document.getElementById("publicationStatusSelect"); 
        const authorInput = document.getElementById("authorInput");
        const artistInput = document.getElementById("artistInput");
        const resetBtn = document.querySelector(".reset-btn");

        function areGenresChecked() {
            return document.querySelectorAll('input[name="genres[]"]:checked').length > 0;
        }

        function areThemesChecked() {
            return document.querySelectorAll('input[name="themes[]"]:checked').length > 0;
        }

        // Function to check and disable Reset Filter button if "None" is selected
        function checkResetButton() {
            if (sortBy.value === "" && !areGenresChecked() && !areThemesChecked() && contentRatingSelect.value === "" && 
                publicationYear.value === "" && publicationStatusSelect.value === "" && authorInput.value === "" && artistInput.value === "") {

                resetBtn.disabled = true;
                resetBtn.style.opacity = "0.5"; // Visually indicate disabled state
                resetBtn.style.cursor = "not-allowed";
            } else {
                resetBtn.disabled = false;
                resetBtn.style.opacity = "1";
                resetBtn.style.cursor = "pointer";
            }
        }
        
        // Event listeners for changes
        [sortBy, contentRatingSelect, publicationYear, publicationStatusSelect, authorInput, artistInput]
        .forEach(element => {
            element.addEventListener("change", checkResetButton);
        });

        document.querySelectorAll('input[name="genres[]"]').forEach(checkbox => {
            checkbox.addEventListener("change", checkResetButton);
        });

        document.querySelectorAll('input[name="themes[]"]').forEach(checkbox => {
            checkbox.addEventListener("change", checkResetButton);
        });

        // Function to reset the filter
        function resetFilters() { 
            sortBy.value = ""; 
            contentRatingSelect.value = "";
            publicationYear.value = "";
            publicationStatusSelect.value = "";
            authorInput.value = "";
            artistInput.value = "";

            // Reset checkboxes for genres
            document.querySelectorAll('input[name="genres[]"]').forEach(checkbox => checkbox.checked = false);

            // Reset checkboxes for themes
            document.querySelectorAll('input[name="themes[]"]').forEach(checkbox => checkbox.checked = false);

            // Reset hidden input field and displayed selected genres
            document.getElementById("selected-genres").value = "";
            document.getElementById("selected-genre-text").innerText = "None selected";

            // Reset hidden input field and displayed selected themes
            document.getElementById("selected-themes").value = "";
            document.getElementById("selected-theme-text").innerText = "None selected";

            checkResetButton();
        }

        // Attach reset function to Reset Filter button
        resetBtn.addEventListener("click", resetFilters);

        // Initial check on page load
        checkResetButton();
    });
    document.getElementById("search-btn").addEventListener("click", function () {
        let search = document.getElementById("search-input").value;
        let sortBy = document.getElementById("sortBy").value;
        let genres = [...document.querySelectorAll('input[name="genres[]"]:checked')].map(el => el.value);
        let themes = [...document.querySelectorAll('input[name="themes[]"]:checked')].map(el => el.value);
        let contentRating = document.getElementById("contentRatingSelect").value;
        let publicationYear = document.getElementById("publicationYear").value;
        let publicationStatus = document.getElementById("publicationStatusSelect").value;
        let author = document.getElementById("authorInput").value;
        let artist = document.getElementById("artistInput").value;

        let formData = new FormData();
        formData.append("search", search);
        formData.append("sortBy", sortBy);
        formData.append("contentRating", contentRating);
        formData.append("publicationYear", publicationYear);
        formData.append("publicationStatus", publicationStatus);
        formData.append("author", author);
        formData.append("artist", artist);
        
        genres.forEach(genre => formData.append("genres[]", genre));
        themes.forEach(theme => formData.append("themes[]", theme));

        fetch("./search.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.querySelector(".manga-results").innerHTML = data;
        })
        .catch(error => console.error("Error:", error));
    });
</script>
<?php
include("../users/includes/footer.php");
?>
