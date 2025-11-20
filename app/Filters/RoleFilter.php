<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = $session->get('role');

        if (!$role) {
            return redirect()->to('/login');
        }

        if ($arguments && !in_array($role, $arguments)) {
            // User does not have the required role
            // For now, redirect to dashboard or show unauthorized
            return redirect()->to('/admin/dashboard')->with('error', 'Access Denied');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
