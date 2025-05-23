<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-white">Admin Dashboard</h2> 

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white p-3 admin-card" style="background-color: #2c2c2c;">
                <h4>Total Comics</h4>
                <p id="total-comics">Loading...</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white text-black p-3 admin-card">
                <h4>Total Users</h4>
                <p id="total-users">Loading...</p> <!-- Dynamic count here -->
            </div>
        </div>
        <?php
        include("../../dB/config.php");

        $query = "SELECT c.comicId, c.title, c.views
            FROM comics c
            ORDER BY c.views DESC
            LIMIT 1";

        $result = mysqli_query($conn, $query);
        ?>
        <div class="col-md-4">
            <div class="card text-white p-3 admin-card" style="background-color: #2c2c2c;">
                <h4>Most Popular Comic</h4>
                <p>
                <?php 
                if ($popularComic = mysqli_fetch_assoc($result)) {
                    echo htmlspecialchars($popularComic['title']);
                } else {
                    echo "None";
                }
                ?> 
                </p>  
            </div>
        </div>
    </div>

    <!-- Recently Added Comics Table -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Recently Added Comics</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Comic Title</th>
                    <th>Author</th>
                    <th>Artist</th>
                    <th>Genre</th>
                    <th>Theme</th>
                    <th>Cover</th>
                    <th>Read</th>
                </tr>
            </thead>
            <?php
            include("../../dB/config.php");

            $query = "SELECT c.comicId, c.title, au.authorName, ar.artistName, c.cover, c.url,
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
            ?>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='title-cell'>{$row['title']}</td>";
                    echo "<td>{$row['authorName']}</td>";
                    echo "<td>{$row['artistName']}</td>";
                    echo "<td class='genre-cell'>" . (!empty($row['genres']) ? str_replace(',', ', ', $row['genres']) : 'N/A') . "</td>";
                    echo "<td class='theme-cell'>" . (!empty($row['themes']) ? str_replace(',', ', ', $row['themes']) : 'N/A') . "</td>";
                    echo "<td><img src='../../assets/{$row['cover']}' alt='Comic Cover' class='comic-cover'></td>";
                    echo "<td><a href='{$row['url']}' target='_blank' class='btn btn-primary btn-sm'>Click here</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Add Comic -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4 >Add Comic</h4>
        <form action="uploadComic.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control input-button" name="title" placeholder="Title" required>
                </div> 

                <div class="col-md-3"> 
                    <input type="text" class="form-control input-button" id="author" name="author" placeholder="Search or enter an author" onkeyup="searchAuthor(this.value)">
                    <div class="dropdown-menu custom-dropdown-menu" id="author-suggestions"></div>
                </div>

                <div class="col-md-3"> 
                    <input type="text" class="form-control input-button" id="artist" name="artist" placeholder="Search or enter an artist" onkeyup="searchArtist(this.value)">
                    <div class="dropdown-menu custom-dropdown-menu" id="artist-suggestions"></div>
                </div>
                
                <div class="col-md-3"> 
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
                                echo "<label class='dropdown-item'><input type='checkbox' value='$genre' onchange='updateSelected(\"genre\")'> $genre</label>";
                            }
                            ?>
                        </div>
                        <input type="hidden" name="genre" id="selected-genres">
                        <div class="selected-items" id="selected-genre-text">None selected</div>
                    </div>
                </div>

                <div class="col-md-3 mt-2">
                    <label for="theme">Theme</label>
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
                                echo "<label class='dropdown-item'><input type='checkbox' value='$theme' onchange='updateSelected(\"theme\")'> $theme</label>";
                            }
                            ?>
                        </div>
                        <input type="hidden" name="theme" id="selected-themes">
                        <div class="selected-items" id="selected-theme-text">None selected</div>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="contentRating">Content Rating</label>
                    <select class="form-control input-dropdown" name="contentRating" required>
                        <option value="" disabled selected>Select Content Rating</option>
                        <option value="Safe">Safe</option>
                        <option value="Suggestive">Suggestive</option>
                        <option value="Erotica">Erotica</option>
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="publicationStatus">Publication Status</label>
                    <select class="form-control input-dropdown" name="publicationStatus" required>
                        <option value="" disabled selected>Publication Status</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>
                        <option value="Hiatus">Hiatus</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="publicationDate">Publication Date</label>
                    <input type="date" class="form-control input-date" id="publicationDate" name="publicationDate" placeholder="Publication Date"required>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="comicCover">Comic Cover</label>
                    <input type="file" class="form-control input-link" id="comicCover" name="comicCover" required>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="comicUrl">Comic Link</label>
                    <input type="url" class="form-control input-button" id="comicUrl" name="comicUrl" placeholder="Comic URL (e.g., https://readcomic.com)" required>
                </div>
                <div class="col-md-12 mt-3">
                    <label for="synopsis">Synopsis</label>
                    <textarea class="form-control input-button" id="synopsis" name="synopsis" rows="5" placeholder="Enter the comic synopsis here..." required></textarea>
                </div>
                <div class="col-md-3 mt-2">
                    <button type="submit" class="btn btn-warning">Add Comic</button>
                </div>
            </div>
        </form>
    </div>

</div>

<style>
    .title-cell {
        white-space: normal !important;
        word-break: normal;
        overflow-wrap: break-word;
        max-width: 300px;
        padding: 5px;
        hyphens: auto;
    }

    .genre-cell {
        white-space: normal !important;
        word-break: normal;
        overflow-wrap: break-word;
        max-width: 250px; 
        padding: 5px;
        hyphens: auto;
    }

    .theme-cell {
        white-space: normal !important;
        word-break: normal;
        overflow-wrap: break-word;
        max-width: 200px; 
        padding: 5px;
        hyphens: auto;
    }

    .input-button {
        background-color: #2c2c2c; 
        color: white;
        outline: none; 
        border: #FFD700 1px solid;
    }

    .input-button::placeholder {
        color: white;
    }

    .input-button:focus {
        background-color: #2c2c2c; 
        color: white;
    }
    
    .custom-dropdown {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .dropdown-button {
        width: 100%;
        border: #FFD700 1px solid;
        background-color: #2c2c2c;
        color: white;
        text-align: left;
    }

    .custom-dropdown-menu {
        display: none;
        position: absolute;
        background-color: #2c2c2c;
        color: #fff;
        width: 260px;
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

    #author-suggestions .dropdown-item, 
    #artist-suggestions .dropdown-item {
        color: white !important; /* Ensures text is white */
        background-color: #2c2c2c; /* Matches dark theme */
    }

    #author-suggestions .dropdown-item:hover, 
    #artist-suggestions .dropdown-item:hover {
        background-color: #444; /* Slightly lighter for hover effect */
    }

    .input-date {
        background-color: #2c2c2c; 
        color: white;
        outline: none; 
        border: #FFD700 1px solid;
    }

    .input-link {
        background-color: #2c2c2c; 
        color: white;
        outline: none; 
        border: #FFD700 1px solid;
    }
    
    .input-dropdown {
        background-color: #2c2c2c; 
        color: white;
        outline: none; 
        border: #FFD700 1px solid;
    }

    .input-dropdown:focus {
        background-color: #2c2c2c; 
        color: white; 
    }
 
    .comic-cover {
        width: 100px;
        height: 150px;
        object-fit: cover; /* Ensures the image fills the area without distortion */
        border-radius: 2px;  
    }

    .admin-card:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease-in-out;
    }
</style>

<script>
    function searchAuthor(query) {
        if (query.length < 2) return; // Avoid unnecessary queries
        fetch(`searchAuthor.php?q=${query}`)
            .then(response => response.json())
            .then(data => {
                let dropdown = document.getElementById("author-suggestions");
                dropdown.innerHTML = "";
                dropdown.classList.add("show");
                data.forEach(author => {
                    let item = document.createElement("div");
                    item.className = "dropdown-item";
                    item.innerText = author.authorName;
                    item.onclick = () => {
                        document.getElementById("author").value = author.authorName;
                        dropdown.classList.remove("show");
                    };
                    dropdown.appendChild(item);
                });
            });
    }

    function searchArtist(query) {
        if (query.length < 2) return;
        fetch(`searchArtist.php?q=${query}`)
            .then(response => response.json())
            .then(data => {
                let dropdown = document.getElementById("artist-suggestions");
                dropdown.innerHTML = "";
                dropdown.classList.add("show");
                data.forEach(artist => {
                    let item = document.createElement("div");
                    item.className = "dropdown-item";
                    item.innerText = artist.artistName;
                    item.onclick = () => {
                        document.getElementById("artist").value = artist.artistName;
                        dropdown.classList.remove("show");
                    };
                    dropdown.appendChild(item);
                });
            });
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        if (!event.target.closest(".custom-dropdown-menu") && !event.target.closest(".input-button")) {
            document.getElementById("author-suggestions").classList.remove("show");
            document.getElementById("artist-suggestions").classList.remove("show");
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

    function fetchTotalComics() {
        fetch("fetchTotalComics.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("total-comics").innerText = data;
            })
            .catch(error => console.error('Error fetching total comics:', error));
    }

    fetchTotalComics(); // Fetch on page load
    setInterval(fetchTotalComics, 5000); // Refresh every 5 seconds

    function fetchTotalUsers() {
        fetch("fetchTotalUsers.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("total-users").innerText = data;
            })
            .catch(error => console.error('Error fetching total users:', error));
    }

    fetchTotalUsers(); // Fetch on page load
    setInterval(fetchTotalUsers, 5000); // Refresh every 5 seconds
</script>

<?php
include("./includes/footer.php");
?>
