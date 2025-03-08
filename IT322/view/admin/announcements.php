<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">Announcements</h2>

    <!-- Add Announcement Form -->
    <div class="card bg-dark text-white p-3">
        <h4>Add New Announcement</h4>
        <form action="#" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="title" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="message" rows="3" placeholder="Announcement Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Announcement</button>
        </form>
    </div>

    <!-- Announcements Table -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Recent Announcements</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Date Posted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data (Replace with Database Query) -->
                <tr>
                    <td>1</td>
                    <td>New Comics Arriving!</td>
                    <td>Exciting new comics will be added next week. Stay tuned!</td>
                    <td>March 8, 2025</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Maintenance Update</td>
                    <td>The website will undergo maintenance on March 10.</td>
                    <td>March 5, 2025</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <!-- More rows dynamically loaded from database -->
            </tbody>
        </table>
    </div>
</div>

<?php
include("./includes/footer.php");
?>
