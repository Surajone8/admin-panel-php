<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_products() {
        return $this->db->get('products')->result();
    }

    public function add_product($data) {
        $this->db->insert('products', $data);
    }

    public function get_product($id) {
        return $this->db->get_where('products', ['id' => $id])->row();
    }

    public function update_product($id, $data) {
        $this->db->update('products', $data, ['id' => $id]);
    }

    public function delete_product($id) {
        $this->db->delete('products', ['id' => $id]);
    }

    public function get_product_name_by_id($product_id) {
        // Fetch product name based on product_id
        $this->db->select('name');
        $this->db->from('products');
        $this->db->where('id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->name; // Return the product name
        }
        return ''; // Return an empty string if no product found
    }

    // Method to get total count of products
public function get_products_count() {
    return $this->db->count_all('products');
}

// Method to fetch products with pagination
public function get_paginated_products($limit, $offset) {
    return $this->db->get('products', $limit, $offset)->result();
}


}
?>
