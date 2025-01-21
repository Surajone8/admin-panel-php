<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('CategoryModel');
        $this->load->helper('url');
    }

    public function index($offset = 0) {
        $this->load->library('pagination');
        $this->load->model('Product_model');

        // Pagination configuration
        $config['base_url'] = site_url('admin/manage_products');
        $config['total_rows'] = $this->Product_model->get_products_count(); // Assuming you have this function in the model
        $config['per_page'] = 3; // Number of products per page
        $config['uri_segment'] = 3; // Pagination segment in the URL
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

        // Calculate the current page from the URI
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Fetch paginated products
        $data['products'] = $this->Product_model->get_paginated_products($config['per_page'], $page);
        $data['pagination_links'] = $this->pagination->create_links();

        // Calculate total pages
        $total_pages = ceil($config['total_rows'] / $config['per_page']);

        // Pagination buttons
        $data['pagination_buttons'] = [];
        for ($i = 1; $i <= $total_pages; $i++) {
            $data['pagination_buttons'][] = site_url('admin/manage_products/' . (($i - 1) * $config['per_page']));
        }

        // Pass data to view
        $this->load->view('admin/manage_products', $data);
    }


    public function add() {
        $data['categories'] = $this->CategoryModel->get_all_categories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_data = [
                'category_id' => $this->input->post('category_id'),
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'stock_quantity' => $this->input->post('stock_quantity'),
                'image_url' => $this->input->post('image_url'),
            ];
            $this->Product_model->add_product($product_data);
            redirect('admin/manage_products');
        }
        $this->load->view('admin/add_product', $data);
    }

    public function edit($id) {
        $data['product'] = $this->Product_model->get_product($id);
        $data['categories'] = $this->CategoryModel->get_all_categories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_data = [
                'category_id' => $this->input->post('category_id'),
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'stock_quantity' => $this->input->post('stock_quantity'),
                'image_url' => $this->input->post('image_url'),
            ];
            $this->Product_model->update_product($id, $product_data);
            redirect('admin/manage_products');
        }
        $this->load->view('admin/edit_product', $data);
    }

    public function delete($id) {
        $this->Product_model->delete_product($id);
        redirect('admin/manage_products');
    }
}
?>
