<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
include("../../dB/config.php"); // Connect to database
?>

<div class="container mt-4">
    <h2 class="text-black">Manage Comics</h2>

    <!-- Search & Filters -->
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Search comics..." style="max-width: 300px; display: inline-block;">
        <select class="form-control" style="max-width: 200px; display: inline-block;">
            <option value="">Filter by Genre</option>
            <option value="Action">Action</option>
            <option value="Fantasy">Fantasy</option>
        </select>
        <button class="btn btn-primary">Search</button>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all comics from the database
                $query = "SELECT * FROM comics ORDER BY id DESC";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><input type='checkbox'></td>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['author']}</td>";
                        echo "<td>{$row['genre']}</td>";
                        echo "<td><img src='{$row['cover']}' alt='Comic Cover' 
                            style='width: 80px; height: 120px; object-fit: cover; border-radius: 5px; border: 2px solid white; box-shadow: 2px 2px 5px rgba(255,255,255,0.2);'></td>";
                        echo "<td>
                                <a href='edit_comic.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_comic.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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

<?php
include("./includes/footer.php");
?>
