<?php
include("../../dB/config.php"); // Ensure database connection

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $comic_url = mysqli_real_escape_string($conn, $_POST['comic_url']); // New URL input

    // Handle File Upload
    $uploadDir = __DIR__ . "/uploads/"; 
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create uploads folder if it doesn't exist
    }

    $fileName = uniqid() . "-" . basename($_FILES["comic_cover"]["name"]);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["comic_cover"]["tmp_name"], $uploadFile)) {
        // Save data into database including the new URL field
        $coverPath = "uploads/" . $fileName;
        $sql = "INSERT INTO comics (title, author, genre, cover, url) VALUES ('$title', '$author', '$genre', '$coverPath', '$comic_url')";

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
