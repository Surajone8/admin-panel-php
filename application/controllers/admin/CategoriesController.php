<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CategoryModel');
        $this->load->helper('url');
    }

    // Add Category
    public function add() {
        if ($this->input->post()) {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            // Call model to insert data
            $this->CategoryModel->insert_category($data);

            // Redirect to the category list page or another page after adding
            $this->load->helper('url');
            redirect('admin/manage_categories');
        }

        // Load the add category view
        $this->load->view('admin/add_category');
    }

    public function index($offset = 0) {
        $this->load->library('pagination');
        $this->load->model('CategoryModel');

        // Pagination configuration
        $config['base_url'] = site_url('admin/manage_categories');
        $config['total_rows'] = $this->CategoryModel->get_categories_count(); // Get total number of categories
        $config['per_page'] = 4;  // Set per_page to 2
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

        // Fetch categories with offset
        $data['categories'] = $this->CategoryModel->get_categories_paginated($config['per_page'], $offset);
        $data['pagination_links'] = $this->pagination->create_links();

        // Calculate total pages
        $total_pages = ceil($config['total_rows'] / $config['per_page']);

        // Generate pagination buttons
        $data['pagination_buttons'] = [];
        for ($i = 1; $i <= $total_pages; $i++) {
            $data['pagination_buttons'][] = site_url('admin/manage_categories/' . (($i - 1) * $config['per_page']));
        }

        // Pass the offset to the view
        $data['offset'] = $offset;

        // Load the view with categories and pagination data
        $this->load->view('admin/categories', $data);
    }




    public function edit($id) {
        // Fetch category data by ID
        $data['category'] = $this->CategoryModel->get_category_by_id($id);

        if ($this->input->post()) {
            // Update category data
            $updated_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
            );
            $this->CategoryModel->update_category($id, $updated_data);
            redirect('admin/manage_categories');  // Redirect to categories list
        }

        // Load the edit category view with the data
        $this->load->view('admin/edit_category', $data);
    }

    // Delete Category
    public function delete($id) {
        $this->CategoryModel->delete_category($id);  // Call delete method from the model
        redirect('admin/manage_categories');  // Redirect to categories list
    }
}
