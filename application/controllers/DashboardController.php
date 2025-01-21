<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        // Load the required models and helpers
        $this->load->model('DashboardModel');
        $this->load->helper('url');
    }

    public function index() {
        // is_logged_in();
        $data['user_name'] = $this->session->userdata('user_name');
        // Fetching dynamic data for dashboard from the model
        $data['total_users'] = $this->DashboardModel->get_total_users();
        $data['total_orders'] = $this->DashboardModel->get_total_orders();
        $data['pending_orders'] = $this->DashboardModel->get_pending_orders();
        $data['reviews'] = $this->DashboardModel->get_total_reviews();
        // var_dump($this->session->userdata());

        // Loading the view with dynamic data
        $this->load->view('admin/dashboard', $data);
    }


    public function users($offset = 0) {
        $this->load->library('pagination');
        $this->load->model('DashboardModel');

        // Pagination configuration
        $config['base_url'] = site_url('admin/manage_users');
        $config['total_rows'] = $this->DashboardModel->get_users_count(); // Add this method to count users
        $config['per_page'] = 5; // Adjust as needed
        $config['uri_segment'] = 3;
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

        // Get the offset and fetch paginated users
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users'] = $this->DashboardModel->get_paginated_users($config['per_page'], $page); // Add this method for pagination
        $data['pagination_links'] = $this->pagination->create_links();

        // echo '<pre>';
        // var_dump($data['pagination_links']);
        // echo '</pre>';

        // Calculate total pages
        $total_pages = ceil($config['total_rows'] / $config['per_page']);

        // Generate pagination buttons
        $data['pagination_buttons'] = [];
        for ($i = 1; $i <= $total_pages; $i++) {
            $data['pagination_buttons'][] = site_url('admin/manage_users/' . (($i - 1) * $config['per_page']));
        }

        $data['offset'] = $page;

        // Load the view
        $this->load->view('admin/manage_users', $data);
    }






    public function filter_by_status($status = 'Pending', $offset = 0) {
        // Load pagination library and model
        $this->load->library('pagination');
        $this->load->model('order_model');

        // Pagination configuration
        $config['base_url'] = site_url('admin/orders/status/' . $status); // Base URL for pagination links
        $config['total_rows'] = $this->order_model->get_orders_count_by_status($status); // Total rows for the given status
        $config['per_page'] = 5; // Number of items per page, adjust as needed
        $config['uri_segment'] = 5; // Page number will be passed in the 5th segment of the URL
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

        // Get the offset from URL and fetch paginated orders by status
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data['orders'] = $this->order_model->get_paginated_orders_by_status($status, $config['per_page'], $page); // Method for pagination
        $data['pagination_links'] = $this->pagination->create_links(); // Create pagination links

        // Calculate total pages
        $total_pages = ceil($config['total_rows'] / $config['per_page']);

        // Generate pagination buttons (optional)
        $data['pagination_buttons'] = [];
        for ($i = 1; $i <= $total_pages; $i++) {
            $data['pagination_buttons'][] = site_url('admin/orders/status/' . $status . '/' . (($i - 1) * $config['per_page']));
        }

        // Pass the current status to the view
        $data['status'] = ucfirst($status);

        // Load the view
        $this->load->view('admin/orders_by_status', $data);
    }



    public function orders() {
        // Logic for managing orders (e.g., fetching orders data from DB)
        $data['orders'] = $this->DashboardModel->get_all_orders();
        $this->load->view('admin/manage_orders', $data);
    }

    public function reviews() {
        // Logic for viewing reviews (e.g., fetching review data from DB)
        $data['reviews'] = $this->DashboardModel->get_reviews(); // Fetch reviews instead of reports
        $this->load->view('admin/view_reviews', $data);
    }


    public function logout() {
        // Logout logic (e.g., clearing session and redirecting to login page)
        $this->session->unset_userdata('user_data');
        redirect('auth/login');
    }


    public function reports() {
        // Logic for viewing reports (e.g., fetching report data from DB)
        $data['reports'] = $this->DashboardModel->get_reviews(); // Update as per your table
        $this->load->view('admin/view_reviews', $data);
    }

}
