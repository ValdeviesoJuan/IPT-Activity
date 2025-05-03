<?php
include("../users/includes/header.php");
include("../users/includes/topbar.php");
include("../users/includes/sidebar.php");
?>

<div class="profile-container">
    <div class="profile-banner"></div>
    
    <div class="profile-content">
        <div class="profile-picture">
            <img src="../../assets/img/jcImage.jpg" alt="Profile Picture">
        </div>
    </div>

    <div class="profile-info">
        <div class="user-info">
            <h1 class="username">username123x</h1>

            <div class="tabs">
                <button class="tab active">Info</button>
                <button class="tab"><a href="./userLibrary.php" style="color: #fff;">Library</a></button>
            </div>

            <div class="user-details">
                <p class="user-label">User ID</p>
                <p class="user-value"><?php echo $_SESSION["authUser"]["userId"] ?></p>

                <p class="user-label">Roles</p>
                <span class="user-role"><?php echo $_SESSION["role"] ?> </span>
            </div>
        </div>
    </div>
</div>

<style> 
    /* Profile Container */
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

    /* Banner Background */
    .profile-banner {
        width: 100%;
        height: 33vh;
        background: url('../../assets/img/banner.jpg') no-repeat center center/cover;
    }

    /* Profile Content (Contains Only the Profile Picture) */
    .profile-content {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: -50px;
    }

    /* Circular Profile Picture */
    .profile-picture {
        width: 160px;
        height: 160px;
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

    /* Profile Info (Separate from Profile Content) */
    .profile-info {
        display: flex;
        justify-content: center;
        width: 80%;
        margin-top: 20px;
    }

    /* User Info Box */
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

    /* Tabs */
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

    /* User Details */
    .user-details {
        margin-top: 15px;
    }

    .user-label {
        font-size: 14px;
        color: #ccc;
        margin-bottom: 3px;
    }

    .user-value {
        font-size: 16px;
        font-weight: bold;
        color: white;
        margin-bottom: 12px;
    }

    .connect-btn {
        background: #333645;
        border: none;
        color: white;
        padding: 10px 15px;
        width: 100%;
        border-radius: 5px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        margin-top: 10px;
    }

    .connect-btn i {
        font-size: 18px;
    }

    /* User Role */
    .user-role {
        display: inline-block;
        padding: 5px 12px;
        background: #3a3d4a;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<?php
include("../users/includes/footer.php");
?>
