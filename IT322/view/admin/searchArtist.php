<?php
include("../../dB/config.php");

$q = mysqli_real_escape_string($conn, $_GET['q']);
$query = "SELECT artistName FROM artists WHERE artistName LIKE '%$q%' LIMIT 5";
$result = mysqli_query($conn, $query);

$artists = [];
while ($row = mysqli_fetch_assoc($result)) {
    $artists[] = ["artistName" => $row['artistName']];
}

echo json_encode($artists);
?>
