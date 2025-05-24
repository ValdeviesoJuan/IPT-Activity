<?php
include("../../dB/config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['authUser']['userId'];
    
    $title = mysqli_real_escape_string($conn, $_POST['title']); 
    $synopsis = mysqli_real_escape_string($conn, $_POST['synopsis']);  
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $artist = mysqli_real_escape_string($conn, $_POST['artist']);
    $comicUrl = mysqli_real_escape_string($conn, $_POST['comicUrl']);
    $contentRating = mysqli_real_escape_string($conn, $_POST['contentRating']);
    $publicationStatus = mysqli_real_escape_string($conn, $_POST['publicationStatus']);
    $publicationDate = mysqli_real_escape_string($conn, $_POST['publicationDate']);
 
    $author_query = "SELECT authorId FROM authors WHERE authorName = '$author'";
    $author_result = mysqli_query($conn, $author_query);
    if (mysqli_num_rows($author_result) == 0) {
        mysqli_query($conn, "INSERT INTO authors (authorName) VALUES ('$author')");
        $author_id = mysqli_insert_id($conn);
    } else {
        $author_id = mysqli_fetch_assoc($author_result)['authorId'];
    }
 
    $artist_query = "SELECT artistId FROM artists WHERE artistName = '$artist'";
    $artist_result = mysqli_query($conn, $artist_query);
    if (mysqli_num_rows($artist_result) == 0) {
        mysqli_query($conn, "INSERT INTO artists (artistName) VALUES ('$artist')");
        $artist_id = mysqli_insert_id($conn);
    } else {
        $artist_id = mysqli_fetch_assoc($artist_result)['artistId'];
    }

    // File Upload
    $uploadDir = dirname(__DIR__, 2) . "/assets/uploads/"; 
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = uniqid() . "-" . basename($_FILES["comicCover"]["name"]);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["comicCover"]["tmp_name"], $uploadFile)) {
        $coverPath = "uploads/" . $fileName; 

        $sql = "INSERT INTO comics (title, synopsis, cover, url, publicationDate, publicationStatus, contentRating) 
                VALUES ('$title', '$synopsis', '$coverPath', '$comicUrl', '$publicationDate', '$publicationStatus', '$contentRating')";

        if (mysqli_query($conn, $sql)) {
            $comicId = mysqli_insert_id($conn);

            if (!empty($_POST['author'])) {
                $query = "INSERT INTO comicauthor (authorId, comicId) VALUES ('$author_id', '$comicId')";
                if (!mysqli_query($conn, $query)) {
                    $_SESSION['message'] = "Insert Failed: Author Error";
                    $_SESSION['code'] = "error";
                    header("Location: ./index.php");
                    exit();
                }
            }

            if (!empty($_POST['artist'])) {
                $query = "INSERT INTO comicartist (artistId, comicId) VALUES ('$artist_id', '$comicId')";
                if (!mysqli_query($conn, $query)) {
                    $_SESSION['message'] = "Insert Failed: Artist Error";
                    $_SESSION['code'] = "error";
                    header("Location: ./index.php");
                    exit();
                }
            }
 
            if (!empty($_POST['theme'])) {
                $themes = explode(", ", $_POST['theme']);
                foreach ($themes as $themeName) {
                    $themeQuery = "SELECT themeId FROM themes WHERE theme = '$themeName'";
                    $themeResult = mysqli_query($conn, $themeQuery);
                    if ($themeRow = mysqli_fetch_assoc($themeResult)) {
                        $themeId = $themeRow['themeId'];
                        mysqli_query($conn, "INSERT INTO comictheme (comicId, themeId) VALUES ('$comicId', '$themeId')");
                    }
                }
            }
 
            if (!empty($_POST['genre'])) {
                $genres = explode(", ", $_POST['genre']);
                foreach ($genres as $genreName) {
                    $genreQuery = "SELECT genreId FROM genres WHERE genre = '$genreName'";
                    $genreResult = mysqli_query($conn, $genreQuery);
                    if ($genreRow = mysqli_fetch_assoc($genreResult)) {
                        $genreId = $genreRow['genreId'];
                        mysqli_query($conn, "INSERT INTO comicgenre (comicId, genreId) VALUES ('$comicId', '$genreId')");
                    }
                }
            }
 
            $notificationMsg = mysqli_real_escape_string($conn, "A new comic titled '$title' was added.");
            $notifSql = "INSERT INTO notifications (message, type, comicId, userId)
                         VALUES ('$notificationMsg', 'new_comic', '$comicId', $userId)";
            if (!mysqli_query($conn, $notifSql)) {
                error_log("Notification insert failed: " . mysqli_error($conn));
            }

            $_SESSION['message'] = "Comic Added Successfully";
            $_SESSION['code'] = "success";
            header("Location: index.php?success=1");
            mysqli_close($conn);
            exit();
        } else {
            echo "Database Error: " . mysqli_error($conn);
            mysqli_close($conn);
        }
    } else {
        echo "Error uploading file.";
        mysqli_close($conn);
    }
}
?>
