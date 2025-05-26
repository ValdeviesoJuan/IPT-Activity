<?php
include("../dB/config.php");
session_start();

$userId = $_SESSION['authUser']['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $usernotificationId = intval($_GET['id']);

    $stmt = $conn->prepare("
        UPDATE usernotifications 
        SET isRead = 1, readAt = NOW() 
        WHERE userId = ? AND userNotificationId = ?
    ");
    $stmt->bind_param("ii", $userId, $usernotificationId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "DB error"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
?>
