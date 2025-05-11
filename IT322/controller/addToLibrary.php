<?php
session_start();
include("../dB/config.php");

header('Content-Type: application/json');

if (!isset($_SESSION['authUser']['userId'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$userId = $_SESSION['authUser']['userId'];
$comicId = $_POST['comicId'] ?? null;
$readStatus = $_POST['readStatus'] ?? null;

if (!$comicId || !$readStatus) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit();
}

// Optional: Prevent duplicates
$check = "SELECT * FROM userLibrary WHERE userId = ? AND comicId = ?";
$stmtCheck = $conn->prepare($check);
$stmtCheck->bind_param("ii", $userId, $comicId);
$stmtCheck->execute();
$result = $stmtCheck->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Comic already in library']);
    exit();
}

$sql = "INSERT INTO userLibrary (userId, comicId, readStatus) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $userId, $comicId, $readStatus);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Added to library']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
