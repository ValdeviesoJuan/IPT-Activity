<?php
include("../../dB/config.php"); // Ensure database connection

$query = "SELECT COUNT(*) AS total FROM users"; // Count total users
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo $row['total']; // Output total user count
?>
