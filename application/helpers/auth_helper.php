<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        $CI =& get_instance(); // Get CodeIgniter instance
        if (!$CI->session->userdata('user_id')) {
            redirect('auth/login'); // Redirect to login if not logged in
        }
    }
}
