<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize form values
$first_name = $last_name = $email = $password = $phone = $address = '';
$role = 'customer';  // Default role

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and capture form inputs
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    // Check if the admin checkbox is checked
    if (isset($_POST['role']) && $_POST['role'] == 'admin') {
        $role = 'admin';
    }

    // Load the database library
    $this->load->database();

    // SQL query to insert user data
    $data = array(
        'role' => $role,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => $password,
        'phone' => $phone,
        'address' => $address
    );

    // Insert the data into the 'users' table
    $this->db->insert('users', $data);

    // Check if the query was successful
    if ($this->db->affected_rows() > 0) {
        // Set a success flash message
        $this->session->set_flashdata('success', 'Signup successful! Welcome to our platform.');

        // Redirect back to the signup page
        redirect('auth/signup'); // Redirects to the same page
    } else {
        // Set an error flash message
        $this->session->set_flashdata('error', 'Error occurred while signing up. Please try again.');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: left;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            text-align: left;
        }

        input, textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"], input[type="email"], input[type="password"], textarea {
            height: 40px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .message {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Signup</h2>

        <!-- Success or error message -->
        <?php if ($this->session->flashdata('success')): ?>
            <script>
                // Display success alert and redirect
                alert("<?php echo $this->session->flashdata('success'); ?>");
                window.location.href = "<?php echo site_url('auth/login'); ?>";
            </script>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="message error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Signup Form -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address"><?php echo $address; ?></textarea>
            </div>

            <!-- Admin role checkbox -->
            <div class="form-group">
                <label for="role">Admin:</label>
                <input type="checkbox" id="role" name="role" value="admin">
                <span>Check if you want to sign up as an admin</span>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
