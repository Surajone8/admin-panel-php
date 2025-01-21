<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert category into the database
    public function insert_category($data) {
        $this->db->insert('categories', $data);
    }

    public function get_all_categories() {
        return $this->db->get('categories')->result();  // Fetch all categories from the categories table
    }

    // Get category by ID
    public function get_category_by_id($id) {
        return $this->db->get_where('categories', array('id' => $id))->row();  // Get category data by ID
    }

    // Update category data
    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);  // Update category data
    }

    // Delete category
    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categories');  // Delete category by ID
    }

    public function get_categories_paginated($limit, $offset) {
        $this->db->limit($limit, $offset);  // Apply limit and offset
        $query = $this->db->get('categories');  // 'categories' is your table name
        return $query->result();
    }

    public function get_categories_count() {
        $query = $this->db->get('categories');
        return $query->num_rows();
    }


}
