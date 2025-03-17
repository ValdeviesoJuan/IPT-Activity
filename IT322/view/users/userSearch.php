<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");
?>

<h2 class="search-title">Advanced Search</h2>

<div class="search-container">
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search">
        <button id="clear-btn" class="clear-btn" onclick="clearSearch()"><i class="ri-close-large-line"></i></button> 
    </div>
    <button class="filter-btn" id="toggle-filters">
        <i class="ri-arrow-down-s-line filter-icon"></i>Show filters
    </button>
</div>

<!-- Filter Dropdown (Initially Hidden) -->
<div class="filter-dropdown" id="filterDropdown">
    <h3>Filter Genre:</h3>
    <select id="genreSelect">
        <option value="">None</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Comedy">Comedy</option>
        <option value="Drama">Drama</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Horror">Horror</option>
        <option value="Mystery">Mystery</option>
        <option value="Sci-Fi">Sci-Fi</option>
        <option value="Superhero">Superhero</option>
        <option value="Thriller">Thriller</option>
    </select>
</div>

<!-- Search and Reset Filter buttons -->
<div class="search-actions">
    <button class="reset-btn" onclick="resetFilters()">Reset Filter</button>
    <button class="search-btn"><i class="ri-search-line search-icon"></i>Search</button>
</div>

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

    .search-container .search-bar input {
        flex-grow: 1;
        padding: 8px 30px 8px 10px;
        background: #1e1e20;
        border: none;
        color: white;
        border-radius: 5px;
        background-color: #2c2c2e;  
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

    .filter-dropdown {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        background: #191a1c;
        color: white; 
        border-radius: 5px;
        margin: 10px 0 20px 0; 
    }

    .filter-dropdown h3 {
        margin: 10px 0;
        font-size: 16px;
        color: #74849e;
    }

    .filter-dropdown select {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: none;
        background: #2c2c2e;
        color: #74849e;
    }

    .filter-dropdown select:focus {
        outline-style: solid;
        outline-color: #ffd900;
        outline-width: 2px;
    }
 
    .filter-dropdown.show {
        max-height: 200px; 
    }

    .search-actions {
        display: flex;
        justify-content: flex-end; 
        gap: 20px;
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

    .search-actions .search-btn {
        background-color: #ffd900;
    }

    .search-actions .search-icon {
        margin-right: 15px;
        font-size: 16px;
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

    document.getElementById("toggle-filters").addEventListener("click", function() {
        let filterDropdown = document.getElementById("filterDropdown");
        filterDropdown.classList.toggle("show");

        this.classList.toggle("active");
        if (this.classList.contains("active")) {
            this.innerHTML = '<i class="ri-arrow-up-s-line filter-icon"></i>Hide filters';
        } else {
            this.innerHTML = '<i class="ri-arrow-down-s-line filter-icon"></i>Show filters';
        } 
    });

    document.addEventListener("DOMContentLoaded", function () {
        const genreSelect = document.getElementById("genreSelect");
        const resetBtn = document.querySelector(".reset-btn");

        // Function to check and disable Reset Filter button if "None" is selected
        function checkResetButton() {
            if (genreSelect.value === "") {
                resetBtn.disabled = true;
                resetBtn.style.opacity = "0.5"; // Visually indicate disabled state
                resetBtn.style.cursor = "not-allowed";
            } else {
                resetBtn.disabled = false;
                resetBtn.style.opacity = "1";
                resetBtn.style.cursor = "pointer";
            }
        }

        // Event listener for genre selection change
        genreSelect.addEventListener("change", function () {
            checkResetButton();
        });

        // Function to reset the filter
        function resetFilters() {
            genreSelect.value = ""; // Reset dropdown to "None"
            checkResetButton();
        }

        // Attach reset function to Reset Filter button
        resetBtn.addEventListener("click", resetFilters);

        // Initial check on page load
        checkResetButton();
    });
</script>
<?php
include("../users/includes/footer.php");
?>
