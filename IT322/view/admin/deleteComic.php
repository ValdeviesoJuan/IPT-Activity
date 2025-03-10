<?php
include("../../dB/config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM comics WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: manageComics.php?delete=success");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
