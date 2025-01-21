// app/Filters/AuthFilter.php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        // Check if the user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to(base_url('auth/login'));
        }

        // Check if the user is an admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('home')); // Redirect non-admin users
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something after the request is handled (optional)
    }
}
