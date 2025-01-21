// app/Controllers/AdminController.php

namespace App\Controllers;

class AdminController extends BaseController {

    public function dashboard() {
        // This page will only be accessible to logged-in admin users
        return view('admin/dashboard');
    }
}
