<?php
include("../../dB/config.php");  

$query = "SELECT c.comicId, c.title, c.views
            FROM comics c
            ORDER BY c.views DESC
            LIMIT 1";

$result = mysqli_query($conn, $query);

if ($popularComic = mysqli_fetch_assoc($result)) {
    echo htmlspecialchars($popularComic['title']);
} else {
    echo "None";
}
?>