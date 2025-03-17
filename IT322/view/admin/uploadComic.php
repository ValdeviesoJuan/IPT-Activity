<?php
include("../../dB/config.php"); // Ensure database connection

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $alternateTitle = mysqli_real_escape_string($conn, $_POST['alternateTitle']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $artist = mysqli_real_escape_string($conn, $_POST['artist']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $theme = mysqli_real_escape_string($conn, $_POST['theme']);
    $contentRating = mysqli_real_escape_string($conn, $_POST['contentRating']);
    $publicationStatus = mysqli_real_escape_string($conn, $_POST['publicationStatus']);
    $publicationDate = mysqli_real_escape_string($conn, $_POST['publicationDate']);
    $comicUrl = mysqli_real_escape_string($conn, $_POST['comicUrl']); // New URL input
    $synopsis = mysqli_real_escape_string($conn, $_POST['synopsis']);  

    // Handle File Upload
    $uploadDir = dirname(__DIR__, 2) . "/assets/uploads/"; 
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create uploads folder if it doesn't exist
    }

    $fileName = uniqid() . "-" . basename($_FILES["comicCover"]["name"]);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["comicCover"]["tmp_name"], $uploadFile)) {
        // Save data into database including the new URL field
        $coverPath = "uploads/" . $fileName;
        $sql = "INSERT INTO comics (title, synopsis, cover, url, publicationDate, publicationStatus) 
        VALUES ('$title', '$synopsis', '$coverPath', '$comicUrl', '$publicationDate', '$publicationStatus')";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?success=1"); // Redirect to dashboard
            exit();
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
