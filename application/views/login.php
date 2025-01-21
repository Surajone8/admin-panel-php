<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$email = $password = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and capture form inputs
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Load the database library
    $this->load->database();

    // Query the database for the user with the given email
    $query = $this->db->get_where('users', array('email' => $email));

    // Check if the user exists
    if ($query->num_rows() > 0) {
        $user = $query->row();

        // Verify the password
        if (password_verify($password, $user->password)) {
            // Set session data for logged-in user
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('role', $user->role);
            $this->session->set_userdata('user_name', $user->first_name . ' ' . $user->last_name);

            // Set success message
            $message = '<div class="success">Login successful! Welcome back, ' . htmlspecialchars($user->first_name) . '.</div>';

            // Clear form fields
            $email = '';
            $password = '';

            $this->load->helper('url');
    redirect('dashboard');
        } else {
            // Invalid password
            $message = '<div class="error">Invalid email or password. Please try again.</div>';
        }
    } else {
        // User not found
        $message = '<div class="error">Invalid email or password. Please try again.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <!-- Display success or error message -->
        <?php echo $message; ?>

        <!-- Login Form -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="signup">Sign up here</a></p>
        </div>
    </div>
</body>
</html>
