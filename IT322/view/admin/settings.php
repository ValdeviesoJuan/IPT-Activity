<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">Settings</h2>

    <!-- Admin Profile Settings -->
    <div class="card bg-dark text-white p-3">
        <h4>Admin Profile</h4>
        <form action="#" method="POST">
            <div class="mb-3">
                <label for="adminName" class="form-label">Admin Name</label>
                <input type="text" class="form-control" id="adminName" name="admin_name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="adminEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="adminEmail" name="admin_email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="adminPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="adminPassword" name="admin_password" placeholder="Enter new password">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Website Settings -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Website Settings</h4>
        <form action="#" method="POST">
            <div class="mb-3">
                <label for="siteName" class="form-label">Website Name</label>
                <input type="text" class="form-control" id="siteName" name="site_name" placeholder="ComicZone" required>
            </div>
            <div class="mb-3">
                <label for="themeSelect" class="form-label">Theme</label>
                <select class="form-control" id="themeSelect" name="theme">
                    <option value="dark">Dark</option>
                    <option value="light">Light</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Maintenance Mode</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="maintenance" value="on" id="maintenanceOn">
                    <label class="form-check-label" for="maintenanceOn">On</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="maintenance" value="off" id="maintenanceOff" checked>
                    <label class="form-check-label" for="maintenanceOff">Off</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>
    </div>
</div>

<?php
include("./includes/footer.php");
?>
