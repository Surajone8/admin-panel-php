<!DOCTYPE html>
<html>
<head>
    <title>Orders - <?php echo $status; ?></title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-top: 20px;
        }

        h2 {
            color: #fff;
            text-align: center;
            background-color: #007bff;
            padding: 10px 0;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 10px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px 20px;
            margin: 5px 0;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .dropdown {
            margin: 10px 0;
        }

        .dropdown-btn {
            display: block;
            background-color: #444;
            color: white;
            padding: 10px 20px;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-btn:hover {
            background-color: #575757;
        }

        .dropdown-content {
            display: none;
            background-color: #555;
        }

        .dropdown-content a {
            padding: 10px 40px;
        }

        .dropdown-content a:hover {
            background-color: #666;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Content Area */
        .content {
            margin-left: 260px;
            padding: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9e9e9;
        }

        /* Button Styles */
        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit {
            background-color: #28a745;
            color: white;
        }

        .edit:hover {
            background-color: #218838;
        }

        .delete {
            background-color: #dc3545;
            color: white;
        }

        .delete:hover {
            background-color: #c82333;
        }

        /* Filter Links */
        .filter-links {
            margin: 20px 0;
            text-align: center;
        }

        .filter-links a {
            display: inline-block;
            padding: 8px 15px;
            margin: 5px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }

        .filter-links a:hover {
            background-color: #0056b3;
        }

        .actions{
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pagination-container {
    margin-top: 20px;
    text-align: center;
}

.pagination {
    display: inline-flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 8px 12px;
    background-color: #007BFF;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.pagination li a:hover {
    background-color: #0056b3;
}
.pagination .active a {
    background-color: #0056b3;
    pointer-events: none;
}

/* Pagination container */
.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    margin: 20px 0;
    padding: 0;
}

/* Pagination item */
.pagination .page-item {
    margin: 0 5px;
}

.pagination .page-item a {
    display: block;
    padding: 10px 15px;
    color: black;
    text-decoration: none;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
}

/* Hover effect */
.pagination .page-item a:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

/* Active page */
.pagination .page-item.active a {
    background-color: #0056b3;
    color: white;
    border-color: #0056b3;
    cursor: default;
}

/* Focus state */
.pagination .page-item a:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
}

    </style>
</head>
<body>
<div class="sidebar">
        <h2>Menu</h2>
        <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
        <a href="<?php echo site_url('admin/manage_users/0'); ?>">Manage Users</a>
        <div class="dropdown">
            <button class="dropdown-btn">Manage Orders</button>
            <div class="dropdown-content">
                <a href="<?php echo site_url('admin/manage_orders/0'); ?>">Orders</a>
                <a href="<?php echo site_url('admin/orders/status/Pending/0'); ?>">Pending</a>
                <a href="<?php echo site_url('admin/orders/status/Processing/0'); ?>">Processing</a>
                <a href="<?php echo site_url('admin/orders/status/Shipped/0'); ?>">Shipped</a>
                <a href="<?php echo site_url('admin/orders/status/Delivered/0'); ?>">Delivered</a>
                <a href="<?php echo site_url('admin/orders/status/Cancelled/0'); ?>">Cancelled</a>
            </div>
        </div>
        <a href="<?php echo site_url('admin/manage_categories/0'); ?>">Categories</a>
        <a href="<?php echo site_url('admin/manage_products/0'); ?>">Products</a>
        <!-- <a href="<?php echo site_url('admin/reports'); ?>">View Reports</a> -->
        <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
    </div>

    <div class="content">
        <h1>Orders - <?php echo $status; ?></h1>
        <!-- Display orders -->
<!-- Display orders -->
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->user_email ?></td>
                <td><?= $order->status ?></td>
                <td><?= $order->total_amount ?></td>
                <td>
                    <button class="edit" onclick="window.location.href='<?= site_url('admin/manage_orders/edit/' . $order->id); ?>'">Edit</button>
                    <button class="delete" onclick="if(confirm('Are you sure you want to delete this order?')) window.location.href='<?= site_url('admin/manage_orders/delete/' . $order->id); ?>'">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination Links -->
<ul class="pagination">
    <?php if (!empty($pagination_buttons)): ?>
        <?php foreach ($pagination_buttons as $index => $button): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $button ?>">
                    <?= ($button == current_url()) ? 'Current' : ($index + 1) ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="page-item">
            <span class="page-link">No additional pages</span>
        </li>
    <?php endif; ?>
</ul>







        <div class="filter-links">
            <h3>Filter by Status:</h3>
            <a href="<?php echo site_url('admin/orders/status/Pending'); ?>">Pending</a>
            <a href="<?php echo site_url('admin/orders/status/Processing'); ?>">Processing</a>
            <a href="<?php echo site_url('admin/orders/status/Shipped'); ?>">Shipped</a>
            <a href="<?php echo site_url('admin/orders/status/Delivered'); ?>">Delivered</a>
            <a href="<?php echo site_url('admin/orders/status/Cancelled'); ?>">Cancelled</a>
        </div>
    </div>
</body>
</html>
