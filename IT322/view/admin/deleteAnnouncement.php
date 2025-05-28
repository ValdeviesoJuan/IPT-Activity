<?php
include("../../dB/config.php");
session_start();

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = "Invalid ID.";
    header("Location: announcements.php");
    exit();
}

$query = "DELETE FROM announcements WHERE announcementId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['message'] = "Announcement deleted.";
    $_SESSION['code'] = "success";
} else {
    $_SESSION['message'] = "Failed to delete announcement.";
    $_SESSION['code'] = "error";
}

$stmt->close();
$conn->close();

header("Location: announcements.php");
exit();
?>
