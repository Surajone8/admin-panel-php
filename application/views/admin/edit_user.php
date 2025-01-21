<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            margin: 0;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            font-size: 1.8rem;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container input:focus,
        .form-container select:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-container button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 50px;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-btn {
            background: none;
            border: none;
            color: white;
            text-align: left;
            padding: 10px 20px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            outline: none;
            transition: background-color 0.3s;
        }

        .dropdown-btn:hover {
            background-color: #495057;
        }

        .dropdown-content {
            display: none;
            flex-direction: column;
            background-color: #495057;
            position: relative;
            padding-left: 20px;
        }

        .dropdown-content a {
            color: white;
            padding: 8px 0;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #6c757d;
        }

        .dropdown:hover .dropdown-content {
            display: flex;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                padding-top: 20px;
            }

            .content {
                margin-left: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Edit User</h1>
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
        <div class="form-container">
            <h2>Edit User</h2>
            <form method="post">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?php echo $user->first_name; ?>" required>

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?php echo $user->last_name; ?>" required>

                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $user->email; ?>" required>

                <label for="role">Role</label>
                <select name="role" required>
                    <option value="admin" <?php echo ($user->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="customer" <?php echo ($user->role == 'customer') ? 'selected' : ''; ?>>Customer</option>
                </select>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
