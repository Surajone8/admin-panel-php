<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            max-width: 500px;
            width: 100%;
        }
        .form-container label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }
        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-container textarea {
            resize: none;
        }
        .form-container button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .hidden {
            display: none;
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
    </style>
    <script>
        // Function to calculate total amount
        function calculateTotal() {
            const productSelect = document.querySelector('select[name="product_id"]');
            const quantityInput = document.querySelector('input[name="quantity"]');
            const totalAmountInput = document.querySelector('input[name="total_amount"]');

            const selectedProductId = productSelect.value;
            const quantity = parseInt(quantityInput.value) || 1; // Default to 1 if no value entered

            if (selectedProductId && quantity > 0) {
                const selectedProduct = products.find(product => product.id == selectedProductId);
                if (selectedProduct) {
                    const price = parseFloat(selectedProduct.price); // Get price of the selected product
                    const totalAmount = price * quantity;
                    totalAmountInput.value = totalAmount.toFixed(2); // Display total amount with 2 decimal places
                }
            }
        }

        // Function to set current date and time in the order_date field and enforce min date
        function setCurrentDateTime() {
            const orderDateInput = document.querySelector('input[name="order_date"]');
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

            // Set the min attribute to enforce no past dates
            orderDateInput.min = currentDateTime;

            // Set the value to the current date and time
            orderDateInput.value = currentDateTime;
        }

        // This will be replaced by PHP data (product_id, price, user_id, email)
        const products = <?php echo json_encode($products); ?>;
        const users = <?php echo json_encode($users); ?>;

        document.addEventListener('DOMContentLoaded', function () {
            // Populate product dropdown with products
            const productSelect = document.querySelector('select[name="product_id"]');
            products.forEach(product => {
                const option = document.createElement('option');
                option.value = product.id;
                option.textContent = product.name;
                productSelect.appendChild(option);
            });

            // Populate user dropdown with users
            const userSelect = document.querySelector('select[name="user_id"]');
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.email;
                userSelect.appendChild(option);
            });

            // Event listener to calculate total amount when product or quantity changes
            productSelect.addEventListener('change', calculateTotal);
            document.querySelector('input[name="quantity"]').addEventListener('input', calculateTotal);

            // Set current date and time in the order_date field
            setCurrentDateTime();

            // Event listener for user selection to fill in the email field
            userSelect.addEventListener('change', function() {
                const selectedUser = users.find(user => user.id == userSelect.value);
                if (selectedUser) {
                    document.getElementById('user_email').value = selectedUser.email; // Populate hidden email field
                }
            });
        });
    </script>
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
        <h1>Add New Order</h1>
        <form method="post" action="<?= site_url('admin/manage_orders/add'); ?>">
            <label for="user_id">User</label>
            <select name="user_id" required>
                <option value="">Select User</option>
                <!-- Users will be dynamically added here by JavaScript -->
            </select>

            <label for="product_id">Product</label>
            <select name="product_id" required>
                <option value="">Select Product</option>
                <!-- Products will be dynamically added here by JavaScript -->
            </select>

            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" value="1" min="1" required>

            <!-- <label for="status">Status</label>
            <select name="status" required>
                <option value="Pending">Pending</option>
                <option value="Processing">Processing</option>
                <option value="Shipped">Shipped</option>
                <option value="Delivered">Delivered</option>
            </select> -->

            <label for="total_amount">Total Amount</label>
            <input type="text" name="total_amount" readonly required>

            <label for="order_date">Order Date</label>
            <input type="datetime-local" name="order_date" required>

            <label for="shipping_address">Shipping Address</label>
            <textarea name="shipping_address" required></textarea>

            <label for="payment_status">Payment Status</label>
            <select name="payment_status" required>
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
                <option value="Failed">Failed</option>
            </select>

            <!-- Hidden email input to store email -->
            <input type="hidden" name="user_email" id="user_email">

            <button type="submit">Add Order</button>
        </form>
    </div>
</body>
</html>
