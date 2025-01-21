<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Header Styles */
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
        }

        /* Sidebar Styles */
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

        /* Main Content Styles */
        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .content h2 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
            color: #333;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:focus {
            outline: none;
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

        /* Responsive Layout */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                padding-top: 20px;
            }

            .content {
                margin-left: 0;
            }

            .content h2 {
                font-size: 1.5rem;
            }

            form {
                padding: 15px;
            }

            button {
                font-size: 1rem;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Edit Category</h1>
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
        <h2>Edit Category</h2>

        <form method="post">
            <label for="name">Category Name</label>
            <input type="text" name="name" value="<?php echo $category->name; ?>" required>

            <label for="description">Description</label>
            <textarea name="description" rows="4" required><?php echo $category->description; ?></textarea>

            <button type="submit">Update Category</button>
        </form>
    </div>
</body>
</html>
