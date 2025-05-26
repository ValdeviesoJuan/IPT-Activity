<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("../../dB/config.php");

if (!isset($_SESSION['authUser']['userId'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$userId = $_SESSION['authUser']['userId'];

// Insert new notifications for the user if they don't already exist
$insertStmt = $conn->prepare("
    INSERT INTO usernotifications (userId, notificationId)
    SELECT ?, n.id
    FROM notifications n
    WHERE NOT EXISTS (
        SELECT 1
        FROM usernotifications un
        WHERE un.userId = ? AND un.notificationId = n.id
    )
");

if (!$insertStmt) {
    http_response_code(500);
    echo json_encode(["error" => "Insert prepare failed: " . $conn->error]);
    exit;
}

$insertStmt->bind_param("ii", $userId, $userId);
$insertStmt->execute();
$insertStmt->close();

// Fetch latest 5 notifications for the user
$fetchStmt = $conn->prepare("
    SELECT n.id, n.comicId, n.message, n.createdAt, n.type, un.isRead
    FROM notifications n
    INNER JOIN usernotifications un ON n.id = un.notificationId
    WHERE un.userId = ?
    ORDER BY n.createdAt DESC
    LIMIT 5
");

if (!$fetchStmt) {
    http_response_code(500);
    echo json_encode(["error" => "Fetch prepare failed: " . $conn->error]);
    exit;
}

$fetchStmt->bind_param("i", $userId);
$fetchStmt->execute();
$result = $fetchStmt->get_result();

$notifications = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}
$fetchStmt->close();

// Fetch only unread notifications for the user
$unreadStmt = $conn->prepare("
    SELECT un.userNotificationId, un.notificationId, n.comicId, n.message, n.createdAt, n.type, un.isRead
    FROM notifications n
    INNER JOIN usernotifications un ON n.id = un.notificationId
    WHERE un.userId = ? AND un.isRead = 0
    ORDER BY n.createdAt DESC   
");

if (!$unreadStmt) {
    http_response_code(500);
    echo json_encode(["error" => "Unread fetch prepare failed: " . $conn->error]);
    exit;
}

$unreadStmt->bind_param("i", $userId);
$unreadStmt->execute();
$unreadResult = $unreadStmt->get_result();

$unreadNotifications = [];
if ($unreadResult) {
    while ($row = $unreadResult->fetch_assoc()) {
        $unreadNotifications[] = $row;
    }
}
$unreadStmt->close();

header('Content-Type: application/json');
echo json_encode([
    "count" => count($notifications),
    "notifications" => $notifications,
    "unread_count" => count($unreadNotifications),
    "unread_notifications" => $unreadNotifications
]);
?>
