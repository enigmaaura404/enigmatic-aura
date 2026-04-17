<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * Auth Filter - Protect admin routes
 * Redirects unauthenticated users to login page
 */
class AuthFilter implements FilterInterface
{
    /**
     * Check if user is logged in before accessing protected routes
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in (session-based auth)
        if (!session()->get('isLoggedIn')) {
            // Store the current URL to redirect back after login
            session()->set('redirect_url', current_url());
            
            return redirect()->to('/auth/login');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
