<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("../../dB/config.php");

$stmt = $conn->prepare("
    SELECT id, comicId, message, createdAt, type, userId
    FROM notifications
    ORDER BY createdAt DESC
    LIMIT 5
");

$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $notifications = [];
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode([
        "count" => count($notifications),
        "notifications" => $notifications
    ]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "DB Query failed: " . $conn->error]);
}
?>
