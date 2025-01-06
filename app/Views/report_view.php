<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Management</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>
    <div class="container">
        <h1>Smart Kos Report Management</h1>

        <!-- Create Report -->
        <div class="card">
            <h2>Create Report</h2>
            <form id="createForm">
                <div class="form-group">
                    <label for="problem_type">Problem Type</label>
                    <input type="text" id="problem_type" name="problem_type" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="room_location">Room Location</label>
                    <input type="text" id="room_location" name="room_location" required>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <button type="submit">Submit Report</button>
            </form>
        </div>

        <!-- View All Reports -->
        <div class="card">
            <h2>View Reports</h2>
            <button id="viewReports">Get All Reports</button>
            <div class="report-list" id="reportList"></div>
        </div>

        <!-- View Statistics -->
        <div class="card">
            <h2>Statistics</h2>
            <button id="viewStats">Get Statistics</button>
            <div id="stats" class="stats"></div>
        </div>
            
        <div class="separator"></div>
            
        <!-- Filter Reports by Status -->
        <div class="card">
            <h2>Filter Reports by Status</h2>
            <select id="statusFilter">
                <option value="pending">Pending</option>
                <option value="in_process">In Process</option>
                <option value="completed">Completed</option>
            </select>
            <button id="filterReports">Filter Reports</button>
            <div class="report-list" id="filteredReports"></div>
            <div id="filteredReports" class="report-list"></div>
        </div>

        <div class="separator"></div>

        <!-- Update Report Status -->
        <div class="card">
            <h2>Update Report Status</h2>
            <form id="updateStatusForm">
                <div class="form-group">
                    <label for="reportId">Report ID</label>
                    <input type="number" id="reportId" name="reportId" placeholder="Enter Report ID" required>
                </div>
                <div class="form-group">
                    <label for="newStatus">New Status</label>
                    <select id="newStatus" name="newStatus" required>
                        <option value="pending">Pending</option>
                        <option value="in_process">In Process</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <button type="submit">Update Status</button>
            </form>
        </div>

        <!-- Logout -->
        <div class="separator"></div>
        <div class="card">
            <button id="logoutButton" style="background-color: #FF4136; color: white;">Logout</button>
        </div>
    </div>

    <script src="<?= base_url('js/report.js'); ?>"></script>
</body>
</html>
