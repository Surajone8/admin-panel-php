<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
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
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            transition: background-color 0.3s;
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

        .form-container {
            margin-left: 270px;
            padding: 20px;
            background-color: #ffffff;
            max-width: 800px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #343a40;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #343a40;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
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

<div class="form-container">
    <h2>Add New Product</h2>
    <form method="POST" action="<?= site_url('admin/manage_products/add'); ?>">
        <label for="category_id">Category</label>
        <select name="category_id" required>
            <!-- Dynamically load categories from database -->
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>

        <label for="name">Product Name</label>
        <input type="text" name="name" required>

        <label for="description">Description</label>
        <textarea name="description" rows="4" required></textarea>

        <label for="price">Price</label>
        <input type="number" name="price" step="0.01" required>

        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" name="stock_quantity" required>

        <label for="image_url">Image URL</label>
        <input type="text" name="image_url">

        <button type="submit">Add Product</button>
    </form>
</div>

</body>
</html>
