<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
include("../../dB/config.php"); // Connect to database

// Check if user ID is set
if (!isset($_GET['id'])) {
    die("User ID is missing.");
}

$userId = intval($_GET['id']); // Get user ID safely

// Fetch user details
$query = "SELECT userId, firstName, lastName, email, role FROM users WHERE userId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}
?>

<div class="container mt-4">
    <h2 class="text-white">Edit User</h2>

    <div class="card bg-dark text-white p-3">
        <form action="update_user.php" method="POST">
            <input type="hidden" name="userId" value="<?= $user['userId'] ?>">

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="firstName" value="<?= htmlspecialchars($user['firstName']) ?>" class="form-control" required>
                <input type="text" name="lastName" value="<?= htmlspecialchars($user['lastName']) ?>" class="form-control mt-2" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="Admin" <?= $user['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="User" <?= $user['role'] == 'User' ? 'selected' : '' ?>>User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update User</button>
            <a href="manageUsers.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include("./includes/footer.php"); ?>
