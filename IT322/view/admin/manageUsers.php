<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">Manage Users</h2>

    <!-- Search & Filter Options -->
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Search users..." style="max-width: 300px; display: inline-block;">
        <select class="form-control" style="max-width: 200px; display: inline-block;">
            <option value="">Filter by Role</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>
        <button class="btn btn-primary">Search</button>
    </div>

    <!-- Users Table -->
    <div class="card bg-dark text-white p-3">
        <h4>User List</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data (Replace with Database Query) -->
                <tr>
                    <td><input type="checkbox"></td>
                    <td>1</td>
                    <td>JohnDoe</td>
                    <td>johndoe@example.com</td>
                    <td>Admin</td>
                    <td>
                        <a href="edit_user.php?id=1" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>2</td>
                    <td>JaneSmith</td>
                    <td>janesmith@example.com</td>
                    <td>User</td>
                    <td>
                        <a href="edit_user.php?id=2" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <!-- More rows dynamically loaded from database -->
            </tbody>
        </table>
    </div>

    <!-- Add User Form -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Add New User</h4>
        <form action="#" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="col-md-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="role" required>
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("./includes/footer.php");
?>
