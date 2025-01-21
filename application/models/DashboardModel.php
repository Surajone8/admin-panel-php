<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get total users count
    public function get_total_users() {
        $query = $this->db->count_all('users'); // Assuming you have a 'users' table
        return $query;
    }

    // Get total orders count
    public function get_total_orders() {
        $query = $this->db->count_all('orders'); // Assuming you have an 'orders' table
        return $query;
    }

    // Get pending orders count
    public function get_pending_orders() {
        $this->db->where('status', 'Pending'); // Assuming orders have a 'status' field
        $query = $this->db->count_all_results('orders');
        return $query;
    }

    // Get total reviews count (e.g., feedback or issues reported)
    public function get_total_reviews() {
        $this->db->from('reviews'); // Replace 'reviews' with your table name
        return $this->db->count_all_results(); // Count the number of rows
    }

    public function get_all_users() {
        $query = $this->db->get('users'); // Replace 'users' with your table name
        return $query->result(); // Return all users as an array of objects
    }

    public function get_all_orders() {
        $query = $this->db->get('orders'); // Assuming you have a 'users' table
        return $query->result();
    }

    public function get_reviews() {
        $query = $this->db->get('reviews'); // Assuming you have a 'users' table
        return $query->result();
    }

    public function get_users_count() {
        $this->db->from('users');
        return $this->db->count_all('users'); // Replace 'users' with your actual table name
    }

    public function get_paginated_users($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('users'); // Replace 'users' with your actual table name
        return $query->result();
    }


}
