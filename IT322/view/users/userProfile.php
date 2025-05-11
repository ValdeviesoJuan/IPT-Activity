<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");

// fallback if profilePicture is not yet set
$profilePic = $_SESSION['authUser']['profilePicture'] ?? '../../assets/img/jcImage.jpg';
?>

<div class="profile-container">
    <div class="profile-banner"></div>
    
    <div class="profile-content">
        <div class="profile-picture-wrapper">
            <div class="profile-picture">
                <img src="<?php echo $profilePic ?>" alt="Profile Picture">
            </div>

            <form id="uploadForm" action="../../controller/uploadProfilePicture.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profileImage" id="profileImage" accept="image/*" onchange="document.getElementById('uploadForm').submit()">
                <label for="profileImage" class="edit-icon">
                    <span class="material-icons"><i class="ri-pencil-fill"></i></span>
                </label>
            </form>
        </div>
    </div>

    <div class="profile-info">
        <div class="user-info">
            <h1 class="username"><?php echo $_SESSION["authUser"]["fullName"] ?></h1>

            <div class="tabs">
                <button class="tab active">Info</button>
                <button class="tab"><a href="./userLibrary.php" style="color: #fff;">Library</a></button>
            </div>

            <div class="user-details">
                <p class="user-label">User ID</p>
                <p class="user-value"><?php echo $_SESSION["authUser"]["userId"] ?></p>

                <p class="user-label">Email</p>
                <p class="user-value"><?php echo $_SESSION["authUser"]["emailAddress"] ?></p>

                <p class="user-label">Roles</p>
                <span class="user-role"><?php echo $_SESSION["role"] ?> </span>
            </div>
        </div>
    </div>
</div>

<style> 
    .profile-container {
        position: relative;
        width: 100%;
        height: 100vh;
        background-color: #1a1a1c;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 5vh;
    }

    .profile-banner {
        width: 100%;
        height: 33vh;
        background: url('../../assets/img/banner.jpg') no-repeat center center/cover;
    }

    .profile-content {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: -50px;
    }

    .profile-picture-wrapper {
        position: relative;
        width: 160px;
        height: 160px;
    }

    .profile-picture {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .edit-icon {
        position: absolute;
        bottom: 0;
        right: 0    ;
        transform: translate(-20%, -20%);
        background-color: #fff;
        border-radius: 50%;
        padding: 0 5px;   
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;     
    }


    .edit-icon .material-icons {
        font-size: 24px; 
    }

    input[type="file"] {
        display: none;
    }

    .profile-info {
        display: flex;
        justify-content: center;
        width: 80%;
        margin-top: 20px;
    }

    .user-info {
        background: rgba(255, 255, 255, 0.05);
        padding: 20px;
        border-radius: 8px;
        width: 450px;
    }

    .username {
        font-size: 28px;
        font-weight: bold;
        color: white;
    }

    .tabs {
        display: flex;
        gap: 10px;
        margin: 15px 0;
    }

    .tab {
        background: #3a3d4a;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    .tab.active {
        background: #6f73a8;
    }

    .user-details {
        margin-top: 15px;
    }

    .user-label {
        font-size: 16px;
        font-weight: bold;
        color: #ccc;
        margin-bottom: 3px;
    }

    .user-value {
        font-size: 16px;
        color: white;
        margin-bottom: 12px;
    }

    .user-role {
        display: inline-block;
        padding: 5px 12px;
        background: #3a3d4a;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<?php include("../users/includes/footer.php"); ?>
