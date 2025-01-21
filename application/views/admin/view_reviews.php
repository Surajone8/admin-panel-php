<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <style>
        /* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
}

.header {
    background-color: #007bff;
    color: white;
    padding: 15px;
    text-align: center;
}

.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #343a40;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    padding: 20px 0;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    font-size: 16px;
}

.sidebar a:hover {
    background-color: #495057;
}

.content {
    margin-left: 250px;
    padding: 20px;
}

h2 {
    margin-top: 0;
    font-size: 24px;
    color: #333;
}

/* Table Styles */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table thead {
    background-color: #007bff;
    color: white;
}

table th, table td {
    padding: 12px;
    text-align: left;
}

table th {
    font-size: 18px;
}

table td {
    font-size: 16px;
    background-color: white;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* table tr:hover {
    background-color: #f1f1f1;
} */

table a {
    color: #007bff;
    text-decoration: none;
}

table a:hover {
    text-decoration: underline;
}

/* Action buttons */
td a {
    margin-right: 10px;
}


    </style>
</head>
<body>
    <div class="header">
        <h1>View Reviews</h1>
    </div>

    <div class="sidebar">
    <h2 style="text-align: center;">Menu</h2>
        <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
        <a href="<?php echo site_url('admin/manage_users'); ?>">Manage Users</a>
        <a href="<?php echo site_url('admin/orders'); ?>">Manage Orders</a>
        <a href="<?php echo site_url('admin/manage_categories'); ?>">Categories</a>
        <a href="<?php echo site_url('admin/manage_products'); ?>">Products</a>
        <a href="<?php echo site_url('admin/reports'); ?>">View Reports</a>
        <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?php echo $report->id; ?></td>
                    <td><?php echo $report->title; ?></td>
                    <td><?php echo $report->date; ?></td>
                    <td><a href="#">View</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
