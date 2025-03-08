<?php
include("../../dB/config.php"); // Make sure you have a database connection file

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    // Handle File Upload
    $uploadDir = __DIR__ . "/uploads/"; 
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create uploads folder if not exists
    }

    $fileName = uniqid() . "-" . basename($_FILES["comic_cover"]["name"]);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["comic_cover"]["tmp_name"], $uploadFile)) {
        // Save data into database
        $coverPath = "uploads/" . $fileName;
        $sql = "INSERT INTO comics (title, author, genre, cover) VALUES ('$title', '$author', '$genre', '$coverPath')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?success=1"); // Redirect to dashboard to show new comic
            exit();
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
