<?php namespace App\Controllers\Auth;

use App\Controllers\BaseController;

/**
 * Login Controller
 * Handles user authentication
 */
class LoginController extends BaseController
{
    /**
     * Display login page
     */
    public function index()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin');
        }

        $data = [
            'title' => 'Login - Admin Panel'
        ];
        
        return view('auth/login', $data);
    }

    /**
     * Process login authentication
     */
    public function authenticate()
    {
        // Validate input
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // TODO: Replace with actual database lookup
        // For demo purposes, use hardcoded credentials
        // In production: fetch user from UserModel and verify password with password_verify()
        
        $demoEmail = 'admin@example.com';
        $demoPassword = 'admin123';

        if ($email === $demoEmail && $password === $demoPassword) {
            // Set session data
            session()->set([
                'isLoggedIn' => true,
                'user_id' => 1,
                'email' => $email,
                'name' => 'Admin User',
                'role' => 'administrator'
            ]);

            // Redirect to intended page or dashboard
            $redirectUrl = session()->get('redirect_url') ?? '/admin';
            session()->remove('redirect_url');
            
            return redirect()->to($redirectUrl)->with('success', 'Welcome back!');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password');
    }
}
