<?php
include("../../dB/config.php");

$q = mysqli_real_escape_string($conn, $_GET['q']);
$query = "SELECT authorName FROM authors WHERE authorName LIKE '%$q%' LIMIT 5";
$result = mysqli_query($conn, $query);

$authors = [];
while ($row = mysqli_fetch_assoc($result)) {
    $authors[] = ["authorName" => $row['authorName']];
}

echo json_encode($authors);
?>
