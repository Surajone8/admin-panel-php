<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUsersController extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('UserModel');
}

// Edit User
public function edit($id) {
    $data['user'] = $this->UserModel->get_user_by_id($id); // Fetch user data by ID
    if ($this->input->post()) {
        // var_dump($this->input->post('role'));
        // var_dump($_POST); // Dump the entire form data

        // Update the user data
        $updated_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role'),
        );

        // var_dump($updated_data);

        $this->UserModel->update_user($id, $updated_data);
        $this->load->helper('url');
        redirect('admin/manage_users');
    }
    $this->load->view('admin/edit_user', $data);  // Load the edit user view
}

// Delete User
public function delete($id) {
    $this->UserModel->delete_user($id);
    $this->load->helper('url');
    redirect('admin/manage_users');
}
}
