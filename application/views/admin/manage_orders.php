

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            margin: 5px 0;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #0056b3;
            border-left: 4px solid #fff;
            font-weight: bold;
            padding-left: 16px;
        }

        .dropdown {
            margin: 5px 0;
        }

        .dropdown-btn {
            display: block;
            background-color: #343a40;
            color: white;
            border: none;
            text-align: left;
            width: 100%;
            padding: 12px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropdown-btn:hover {
            background-color: #0056b3;
        }

        .dropdown-content {
            display: none;
            background-color: #23272b;
            padding-left: 15px;
        }

        .dropdown-content a {
            font-size: 14px;
        }

        .dropdown-content a:hover {
            color: #c7dfff;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            margin-top: 20px;
            margin-left: 260px;
            flex: 1;
            max-width: calc(100% - 270px);
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007BFF;
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .add-order {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .add-order:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 16px 12px;
        border: 1px solid #ddd;
        font-size: 14px;
        text-align: center;
    }

    table th {
        background-color: #007BFF;
        color: white;
        text-transform: uppercase;
        font-weight: bold;
        text-align: center;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f5fc;
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

input{
    margin: auto;
    width: 300px;
}

/* General container styling */
#filter-form {
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap */
    gap: 15px;
    max-width: 100%; /* Ensure full width */
    margin: 20px auto;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Input and select field styling */
#filter-form input,
#filter-form select {
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
    flex: 1; /* Make inputs and select fill available space */
    min-width: 150px; /* Prevent shrinking too small */
}

/* Input focus effect */
#filter-form input:focus,
#filter-form select:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
}

/* Button styling */
button {
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

/* Button hover effect */
button:hover {
    background-color: #0056b3;
}

/* Optional for responsiveness on smaller screens */
@media (max-width: 600px) {
    #filter-form {
        flex-direction: column; /* Stack inputs on mobile */
    }

    button {
        width: 100%;
    }
}



        /* .actions .delete:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        } */

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .container {
                margin-left: 220px;
                padding: 15px;
            }

            table th, table td {
                font-size: 12px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<!-- Sidebar Menu -->
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
    <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
</div>

<div class="container">
    <h1>Manage Orders</h1>
    <a href="<?= site_url('admin/manage_orders/add'); ?>" class="add-order">Add New Order</a>

    <!-- Filter Form -->
    <form id="filter-form">
        <input type="text" id="order_id" name="order_id" value="<?= isset($search_criteria['order_id']) ? $search_criteria['order_id'] : '' ?>" placeholder="Order ID">
        <input type="number" id="quantity" name="quantity" value="<?= isset($search_criteria['quantity']) ? $search_criteria['quantity'] : '' ?>" placeholder="Quantity">
        <input type="text" id="user_email" name="user_email" value="<?= isset($search_criteria['user_email']) ? $search_criteria['user_email'] : '' ?>" placeholder="User Email">
        <select id="order_status" name="order_status">
            <option value="">Select Status</option>
            <option value="Pending" <?= isset($search_criteria['order_status']) && $search_criteria['order_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Shipped" <?= isset($search_criteria['order_status']) && $search_criteria['order_status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
            <option value="Delivered" <?= isset($search_criteria['order_status']) && $search_criteria['order_status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
            <option value="Cancelled" <?= isset($search_criteria['order_status']) && $search_criteria['order_status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
            <option value="Processing" <?= isset($search_criteria['order_status']) && $search_criteria['order_status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
        </select>
    </form>

    <button onclick="applyFilters()">Filter</button>

    <!-- Orders Table -->
    <table id="ordersTable">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>User Email</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Shipping Address</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order->id; ?></td>
                        <td><?= $order->user_id; ?></td>
                        <td><?= isset($order->user_email) ? $order->user_email : 'N/A'; ?></td>
                        <td><?= $order->quantity; ?></td>
                        <td><?= $order->total_amount; ?></td>
                        <td><?= $order->status; ?></td>
                        <td><?= $order->order_date; ?></td>
                        <td><?= $order->shipping_address; ?></td>
                        <td><?= $order->payment_status; ?></td>
                        <td class="actions">
                            <button class="edit" onclick="window.location.href='<?= site_url('admin/manage_orders/edit/' . $order->id); ?>'">Edit</button>
                            <button class="delete" onclick="if(confirm('Are you sure you want to delete this order?')) window.location.href='<?= site_url('admin/manage_orders/delete/' . $order->id); ?>'">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div id="pagination">
        <?php echo $pagination_links; ?>
    </div>
</div>

<script>
    let debounceTimeout;

document.addEventListener('DOMContentLoaded', function() {
    // Attach event listeners to inputs for real-time filtering
    document.getElementById('order_id').addEventListener('input', debounce(applyFilters, 100)); // 500ms debounce
    document.getElementById('quantity').addEventListener('input', debounce(applyFilters, 100));
    document.getElementById('user_email').addEventListener('input', debounce(applyFilters, 500));
    document.getElementById('order_status').addEventListener('change', debounce(applyFilters, 100));
});

function debounce(func, delay) {
    return function() {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(func, delay);
    };
}

function applyFilters() {
    // Get filter values
    const orderId = document.getElementById('order_id').value;
    const quantity = document.getElementById('quantity').value;
    const userEmail = document.getElementById('user_email').value;
    const orderStatus = document.getElementById('order_status').value;

    // Update the URL dynamically using pushState
    const url = new URL(window.location.href);
    url.searchParams.set('order_id', orderId);
    url.searchParams.set('quantity', quantity);
    url.searchParams.set('user_email', userEmail);
    url.searchParams.set('order_status', orderStatus);
    history.pushState(null, '', url);

    // Make AJAX request to fetch filtered data
    fetchFilteredData(orderId, quantity, userEmail, orderStatus);
}

function fetchFilteredData(orderId, quantity, userEmail, orderStatus) {
    // Construct the AJAX URL with filter parameters
    const requestUrl = `<?php echo site_url('admin/manage_orders') ?>?order_id=${orderId}&quantity=${quantity}&user_email=${userEmail}&order_status=${orderStatus}`;

    // Perform the AJAX request
    fetch(requestUrl)
        .then(response => response.text())
        .then(data => {
            // Parse the HTML and update the table and pagination
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, 'text/html');
            const newTableBody = doc.querySelector('#ordersTable tbody');
            const newPagination = doc.querySelector('#pagination');

            // Replace the existing table and pagination with the updated content
            document.querySelector('#ordersTable tbody').innerHTML = newTableBody.innerHTML;
            document.querySelector('#pagination').innerHTML = newPagination.innerHTML;
        });
}

</script>

</body>
</html>
