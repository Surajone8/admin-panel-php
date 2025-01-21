<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth/register'] = 'AuthController/register';  // Handle form submission for registration
$route['auth/signup'] = 'AuthController/signup';      // Show the signup form

$route['auth/login'] = 'AuthController/login';   // Show login form
$route['auth/login_post'] = 'AuthController/login_post';  // Handle form submission for login
$route['dashboard'] = 'DashboardController/index';


$route['admin/manage_users/(:num)'] = 'DashboardController/users/$1'; // For managing users
$route['admin/orders'] = 'DashboardController/orders'; // For managing orders
$route['admin/reports'] = 'DashboardController/reports'; // For viewing reports
$route['auth/logout'] = 'AuthController/logout'; // For logout functionality


$route['admin/manage_users/edit/(:num)'] = 'admin/ManageUsersController/edit/$1';
$route['admin/manage_users/delete/(:num)'] = 'admin/ManageUsersController/delete/$1';

// Category actions (add, edit, delete) should come first
$route['admin/manage_categories/add'] = 'admin/CategoriesController/add';
$route['admin/manage_categories/edit/(:num)'] = 'admin/categoriescontroller/edit/$1';  // Edit category
$route['admin/manage_categories/delete/(:num)'] = 'admin/categoriescontroller/delete/$1';  // Delete category

// Pagination route should come last to avoid conflicts
$route['admin/manage_categories/(:num)'] = 'admin/categoriescontroller/index/$1';  // View categories


// Routes for product management
// $route['admin/manage_products'] = 'admin/ProductsController/index';           // Display the products
$route['admin/manage_products/(:num)'] = 'admin/ProductsController/index/$1'; // Pagination for products
$route['admin/manage_products/add'] = 'admin/ProductsController/add';         // Add a new product
$route['admin/manage_products/edit/(:num)'] = 'admin/ProductsController/edit/$1';  // Edit a product by ID
$route['admin/manage_products/delete/(:num)'] = 'admin/ProductsController/delete/$1'; // Delete a product by ID

// Routes for Order Management
$route['admin/manage_orders'] = 'admin/OrdersController/index'; // Display orders (no pagination initially)
$route['admin/manage_orders/(:num)'] = 'admin/OrdersController/index/$1';           // Display orders
$route['admin/manage_orders/add'] = 'admin/OrdersController/add';         // Add a new order
$route['admin/manage_orders/edit/(:num)'] = 'admin/OrdersController/edit/$1';  // Edit order
$route['admin/manage_orders/delete/(:num)'] = 'admin/OrdersController/delete/$1'; // Delete order
// $route['admin/orders/status/(:any)'] = 'admin/OrdersController/filter_by_status/$1';
$route['admin/orders/status/(:any)/(:num)'] = 'admin/OrdersController/filter_by_status/$1/$2';
$route['admin/orders/filter'] = 'admin/OrdersController/filter';
