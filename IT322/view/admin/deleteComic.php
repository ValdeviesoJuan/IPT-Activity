<?php
include("../../dB/config.php");

if (isset($_GET['id'])) {
    $comicId = $_GET['id'];
    $query = "DELETE FROM comics WHERE comicId = $comicId";

    if (mysqli_query($conn, $query)) {
        header("Location: manageComics.php?delete=success");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
