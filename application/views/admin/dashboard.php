<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
    /* Global Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9fafc;
        color: #333;
    }

    .header {
        background-color: #4CAF50;
        color: white;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .header h1 {
        margin: 0;
        font-size: 2rem;
    }

    /* Sidebar */
    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #2c3e50;
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 50px;
        box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
    }

    .sidebar h2 {
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 30px;
        color: #ecf0f1;
    }

    .sidebar a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        font-size: 1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .sidebar a:hover {
        background-color: #34495e;
        transform: translateX(5px);
    }

    .dropdown {
        position: relative;
    }

    .dropdown-btn {
        background: none;
        border: none;
        color: white;
        text-align: left;
        padding: 12px 20px;
        width: 100%;
        cursor: pointer;
        font-size: 1rem;
        outline: none;
        transition: background-color 0.3s ease;
    }

    .dropdown-btn:hover {
        background-color: #34495e;
    }

    .dropdown-content {
        display: none;
        flex-direction: column;
        background-color: #34495e;
        padding-left: 20px;
    }

    .dropdown-content a {
        color: white;
        padding: 8px 0;
        text-decoration: none;
    }

    .dropdown-content a:hover {
        background-color: #3b5366;
    }

    .dropdown:hover .dropdown-content {
        display: flex;
    }

    /* Content */
    .content {
        margin-left: 270px;
        padding: 20px;
    }

    .content h2 {
        font-size: 2rem;
        color: #4CAF50;
        margin-bottom: 20px;
    }

    /* Stats Section */
    .stats {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .stat-card {
        flex: 1 1 calc(25% - 20px);
        background: linear-gradient(135deg, #1abc9c, #16a085);
        color: white;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .stat-card h2 {
        color: white;
        margin: 0;
        font-size: 2.5rem;
    }

    .stat-card p {
        margin: 5px 0 0;
        font-size: 1.1rem;
    }

    /* Cards Section */
    .card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card h3 {
        margin: 0 0 10px;
        color: #2c3e50;
    }

    .card p {
        color: #555;
        font-size: 1rem;
    }

    .card a {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background: #2c3e50;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .card a:hover {
        background: #1a252f;
    }

    /* Responsive Layout */
    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
            padding-top: 20px;
        }

        .content {
            margin-left: 0;
        }

        .stat-card {
            flex: 1 1 calc(50% - 20px);
        }

        .card {
            margin-bottom: 15px;
        }
    }

    @media (max-width: 576px) {
        .stat-card {
            flex: 1 1 100%;
        }

        .content {
            padding: 20px;
        }
    }
</style>

</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>

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
        <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
        <p>Here are some quick stats about your platform:</p>

        <div class="stats">
            <div class="stat-card">
                <h2><?php echo $total_users; ?></h2>
                <p>Total Users</p>
            </div>
            <div class="stat-card">
                <h2><?php echo $total_orders; ?></h2>
                <p>Total Orders</p>
            </div>
            <div class="stat-card">
                <h2><?php echo $pending_orders; ?></h2>
                <p>Pending Orders</p>
            </div>
            <!-- <div class="stat-card">
                <h2><?php echo $reviews; ?></h2>
                <p>Reports</p>
            </div> -->
        </div>

        <div class="card">
            <h3>Manage Users</h3>
            <p>View, edit, or remove users from the platform.</p>
            <a href="<?php echo site_url('admin/manage_users/0'); ?>">Go to User Management</a>
        </div>

        <div class="card">
            <h3>Manage Orders</h3>
            <p>View, edit, or remove orders from the platform.</p>
            <a href="<?php echo site_url('admin/manage_orders/0'); ?>">Go to Order Management</a>
        </div>

        <!-- <div class="card">
            <h3>View Reports</h3>
            <p>Access detailed reports and insights about your platform.</p>
            <a href="<?php echo site_url('admin/reports'); ?>">View Reports</a>
        </div> -->
    </div>
</body>
</html>
