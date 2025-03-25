<?php
include("../../dB/config.php");

if (isset($_GET['id'])) {
    $comicId = $_GET['id'];
    $query = "SELECT comicId, title, synopsis, url, cover, publicationDate, publicationStatus, contentRating, createdAt, updatedAt FROM comics WHERE comicId = $comicId";
    $result = mysqli_query($conn, $query);
    $comic = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $synopsis = $_POST['synopsis'];
    $url = $_POST['comic_url'];
    $publicationDate = $_POST['publicationDate'];
    $publicationStatus = $_POST['publicationStatus'];
    $contentRating = $_POST['contentRating'];
    $updatedAt = date("Y-m-d H:i:s");

    // Handle file upload
    $cover = $comic['cover']; // Default to existing cover
    if (!empty($_FILES['cover']['name'])) {
        $targetDir = "../../assets/uploads/";
        $targetFile = $targetDir . basename($_FILES['cover']['name']);
        if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
            $cover = $targetFile;
        } else {
            echo "<div class='alert alert-danger'>Error uploading cover image.</div>";
        }
    }

    $sql = "UPDATE comics SET title='$title', synopsis='$synopsis', url='$url', cover='$cover', publicationDate='$publicationDate', publicationStatus='$publicationStatus', contentRating='$contentRating', updatedAt='$updatedAt' WHERE comicId=$comicId";

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
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $comic['title']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Synopsis:</label>
                    <textarea name="synopsis" class="form-control" required><?php echo $comic['synopsis']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comic URL:</label>
                    <input type="url" name="comic_url" class="form-control" value="<?php echo $comic['url']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cover Image:</label>
                    <input type="file" name="cover" class="form-control">
                    <?php if (!empty($comic['cover'])): ?>
                        <img src="<?php echo $comic['cover']; ?>" alt="Cover Image" class="img-thumbnail mt-2" width="150">
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Publication Date:</label>
                    <input type="date" name="publicationDate" class="form-control" value="<?php echo $comic['publicationDate']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Publication Status:</label>
                    <select name="publicationStatus" class="form-select" required>
                        <option value="Ongoing" <?php echo ($comic['publicationStatus'] == 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="Completed" <?php echo ($comic['publicationStatus'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content Rating:</label>
                    <select name="contentRating" class="form-select" required>
                        <option value="Everyone" <?php echo ($comic['contentRating'] == 'Everyone') ? 'selected' : ''; ?>>Everyone</option>
                        <option value="Teen" <?php echo ($comic['contentRating'] == 'Teen') ? 'selected' : ''; ?>>Teen</option>
                        <option value="Mature" <?php echo ($comic['contentRating'] == 'Mature') ? 'selected' : ''; ?>>Mature</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="manageComics.php" class="btn btn-outline-light">← Back to Comics</a>
                    <button type="submit" class="btn btn-primary">Update Comic</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
