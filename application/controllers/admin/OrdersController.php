<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('order_model'); // Load the order model
        $this->load->model('UserModel');
    }

    // Display all orders
    public function index($offset = 0) {
        $this->load->library('pagination');
        $this->load->model('order_model');

        // Get search criteria from the query string
        $search_criteria = [
            'order_id' => $this->input->get('order_id', TRUE),
            'quantity' => $this->input->get('quantity', TRUE),
            'user_email' => $this->input->get('user_email', TRUE),
            'order_status' => $this->input->get('order_status', TRUE),
        ];

        // Calculate the total number of rows based on the filtered criteria
        $total_rows = $this->order_model->get_orders_count($search_criteria);

        // Pagination configuration
        $config['base_url'] = site_url('admin/manage_orders'); // Base URL for pagination
        $config['total_rows'] = $total_rows; // Use the filtered row count
        $config['per_page'] = 5; // Number of records per page
        $config['reuse_query_string'] = TRUE; // Preserve search query in pagination links
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];

        // Initialize pagination
        $this->pagination->initialize($config);

        // Get paginated orders with the correct offset
        $data['orders'] = $this->order_model->get_paginated_orders($search_criteria, $config['per_page'], $offset);

        // Generate pagination links using CodeIgniter's built-in method
        $data['pagination_links'] = $this->pagination->create_links();
        // echo $data['pagination_links'];
        // echo '<pre>';
        // var_dump($data['pagination_links']);
        // echo '</pre>';

        $total_rows = $this->order_model->get_orders_count($search_criteria);
        // echo '<pre>';
        // echo "Total Rows: " . $total_rows;
        // echo '</pre>';



        // Pass the search criteria and orders to the view
        $data['search_criteria'] = $search_criteria;

        // Load the view
        $this->load->view('admin/manage_orders', $data);
    }










    // Add a new order
    public function add() {
        // Fetch products and users to display in the dropdown
        $data['products'] = $this->Product_model->get_products(); // Get the list of products
        $data['users'] = $this->UserModel->get_all_users(); // Get the list of users

        if ($this->input->post()) {
            // Gather data from the form submission
            $product_id = $this->input->post('product_id'); // Get selected product_id
            $product_name = $this->Product_model->get_product_name_by_id($product_id); // Get the product name using product_id

            // Prepare the data for insertion into the orders table
            $order_data = [
                'user_id' => $this->input->post('user_id'),
                'status' => 'Pending',
                'total_amount' => $this->input->post('total_amount'),
                'order_date' => date('Y-m-d H:i:s'),
                'shipping_address' => $this->input->post('shipping_address'),
                'payment_status' => $this->input->post('payment_status'),
                'product_id' => $product_id,  // Use the selected product_id
                'product_name' => $product_name, // Get the product name based on product_id
                'quantity' => $this->input->post('quantity'), // Include quantity
                'user_email' => $this->input->post('user_email'),
            ];

            // Add the new order
            $this->order_model->add_order($order_data);

            // Redirect after adding the order
            redirect('admin/manage_orders');
        }

        // Load the view to show the order form
        $this->load->view('admin/add_order', $data);
    }

    // Edit an order
    public function edit($id) {
        // Fetch products to display in the dropdown
        $data['products'] = $this->Product_model->get_products();
        $data['order'] = $this->order_model->get_order_by_id($id);

        if ($this->input->post()) {
            $updated_data = [
                'user_id' => $this->input->post('user_id'),
                'status' => $this->input->post('status'),
                'total_amount' => $this->input->post('total_amount'),
                'shipping_address' => $this->input->post('shipping_address'),
                'payment_status' => $this->input->post('payment_status'),
                'product_id' => $this->input->post('product_id'),
                'product_name' => $this->input->post('product_name'),
            ];
            $this->order_model->update_order($id, $updated_data);
            redirect('admin/manage_orders/0');
        }

        $this->load->view('admin/edit_order', $data);
    }

    // Delete an order
    public function delete($id) {
        $this->order_model->delete_order($id);
        redirect('admin/manage_orders/0');
    }

    // Filter orders by status
    public function filter_by_status($status = 'Pending', $offset = 0) {
        $this->load->library('pagination');
        $this->load->model('Order_model'); // Ensure the model is loaded

        // Pagination configuration
        $config['base_url'] = site_url('admin/orders/status/' . $status);  // Correct base_url to include status
        $config['total_rows'] = $this->Order_model->get_orders_count_by_status($status);
        $config['per_page'] = 5;
        $config['uri_segment'] = 5; // This matches the offset segment in the URL

        // Pagination configuration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];

        $this->pagination->initialize($config);

        // Get the orders for the current page
        $data['orders'] = $this->Order_model->get_orders_by_status($status, $config['per_page'], $offset);
        $data['status'] = ucfirst($status);
        $data['pagination_links'] = $this->pagination->create_links();

        // Generate pagination buttons
        $total_pages = ceil($config['total_rows'] / $config['per_page']);
        $data['pagination_buttons'] = [];
        for ($i = 1; $i <= $total_pages; $i++) {
            $data['pagination_buttons'][] = site_url('admin/orders/status/' . $status . '/' . (($i - 1) * $config['per_page']));
        }

        $this->load->view('admin/orders_by_status', $data);
    }


    // public function filter() {
    //     // Get filter parameters from the request
    //     $order_id = $this->input->get('order_id');
    //     $quantity = $this->input->get('quantity');
    //     $user_email = $this->input->get('user_email');
    //     $order_status = $this->input->get('order_status');

    //     // Build the query for filtering orders
    //     $this->db->like('id', $order_id);
    //     $this->db->like('quantity', $quantity);
    //     $this->db->like('user_email', $user_email);
    //     $this->db->like('status', $order_status);

    //     // Fetch the filtered orders
    //     $query = $this->db->get('orders');
    //     $orders = $query->result();

    //     // Prepare the response data
    //     $response = [
    //         'orders' => $orders,
    //         'pagination_buttons' => $pagination_buttons
    //     ];

    //     // Return the response as JSON
    //     echo json_encode($response);
    // }






}
