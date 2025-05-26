<?php
include("../../dB/config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']); 
    $message = mysqli_real_escape_string($conn, $_POST['message']);  

    $query = "INSERT INTO `announcements`(`title`, `message`) VALUES ('$title','$message')";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "Announcement Added";
        $_SESSION['message'] = "Announcement Added";
        $_SESSION['code'] = "success";
        header("Location: ./announcements.php");
        exit(0);    
    } else {
        $_SESSION['message'] = "Failed to Add Announcement ";
        $_SESSION['code'] = "error";
        header("Location: ./announcements.php");
    }

    mysqli_close($conn);
}

?>