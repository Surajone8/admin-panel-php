<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding: 20px 10px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #0056b3;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-btn {
            background: none;
            border: none;
            color: white;
            text-align: left;
            padding: 10px 15px;
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
            padding-left: 15px;
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        form {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        form h2 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 15px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .form-container {
                margin-left: 0;
                padding: 10px;
            }

            form {
                padding: 20px;
            }
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
    <form method="POST" action="<?= site_url('admin/manage_products/edit/'.$product->id); ?>">
        <h2>Edit Product</h2>
        <label for="category_id">Category</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>" <?= $category->id == $product->category_id ? 'selected' : '' ?>><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>

        <label for="name">Product Name</label>
        <input type="text" name="name" value="<?= $product->name ?>" required>

        <label for="description">Description</label>
        <textarea name="description" rows="4" required><?= $product->description ?></textarea>

        <label for="price">Price</label>
        <input type="number" name="price" value="<?= $product->price ?>" step="0.01" required>

        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" name="stock_quantity" value="<?= $product->stock_quantity ?>" required>

        <label for="image_url">Image URL</label>
        <input type="text" name="image_url" value="<?= $product->image_url ?>">

        <button type="submit">Save Changes</button>
    </form>
</div>

</body>
</html>
