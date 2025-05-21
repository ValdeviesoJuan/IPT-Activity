<?php
include("../dB/config.php");
session_start();

$userId = $_SESSION["authUser"]["userId"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profileImage"])) {
    $uploadDir = dirname(__DIR__, 1) . "/assets/profileImages/";

    // Create folder if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Sanitize and generate unique file name
    $originalName = basename($_FILES["profileImage"]["name"]);
    $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExt, $allowed)) {
        $fileName = uniqid("user_{$userId}_") . "." . $fileExt;
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadFile)) {
            $relativePath = "../../assets/profileImages/" . $fileName;

            $updateQuery = "UPDATE users SET profilePicture = '$relativePath' WHERE userId = '$userId'";
            if (mysqli_query($conn, $updateQuery)) {
                $_SESSION["authUser"]["profilePicture"] = $relativePath;
                $_SESSION["message"] = "Profile picture updated!";
                $_SESSION["code"] = "success";
            } else {
                $_SESSION["message"] = "Failed to update database: " . mysqli_error($conn);
                $_SESSION["code"] = "error";
            }
        } else {
            $_SESSION["message"] = "File upload failed.";
            $_SESSION["code"] = "error";
        }
    } else {
        $_SESSION["message"] = "Invalid file type. Allowed: jpg, jpeg, png, gif.";
        $_SESSION["code"] = "error";
    }
}

// Redirect back to profile page
header("Location: ../view/users/userProfile.php");
exit();
?>
