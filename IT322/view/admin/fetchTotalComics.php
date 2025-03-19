<?php
include("../../dB/config.php");

$query = "SELECT COUNT(*) AS total FROM comics";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo $row['total']; // Return total comics count
?>
