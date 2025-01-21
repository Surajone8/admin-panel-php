<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the necessary libraries and helpers
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
        $this->load->model('UserModel');  // Load the UserModel
    }

    // Show the signup form
    public function signup() {
        $this->load->view('signup');
    }

    // Handle form submission for registration
    public function register() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Set validation rules
            $this->form_validation->set_rules([
                [
                    'field' => 'first_name',
                    'label' => 'First Name',
                    'rules' => 'required|min_length[3]'
                ],
                [
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'required|min_length[3]'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email]'
                ],
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[6]'
                ],
                [
                    'field' => 'phone',
                    'label' => 'Phone',
                    'rules' => 'permit_empty|min_length[10]|max_length[15]'
                ],
                [
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'permit_empty|min_length[5]'
                ]
            ]);

            // Check validation
            if ($this->form_validation->run() === FALSE) {
                $this->signup(); // Reload with validation errors
            } else {
                // Prepare user data
                $userData = [
                    'role' => 'customer',
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                ];

                if ($this->UserModel->insert($userData)) {
                    $this->session->set_flashdata('success', 'Registration successful! You can now log in.');
                    redirect('auth/login');
                } else {
                    $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                    $this->signup();
                }
            }
        }
    }

    // Show the login form
    public function login() {
        $this->load->view('login');
    }

    // Handle login form submission
    public function doLogin() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Capture and sanitize inputs
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Query the database for the user
            $user = $this->UserModel->getUserByEmail($email);

            if ($user) {
                // Verify the password
                if (password_verify($password, $user->password)) {
                    // Set session data
                    $this->session->set_userdata('user_id', $user->id);
                    $this->session->set_userdata('role', $user->role);
                    $this->session->set_userdata('user_name', $user->first_name . ' ' . $user->last_name);

                    $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $user->first_name . '.');
                    // $this->session->set_userdata('user_name', $user->first_name . ' ' . $user->last_name);
                    // var_dump($this->session->userdata());
                    redirect('dashboard'); // Redirect to dashboard or home page
                } else {
                    // Invalid password
                    $this->session->set_flashdata('error', 'Invalid email or password.');
                    redirect('auth/login');
                }
            } else {
                // User not found
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('auth/login');
            }
        }
    }

    public function logout() {
        // Clear all session data
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role');
        $this->session->sess_destroy(); // Completely destroy the session

        // Redirect to the login page
        redirect('auth/login');
    }


}
