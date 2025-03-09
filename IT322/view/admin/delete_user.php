<?php
include("../../dB/config.php");

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $query = "DELETE FROM users WHERE userId = $userId";
    if (mysqli_query($conn, $query)) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
?>
