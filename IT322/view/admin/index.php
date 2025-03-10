<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">Admin Dashboard</h2>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white p-3" style="background-color: #2c2c2c;">
                <h4>Total Comics</h4>
                <p id="total-comics">Loading...</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white text-black p-3">
                <h4>Total Users</h4>
                <p id="total-users">Loading...</p> <!-- Dynamic count here -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white p-3" style="background-color: #2c2c2c;">
                <h4>Most Popular Comic</h4>
                <p>Spider-Man</p> <!-- Replace with dynamic data -->
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
                    <th>Genre</th>
                    <th>Cover</th>
                    <th>Read</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../../dB/config.php");

                $query = "SELECT * FROM comics ORDER BY id DESC LIMIT 5";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['title']}</td>";
                    echo "<td>{$row['author']}</td>";
                    echo "<td>{$row['genre']}</td>";
                    echo "<td><img src='{$row['cover']}' alt='Comic Cover' class='comic-cover'></td>";
                    echo "<td><a href='{$row['url']}' target='_blank' class='btn btn-primary btn-sm'>Click here</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Quick Add Comic -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Quick Add Comic</h4>
        <form action="upload_comic.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="author" placeholder="Author" required>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="genre" required>
                        <option value="" disabled selected>Select Genre</option>
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
                <div class="col-md-3">
                    <input type="file" class="form-control" name="comic_cover" required>
                </div>
                <div class="col-md-3 mt-2">
                    <input type="url" class="form-control" name="comic_url" placeholder="Comic URL (e.g., https://readcomic.com)" required>
                </div>
                <div class="col-md-3 mt-2">
                    <button type="submit" class="btn btn-warning">Add Comic</button>
                </div>
            </div>
        </form>
    </div>


</div>

<style>
    /* Ensures all comic covers have a uniform size */
    .comic-cover {
        width: 100px;
        height: 150px;
        object-fit: cover; /* Ensures the image fills the area without distortion */
        border-radius: 5px; /* Optional: rounded corners */
        border: 2px solid white; /* Optional: add a border for styling */
    }
</style>

<script>
    function fetchTotalComics() {
        fetch("fetch_total_comics.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("total-comics").innerText = data;
            })
            .catch(error => console.error('Error fetching total comics:', error));
    }

    fetchTotalComics(); // Fetch on page load
    setInterval(fetchTotalComics, 5000); // Refresh every 5 seconds

    function fetchTotalUsers() {
        fetch("fetch_total_users.php")
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
