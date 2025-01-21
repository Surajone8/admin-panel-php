<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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

        .content {
            margin-left: 270px;
            padding: 20px;
        }

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

        .content h2 {
            font-size: 2rem;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            font-size: 1rem;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 0.9rem;
            margin: 0 5px;
            display: inline-block;
        }

        table td a.edit-btn {
            background-color: #ffc107;
            color: white;
        }

        table td a.edit-btn:hover {
            background-color: #e0a800;
        }

        table td a.delete-btn {
            background-color: #dc3545;
            color: white;
        }

        table td a.delete-btn:hover {
            background-color: #c82333;
        }

        /* Add Button Styles */
        .button-container {
            margin-top: 40px;
            text-align: center;
        }

        .button-container a {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1rem;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .button-container a:hover {
            background-color: #45a049;
            transform: scale(1.05);
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
    border: 1px solid black;
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

        /* Responsive Layout */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                padding-top: 20px;
            }

            .content {
                margin-left: 0;
            }

            table th, table td {
                font-size: 0.9rem;
                padding: 10px;
            }

            .button-container a {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manage Products</h1>
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
        <h2>Product List</h2>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $product->description; ?></td>
                    <td><?php echo $product->price; ?></td>
                    <td><?php echo $product->stock_quantity; ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/manage_products/edit/'.$product->id); ?>" class="edit-btn">Edit</a>
                        <a href="<?php echo site_url('admin/manage_products/delete/'.$product->id); ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <ul class="pagination">
            <?php foreach ($pagination_buttons as $index => $button): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $button ?>">
                        <?= ($button == current_url()) ? 'Current' : ($index + 1) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>


        <div class="button-container">
            <a href="<?php echo site_url('admin/manage_products/add'); ?>" class="add-category-button">Add New Product</a>
        </div>
    </div>
</body>
</html>
