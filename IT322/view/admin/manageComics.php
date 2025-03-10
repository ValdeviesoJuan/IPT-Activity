<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
include("../../dB/config.php"); // Connect to database

// Search & Filter Logic
$searchQuery = isset($_GET['search']) ? $_GET['search'] : "";
$filterGenre = isset($_GET['genre']) ? $_GET['genre'] : "";

// Build the query dynamically
$query = "SELECT * FROM comics WHERE 1";

if (!empty($searchQuery)) {
    $query .= " AND (title LIKE '%$searchQuery%' OR author LIKE '%$searchQuery%')";
}
if (!empty($filterGenre)) {
    $query .= " AND genre = '$filterGenre'";
}

$query .= " ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h2 class="text-black">Manage Comics</h2>

    <!-- Search & Filters -->
    <div class="mb-3">
        <form method="GET" action="">
            <input type="text" class="form-control" name="search" placeholder="Search comics..."
                value="<?php echo $searchQuery; ?>" style="max-width: 300px; display: inline-block;">

            <select class="form-control" name="genre" style="max-width: 200px; display: inline-block;">
                <option value="">Filter by Genre</option>
                <option value="Action" <?php echo ($filterGenre == 'Action') ? 'selected' : ''; ?>>Action</option>
                <option value="Fantasy" <?php echo ($filterGenre == 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                <option value="Sci-Fi" <?php echo ($filterGenre == 'Sci-Fi') ? 'selected' : ''; ?>>Sci-Fi</option>
                <option value="Horror" <?php echo ($filterGenre == 'Horror') ? 'selected' : ''; ?>>Horror</option>
                <option value="Romance" <?php echo ($filterGenre == 'Romance') ? 'selected' : ''; ?>>Romance</option>
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
                    <th>Genre</th>
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
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['author']}</td>";
                        echo "<td>{$row['genre']}</td>";
                        echo "<td><img src='{$row['cover']}' alt='Comic Cover' 
                            style='width: 80px; height: 120px; object-fit: cover; border-radius: 5px; border: 2px solid white;'></td>";
                        echo "<td><a href='{$row['url']}' target='_blank' class='btn btn-primary btn-sm'>Read Here</a></td>";
                        echo "<td>
                                <a href='editComic.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='deleteComic.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this comic?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No comics found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("./includes/footer.php"); ?>
