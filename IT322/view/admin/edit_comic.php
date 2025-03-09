<?php
include("../../dB/config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM comics WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $comic = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $url = $_POST['comic_url'];

    $sql = "UPDATE comics SET title='$title', author='$author', genre='$genre', url='$url' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: manageComics.php?update=success");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comic - Manage Comics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="../../assets/img/Logo2.png" rel="icon">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <div class="card bg-secondary text-white p-4 shadow-lg rounded">
            <h2 class="text-center">Edit Comic</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $comic['title']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author:</label>
                    <input type="text" name="author" class="form-control" value="<?php echo $comic['author']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre:</label>
                    <select name="genre" class="form-select" required>
                        <option value="Action" <?php echo ($comic['genre'] == 'Action') ? 'selected' : ''; ?>>Action</option>
                        <option value="Fantasy" <?php echo ($comic['genre'] == 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                        <option value="Sci-Fi" <?php echo ($comic['genre'] == 'Sci-Fi') ? 'selected' : ''; ?>>Sci-Fi</option>
                        <option value="Horror" <?php echo ($comic['genre'] == 'Horror') ? 'selected' : ''; ?>>Horror</option>
                        <option value="Romance" <?php echo ($comic['genre'] == 'Romance') ? 'selected' : ''; ?>>Romance</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comic URL:</label>
                    <input type="url" name="comic_url" class="form-control" value="<?php echo $comic['url']; ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="manage_comics.php" class="btn btn-outline-light">← Back to Comics</a>
                    <button type="submit" class="btn btn-primary">Update Comic</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
