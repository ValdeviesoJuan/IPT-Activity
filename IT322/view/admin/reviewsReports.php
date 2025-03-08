<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="container mt-4">
    <h2 class="text-black">Reviews & Reports</h2>

    <!-- Search & Filter Options -->
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Search reviews/reports..." style="max-width: 300px; display: inline-block;">
        <select class="form-control" style="max-width: 200px; display: inline-block;">
            <option value="">Filter by Type</option>
            <option value="Review">Review</option>
            <option value="Report">Report</option>
        </select>
        <button class="btn btn-primary">Search</button>
    </div>

    <!-- Reviews Section -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>User Reviews</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Comic Title</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data (Replace with Database Query) -->
                <tr>
                    <td>1</td>
                    <td>JohnDoe</td>
                    <td>Spider-Man</td>
                    <td>⭐⭐⭐⭐</td>
                    <td>Great story and action!</td>
                    <td>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>JaneSmith</td>
                    <td>Batman</td>
                    <td>⭐⭐⭐⭐⭐</td>
                    <td>Amazing artwork and plot.</td>
                    <td>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <!-- More rows dynamically loaded from database -->
            </tbody>
        </table>
    </div>

    <!-- Reports Section -->
    <div class="card bg-dark text-white p-3 mt-4">
        <h4>Reported Reviews</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Reported By</th>
                    <th>Review ID</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data (Replace with Database Query) -->
                <tr>
                    <td>1</td>
                    <td>User123</td>
                    <td>Review #10</td>
                    <td>Offensive content</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>
                        <button class="btn btn-success btn-sm">Approve</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>User456</td>
                    <td>Review #25</td>
                    <td>Spam</td>
                    <td><span class="badge bg-danger">Rejected</span></td>
                    <td>
                        <button class="btn btn-success btn-sm">Approve</button>
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
