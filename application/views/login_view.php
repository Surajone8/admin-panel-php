<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Same as your signup form CSS, adjust as needed */
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php
        // Load the database library
        $this->load->database();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capture form inputs
            $email = htmlspecialchars($this->input->post('email'));
            $password = $this->input->post('password');

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

                    // Redirect to the dashboard or home page
                    // redirect('auth/signup');  // You can change 'dashboard' to your desired page
                } else {
                    // Password is incorrect
                    $this->session->set_flashdata('error', 'Invalid email or password.');
                }
            } else {
                // User not found
                $this->session->set_flashdata('error', 'Invalid email or password.');
            }
        }
        ?>

        <!-- Success or error message -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="message success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="message error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
