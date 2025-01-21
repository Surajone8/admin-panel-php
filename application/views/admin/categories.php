<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
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

        .content h2 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px 20px;
            text-align: left;
            font-size: 1rem;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        table td {
            background-color: #fff;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:nth-child(even) td {
            background-color: #f8f9fa;
        }

        table tr:hover td {
            background-color: #e9ecef;
            color: #007bff;
            transition: all 0.3s ease;
        }

        table td a {
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            margin: 0 5px;
            display: inline-block;
        }

        table td a.edit-btn {
            background-color: #17a2b8;
            color: white;
        }

        table td a.edit-btn:hover {
            background-color: #138496;
        }

        table td a.delete-btn {
            background-color: #dc3545;
            color: white;
        }

        table td a.delete-btn:hover {
            background-color: #bd2130;
        }

        /* Button Styles */
        .button-container {
            margin-top: 40px;
            text-align: center;
        }

        .button-container a {
            text-decoration: none;
        }

        .add-category-button {
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
        }

        .add-category-button:hover {
            background-color: #218838;
        }

        /* Button Styling Inside Table */
        table td .action-buttons {
            display: flex;
            gap: 10px;
        }

        table td a {
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            text-align: center;
        }

        table td a.edit-btn {
            background-color: #17a2b8;
            color: white;
        }

        table td a.edit-btn:hover {
            background-color: #138496;
        }

        table td a.delete-btn {
            background-color: #dc3545;
            color: white;
        }

        table td a.delete-btn:hover {
            background-color: #bd2130;
        }

        /* Dropdown Styles */
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

        .actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .actions button {
        font-size: 14px;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .actions .edit {
        background-color: #28a745;
        color: white;
    }

    .actions .edit:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .actions .delete {
        background-color: #dc3545;
        color: white;
    }

    .actions .delete:hover {
        background-color: #c82333;
        transform: translateY(-2px);
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
                font-size: 1rem;
                padding: 10px;
            }

            .add-category-button {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manage Categories</h1>
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
        <h2>Category List</h2>

        <!-- Categories Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category->id ?></td>
                <td><?= $category->name ?></td>
                <td><?= $category->description ?></td>
                <td class="actions">
    <button class="edit" onclick="window.location.href='<?= site_url('admin/manage_categories/edit/' . $category->id); ?>'">Edit</button>
    <button class="delete" onclick="if(confirm('Are you sure you want to delete this category?')) window.location.href='<?= site_url('admin/manage_categories/delete/' . $category->id); ?>'">Delete</button>
</td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination Links -->
    <ul class="pagination">
        <?php if (isset($pagination_buttons) && is_array($pagination_buttons)): ?>
            <?php foreach ($pagination_buttons as $button): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $button ?>">
                        <?= ($button == current_url()) ? 'Current' : (array_search($button, $pagination_buttons) + 1) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>





        <div class="button-container">
            <a href="<?php echo site_url('admin/manage_categories/add'); ?>" class="add-category-button">Add New Category</a>
        </div>
    </div>
</body>
</html>
