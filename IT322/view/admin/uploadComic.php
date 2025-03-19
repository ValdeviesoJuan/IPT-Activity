<?php
include("../../dB/config.php"); // Ensure database connection

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']); 
    $synopsis = mysqli_real_escape_string($conn, $_POST['synopsis']);  
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $artist = mysqli_real_escape_string($conn, $_POST['artist']); 
    $contentRating = mysqli_real_escape_string($conn, $_POST['contentRating']);
    $publicationStatus = mysqli_real_escape_string($conn, $_POST['publicationStatus']);
    $publicationDate = mysqli_real_escape_string($conn, $_POST['publicationDate']);
    $comicUrl = mysqli_real_escape_string($conn, $_POST['comicUrl']); // New URL input

    // Check if author exists, if not insert
    $author_query = "SELECT authorId FROM authors WHERE authorName = '$author'";
    $author_result = mysqli_query($conn, $author_query);
    if (mysqli_num_rows($author_result) == 0) {
        mysqli_query($conn, "INSERT INTO authors (authorName) VALUES ('$author')");
        $author_id = mysqli_insert_id($conn);
    } else {
        $author_id = mysqli_fetch_assoc($author_result)['authorId'];
    }

    // Check if artist exists, if not insert
    $artist_query = "SELECT artistId FROM artists WHERE artistName = '$artist'";
    $artist_result = mysqli_query($conn, $artist_query);
    if (mysqli_num_rows($artist_result) == 0) {
        mysqli_query($conn, "INSERT INTO artists (artistName) VALUES ('$artist')");
        $artist_id = mysqli_insert_id($conn);
    } else {
        $artist_id = mysqli_fetch_assoc($artist_result)['artistId'];
    }

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
        $sql = "INSERT INTO comics (title, synopsis, cover, url, publicationDate, publicationStatus, contentRating) 
        VALUES ('$title', '$synopsis', '$coverPath', '$comicUrl', '$publicationDate', '$publicationStatus', '$contentRating')";

        if (mysqli_query($conn, $sql)) {
            $comicId = mysqli_insert_id($conn);

            // Add Author in the Bridge Table
            if (!empty($_POST['author'])) {
                $query = "INSERT INTO comicauthor (authorId, comicId) VALUES ('$author_id', '$comicId')";
                if (mysqli_query($conn, $query)) {
                    echo "Comic added successfully!";
                } else {
                    echo "Error: " . mysqli_error($conn); 
                    $_SESSION['message'] = "Insert Failed: Author Error";
                    $_SESSION['code'] = "error";
                    header("Location: ./index.php");
                }
            }

            // Add Artist in the Bridge Table
            if (!empty($_POST['author'])) {
                $query = "INSERT INTO comicartist (artistId, comicId) VALUES ('$artist_id', '$comicId')";
                if (mysqli_query($conn, $query)) {
                    echo "Comic added successfully!";
                } else {
                    echo "Error: " . mysqli_error($conn); 
                    $_SESSION['message'] = "Insert Failed: Artist Error";
                    $_SESSION['code'] = "error";
                    header("Location: ./index.php");
                }
            }

            // Add Themes in the Bridge table
            if (!empty($_POST['theme'])) {
                $themes = explode(", ", $_POST['theme']); // Convert string to array
                foreach ($themes as $themeName) {
                    // Get theme ID
                    $themeQuery = "SELECT themeId FROM themes WHERE theme = '$themeName'";
                    $themeResult = mysqli_query($conn, $themeQuery);
                    if ($themeRow = mysqli_fetch_assoc($themeResult)) {
                        $themeId = $themeRow['themeId'];
                        mysqli_query($conn, "INSERT INTO comictheme (comicId, themeId) VALUES ('$comicId', '$themeId')");
                    }
                }
            }

            // Add Genres in the Bridge table
            if (!empty($_POST['genre'])) {
                $genres = explode(", ", $_POST['genre']); // Convert string to array
                foreach ($genres as $genreName) {
                    // Get genre ID
                    $genreQuery = "SELECT genreId FROM genres WHERE genre = '$genreName'";
                    $genreResult = mysqli_query($conn, $genreQuery);
                    if ($genreRow = mysqli_fetch_assoc($genreResult)) {
                        $genreId = $genreRow['genreId'];
                        mysqli_query($conn, "INSERT INTO comicgenre (comicId, genreId) VALUES ('$comicId', '$genreId')");
                    }
                }
            }

            // Add Themes in the Bridge table
            if (!empty($_POST['theme'])) {
                $themes = explode(", ", $_POST['theme']); // Convert string to array
                foreach ($themes as $themeName) {
                    // Get theme ID
                    $themeQuery = "SELECT themeId FROM themes WHERE theme = '$themeName'";
                    $themeResult = mysqli_query($conn, $themeQuery);
                    if ($themeRow = mysqli_fetch_assoc($themeResult)) {
                        $themeId = $themeRow['themeId'];
                        mysqli_query($conn, "INSERT INTO comictheme (comicId, themeId) VALUES ('$comicId', '$themeId')");
                    }
                }
            }
            
            $_SESSION['message'] = "Comic Added Successfully";
            $_SESSION['code'] = "success";
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
