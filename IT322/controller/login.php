<?php
include("../dB/config.php");
session_start();

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT `userId`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `birthday`, `profilePicture`, `verification`, `role` 
    FROM `users` WHERE email = '$email' AND password = '$password' LIMIT 1;";

    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        if(mysqli_num_rows($query_run) > 0) {
            $data = mysqli_fetch_assoc($query_run);

            $userID = $data["userId"];
            $fullname = $data["firstName"]." ".$data["lastName"];
            $emailAddress = $data["email"];
            $userRole = $data["role"];
            $profilePicture = $data["profilePicture"];

            $_SESSION["auth"] = true;
            $_SESSION["role"] = $userRole;
            $_SESSION["authUser"] = [
                'userId' => $userID,
                'fullName' => $fullname,
                'emailAddress' => $emailAddress,
                'profilePicture' => $profilePicture
            ];

            if($userRole == 'Admin'){
                $_SESSION['message'] = "Welcome " . $fullname;
                $_SESSION["code"] = "success";
                header("Location: ../view/admin/index.php");
            } else if ($userRole == "User"){
                $_SESSION['message'] = "Welcome Admin " . $fullname;
                $_SESSION["code"] = "success";
                header("Location: ../view/users/index.php");
            } else {
                $_SESSION['message'] = "User has no Role Myghad";
                $_SESSION["code"] = "error";
                header("Location: ../login.php");
                exit(0);
            }

            mysqli_close($conn); 
            exit();
        } else {
            $_SESSION['message'] = "Wrong Email or Password";
            $_SESSION['code'] = "error";
            header("Location: ../login.php");
            exit(0);
        }

    } else {
        $_SESSION['message'] = "There was an error processing your query";
        $_SESSION["code"] = "error";
        header("Location: ../login.php");
        exit(0);
    } 
    
}

?>