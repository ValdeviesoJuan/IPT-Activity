<?php
include("../../dB/config.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = "Invalid Announcement ID.";
    header("Location: announcements.php");
    exit();
}

// Fetch the announcement data
$query = "SELECT * FROM announcements WHERE announcementId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$announcement = $result->fetch_assoc();

if (!$announcement) {
    $_SESSION['message'] = "Announcement not found.";
    header("Location: announcements.php");
    exit();
}

$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);

    $updateQuery = "UPDATE announcements SET title = ?, message = ?, updatedAt = NOW() WHERE announcementId = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssi", $title, $message, $id);

    if ($updateStmt->execute()) {
        $_SESSION['message'] = "Announcement updated.";
        $_SESSION['code'] = "success";
    } else {
        $_SESSION['message'] = "Update failed.";
        $_SESSION['code'] = "error";
    }

    $updateStmt->close();
    $conn->close();
    header("Location: announcements.php");
    exit();
}
?>

<!-- Edit Form -->
<?php include("./includes/header.php"); ?>
<div class="container mt-4">
    <h2 class="text-white">Edit Announcement</h2>
    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($announcement['title']) ?>" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="message" rows="4" required><?= htmlspecialchars($announcement['message']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="announcements.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include("./includes/footer.php"); ?>
