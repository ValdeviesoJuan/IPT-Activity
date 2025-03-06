<?php
include("../dB/config.php");
session_start();

if(isset($_POST['registration'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    // CONFIRM PASSWORD VALIDATION
    if($password !== $cpassword) {
        $_SESSION['message'] = "Password and Confirm Password does not match";
        $_SESSION['code'] = "error";    
        header("Location: ../registration.php");
        exit(0);
    }

    // EMAIL VALIDATION
    $query = "SELECT email FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['message'] = "Email Address already exists";
        $_SESSION['code'] = "error";
        header("Location: ../registration.php");
        exit(0);
    }

    // REGISTRATION POST 
    $query = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `birthday`) 
    VALUES ('$firstName','$lastName','$email','$password','$phoneNumber','$gender','$birthday')";
    
    $result = mysqli_query($conn, $query);
    if($result){
        echo "Registration Successfull";
        $_SESSION['message'] = "Registered Successfully";
        $_SESSION['code'] = "success";
        header("Location: ../login.php");
        exit(0);    
    } else {
        $_SESSION['message'] = "Registration Failed: ";
        $_SESSION['code'] = "error";
        header("Location: ../registration.php");
    }

    mysqli_close($conn);
}
?>
