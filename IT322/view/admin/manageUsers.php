<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">Manage Users</h2>

    <!-- Search & Filter Options -->
    <div class="mb-3">
        <input type="text" id="search-input" class="form-control" placeholder="Search users..." style="max-width: 300px; display: inline-block;">
        <select id="role-filter" class="form-control" style="max-width: 200px; display: inline-block;">
            <option value="">Filter by Role</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>
        <button class="btn btn-primary" onclick="fetchUsers()">Search</button>
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
            <tbody id="user-list"> <!-- Dynamic data goes here -->
            </tbody>
        </table>
    </div>

    <!-- Add User Form
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
    -->
</div>

<script>
    function fetchUsers() {
        let searchQuery = document.getElementById("search-input").value;
        let roleFilter = document.getElementById("role-filter").value;

        fetch(`fetch_users.php?search=${searchQuery}&role=${roleFilter}`)
            .then(response => response.json())
            .then(data => {
                let userTable = document.getElementById("user-list");
                userTable.innerHTML = ""; // Clear existing data

                data.forEach((user, index) => {
                    let row = `
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>${index + 1}</td>
                            <td>${user.firstName} ${user.lastName}</td>
                            <td>${user.email}</td>
                            <td>${user.role}</td>
                            <td>
                                <a href="edit_user.php?id=${user.userId}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.userId})">Delete</button>
                            </td>
                        </tr>
                    `;
                    userTable.innerHTML += row; // Append row to table
                });
            })
            .catch(error => console.error('Error fetching users:', error));
    }

    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            fetch("delete_user.php?id=" + userId, { method: "GET" })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Show success/error message
                    fetchUsers(); // Refresh user list
                })
                .catch(error => console.error('Error deleting user:', error));
        }
    }

    document.getElementById("search-input").addEventListener("keyup", fetchUsers);
    document.getElementById("role-filter").addEventListener("change", fetchUsers);

    fetchUsers(); // Fetch users on page load
    setInterval(fetchUsers, 5000); // Refresh every 5 seconds
</script>

<?php
include("./includes/footer.php");
?>
