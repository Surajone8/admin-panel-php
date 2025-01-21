<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
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

        .container {
            margin-left: 270px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            color: #333;
            text-align: center;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 15px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="datetime-local"],
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
            height: 80px;
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
        }

        button[type="submit"]:hover {
            background-color: #218838;
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
                width: 100%;
                height: auto;
                position: relative;
            }

            .container {
                margin-left: 0;
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

    <div class="container">
        <form method="post" action="<?= site_url('admin/manage_orders/edit/' . $order->id); ?>">
            <h1>Edit Order</h1>

            <label for="user_id">User ID</label>
            <input type="text" name="user_id" value="<?= $order->user_id; ?>" required>

            <label for="product_id">Product</label>
            <select name="product_id" required>
                <option value="">Select Product</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product->id; ?>" <?= $order->product_id == $product->id ? 'selected' : ''; ?>><?= $product->name; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" value="<?= $order->product_name; ?>" readonly>

            <label for="status">Status</label>
            <select name="status" required>
                <option value="Pending" <?= $order->status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="Processing" <?= $order->status == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                <option value="Shipped" <?= $order->status == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                <option value="Delivered" <?= $order->status == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                <option value="Cancelled" <?= $order->status == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>

            <label for="total_amount">Total Amount</label>
            <input type="text" name="total_amount" value="<?= $order->total_amount; ?>" required>

            <label for="order_date">Order Date</label>
            <input type="datetime-local" name="order_date" value="<?= date('Y-m-d\TH:i', strtotime($order->order_date)); ?>" required>

            <label for="shipping_address">Shipping Address</label>
            <textarea name="shipping_address" required><?= $order->shipping_address; ?></textarea>

            <label for="payment_status">Payment Status</label>
            <select name="payment_status" required>
                <option value="Pending" <?= $order->payment_status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="Paid" <?= $order->payment_status == 'Paid' ? 'selected' : ''; ?>>Paid</option>
                <option value="Failed" <?= $order->payment_status == 'Failed' ? 'selected' : ''; ?>>Failed</option>
            </select>

            <button type="submit">Update Order</button>
        </form>
    </div>
</body>
</html>
