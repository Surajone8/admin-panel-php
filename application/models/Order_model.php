<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function add_order($data) {
        return $this->db->insert('orders', $data);
    }

    public function update_order($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('orders', $data);
    }

    // public function get_orders_count() {
    //     return $this->db->count_all('orders');
    // }

    // public function get_orders_count($search_criteria = []) {
    //     if (!empty($search_criteria['order_id'])) {
    //         $this->db->like('order_id', $search_criteria['order_id']);
    //     }
    //     if (!empty($search_criteria['quantity'])) {
    //         $this->db->where('quantity', $search_criteria['quantity']);
    //     }
    //     if (!empty($search_criteria['user_email'])) {
    //         $this->db->like('user_email', $search_criteria['user_email']);
    //     }
    //     if (!empty($search_criteria['order_status'])) {
    //         $this->db->like('order_status', $search_criteria['order_status']);
    //     }
    //     $this->db->from('orders');

    //     return $this->db->count_all_results();
    // }


    // In Order_model.php
    // public function get_paginated_orders($limit, $offset, $search_query = '') {
    //     $this->db->select('*');
    //     $this->db->from('orders');
    //     $this->db->limit($limit, $offset);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    // public function get_paginated_orders($limit, $offset, $search_criteria = []) {
    //     $this->db->select('*');
    //     $this->db->from('orders');

    //     // Apply search filters if provided
    //     if (!empty($search_criteria['order_id'])) {
    //         $this->db->like('order_id', $search_criteria['order_id']);
    //     }
    //     if (!empty($search_criteria['quantity'])) {
    //         $this->db->where('quantity', $search_criteria['quantity']);
    //     }
    //     if (!empty($search_criteria['user_email'])) {
    //         $this->db->like('user_email', $search_criteria['user_email']);
    //     }
    //     if (!empty($search_criteria['order_status'])) {
    //         $this->db->like('order_status', $search_criteria['order_status']);
    //     }

    //     // Apply limit and offset for pagination
    //     $this->db->limit($limit, $offset);

    //     $query = $this->db->get();
    //     return $query->result(); // Return the result as an array of objects
    // }

    public function get_orders_count($search_criteria) {
        $this->db->from('orders');
        if ($search_criteria['order_id']) {
            $this->db->where('id', $search_criteria['order_id']);
        }
        if ($search_criteria['quantity']) {
            $this->db->where('quantity', $search_criteria['quantity']);
        }
        if ($search_criteria['user_email']) {
            $this->db->like('user_email', $search_criteria['user_email']);
        }
        if ($search_criteria['order_status']) {
            $this->db->where('status', $search_criteria['order_status']);
        }
        return $this->db->count_all_results();
    }

    public function get_paginated_orders($search_criteria, $limit, $offset) {
        $this->db->from('orders');

        if ($search_criteria['order_id']) {
            // Assuming the order ID is a numeric value, use LIKE to allow partial matching
            $this->db->where('id', $search_criteria['order_id']);
        }

        if ($search_criteria['quantity']) {
            // Allow partial matching for quantity if needed (though usually quantity is numeric)
            $this->db->where('quantity', $search_criteria['quantity']);
        }

        if ($search_criteria['user_email']) {
            // Case-insensitive search for user email
            $this->db->like('user_email', $search_criteria['user_email']);
        }

        if ($search_criteria['order_status']) {
            // Case-insensitive search for order status
            $this->db->like('status', $search_criteria['order_status']);
        }

        // Apply limit and offset for pagination
        $this->db->limit($limit, $offset);

        // echo '<pre>';
        // // Get the result set
        // $result = $this->db->get()->result();

        // // Output the total count of results
        // echo "Total Rows: " . count($result);
        // echo '</pre>';


        // Fetch results based on the modified query
        return $this->db->get()->result();

            }



// Method to get the count of orders by status
public function get_orders_count_by_status($status) {
    $this->db->where('status', $status);
    $query = $this->db->get('orders');
    return $query->num_rows();
}

// Method to fetch paginated orders by status
public function get_paginated_orders_by_status($status, $limit, $offset) {
    $this->db->where('status', $status);
    $this->db->limit($limit, $offset);
    $query = $this->db->get('orders');
    return $query->result();
}






    public function get_order_by_id($id) {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    // Delete an order
    public function delete_order($id) {
        $this->db->where('id', $id);
        return $this->db->delete('orders');
    }

    // public function get_orders_by_status($status) {
    //     $this->db->where('status', $status);
    //     $query = $this->db->get('orders');
    //     return $query->result();
    // }

    public function get_orders_by_status($status, $limit, $offset) {
        $this->db->where('status', $status);
        $this->db->limit($limit, $offset); // limit and offset are used here
        $query = $this->db->get('orders'); // Make sure 'orders' is the correct table name
        return $query->result();
    }

}
