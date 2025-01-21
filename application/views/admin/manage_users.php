<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fc;
            color: #333;
        }

        .header {
            background-color: #4e73df;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
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
            box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: #f8f9fc;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .content h2 {
            font-size: 2rem;
            color: #4e73df;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #4e73df;
            color: white;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            font-size: 1rem;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* table tr:hover {
            background-color: #f1f1f1;
        } */

        /* Action Buttons */
        table td a {
            text-decoration: none;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 5px;
            margin: 0 5px;
            display: inline-block;
            font-size: 0.9rem;
        }

        table td a.edit-btn {
            background-color: #f6c23e;
            color: white;
        }

        table td a.edit-btn:hover {
            background-color: #e0a800;
        }

        table td a.delete-btn {
            background-color: #e74a3b;
            color: white;
        }

        table td a.delete-btn:hover {
            background-color: #c82333;
        }

        /* Add Button */
        .add-button-container {
            margin-top: 20px;
            text-align: right;
        }

        .add-user-button {
            background-color: #1cc88a;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .add-user-button:hover {
            background-color: #17a673;
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
                padding: 15px;
            }

            table th, table td {
                font-size: 0.9rem;
                padding: 10px;
            }

            .add-user-button {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manage Users</h1>
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
        <h2>User List</h2>
        <!-- <div class="add-button-container">
            <a href="<?php echo site_url('admin/manage_users/add'); ?>" class="add-user-button">Add User</a>
        </div> -->

        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
    <td><?= $user->id ?></td>
    <td><?= $user->first_name . ' ' . $user->last_name ?></td>
    <td><?= $user->email ?></td>
    <td><?= $user->phone ?></td>
</tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No users found.</td>
                </tr>
            <?php endif; ?>
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
    </div>
</body>
</html>
