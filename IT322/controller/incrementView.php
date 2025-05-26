<?php
include("../dB/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comicId'])) {
    $comicId = intval($_POST['comicId']);

    $query = "UPDATE comics SET views = views + 1 WHERE comicId = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $comicId);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Update failed']);
    }

    mysqli_stmt_close($stmt);
    exit;
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
