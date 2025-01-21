<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Insert user data into the database
    public function insert($data) {
        return $this->db->insert('users', $data);  // Insert data into the 'users' table
    }

    // Get a user by ID
    public function get_user_by_id($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row();
    }

    // Update user data
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        // $this->db->last_query(); // This will output the last query executed.
        return $this->db->update('users', $data);
    }

    // Delete user
    public function delete_user($id) {
        return $this->db->delete('users', array('id' => $id));
    }

    public function get_all_users() {
        $query = $this->db->get('users'); // Replace 'users' with your table name
        return $query->result(); // Return all users as an array of objects
    }
}
