<?php
include("../../dB/config.php"); // Ensure database connection

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$role = isset($_GET['role']) ? mysqli_real_escape_string($conn, $_GET['role']) : '';

// Build SQL query
$query = "SELECT userId, firstName, lastName, email, role FROM users WHERE 1";

if (!empty($search)) {
    $query .= " AND (firstName LIKE '%$search%' OR lastName LIKE '%$search%' OR email LIKE '%$search%')";
}

if (!empty($role)) {
    $query .= " AND role = '$role'";
}

$result = mysqli_query($conn, $query);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row; // Store user data in an array
}

echo json_encode($users); // Output JSON format
?>
