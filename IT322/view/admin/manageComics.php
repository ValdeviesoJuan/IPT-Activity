<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
include("../../dB/config.php"); // Connect to database

// Search & Filter Logic
$searchQuery = isset($_GET['search']) ? $_GET['search'] : "";
$filterGenre = isset($_GET['genre']) ? $_GET['genre'] : "";

// Base Query to Fetch Comics with Genres and Themes
$query="SELECT c.comicId, c.title, au.authorName, ar.artistName, c.cover, c.url,
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
        WHERE 1";

// Apply Search Filter
if (!empty($searchQuery)) {
    $query .= " AND (c.title LIKE '%$searchQuery%' OR au.authorName LIKE '%$searchQuery%')";
}

// Apply Genre Filter
if (!empty($filterGenre)) {
    $query .= " AND g.genre = '$filterGenre'";
}

$query .= " GROUP BY c.comicId ORDER BY c.comicId DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h2 class="text-white">Manage Comics</h2>

    <!-- Search & Filters -->
    <div class="mb-3">
        <form method="GET" action="">
            <input type="text" class="form-control" name="search" placeholder="Search comics..."
                value="<?php echo htmlspecialchars($searchQuery); ?>" style="max-width: 300px; display: inline-block;">

            <select class="form-control" name="genre" style="max-width: 200px; display: inline-block;">
                <option value="">Filter by Genre</option>
                <?php
                $genreQuery = "SELECT genre FROM genres ORDER BY genre ASC";
                $genreResult = mysqli_query($conn, $genreQuery);
                while ($genreRow = mysqli_fetch_assoc($genreResult)) {
                    $selected = ($filterGenre == $genreRow['genre']) ? 'selected' : '';
                    echo "<option value='{$genreRow['genre']}' $selected>{$genreRow['genre']}</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Comics Table -->
    <div class="card bg-dark text-white p-3">
        <h4>Comic List</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Comic Title</th>
                    <th>Author</th>
                    <th>Artist</th>
                    <th>Genre</th>
                    <th>Theme</th>
                    <th>Cover</th>
                    <th>Read</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><input type='checkbox'></td>";
                        echo "<td style='max-width: 200px;'>{$row['title']}</td>";
                        echo "<td>{$row['authorName']}</td>";
                        echo "<td>{$row['artistName']}</td>";
                        echo "<td style='max-width: 150px;'>" . (!empty($row['genres']) ? $row['genres'] : 'N/A') . "</td>";
                        echo "<td style='max-width: 100px;'>" . (!empty($row['themes']) ? $row['themes'] : 'N/A') . "</td>";
                        echo "<td><img src='../../assets/{$row['cover']}' alt='Comic Cover' 
                            style='width: 80px; height: 120px; object-fit: cover; border-radius: 5px; border: 2px solid white;'></td>";
                        echo "<td><a href='{$row['url']}' target='_blank' class='btn btn-primary btn-sm'>Read Here</a></td>";
                        echo "<td>
                                <a href='editComic.php?id={$row['comicId']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='deleteComic.php?id={$row['comicId']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this comic?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No comics found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("./includes/footer.php"); ?>
