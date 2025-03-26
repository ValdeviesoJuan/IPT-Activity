<?php
include("../../dB/config.php");

if (!isset($_GET['id'])) {
    die("User ID is missing.");
}

$userId = intval($_GET['id']); // Get the user ID safely

// Prevent deletion of admin accounts for security
$query = "SELECT role FROM users WHERE userId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}

if ($user['role'] === 'Admin') {
    die("Admin accounts cannot be deleted.");
}

// Delete user from database
$deleteQuery = "DELETE FROM users WHERE userId = ?";
$deleteStmt = $conn->prepare($deleteQuery);
$deleteStmt->bind_param("i", $userId);

if ($deleteStmt->execute()) {
    echo "User deleted successfully.";
} else {
    echo "Error deleting user.";
}
?>
