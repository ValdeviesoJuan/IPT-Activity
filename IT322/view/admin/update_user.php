<?php
include("../../dB/config.php"); // Connect to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = intval($_POST['userId']);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Update user in database
    $query = "UPDATE users SET firstName=?, lastName=?, email=?, role=? WHERE userId=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $firstName, $lastName, $email, $role, $userId);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href='manageUsers.php';</script>";
    } else {
        echo "<script>alert('Error updating user!'); history.back();</script>";
    }
}
?>
