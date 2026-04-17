<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Authentication Controller for Admin Panel
 */
class AuthController extends BaseController
{
    /**
     * Display user profile
     */
    public function profile()
    {
        $data = [
            'title' => 'Profile Settings',
            'user' => [
                'name' => 'Adi',
                'email' => 'adi@example.com',
                'role' => 'Administrator'
            ]
        ];
        
        return view('dashboard/profile', $data);
    }

    /**
     * Update user profile
     */
    public function updateProfile()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update user in database
        return redirect()->to('/admin/profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Logout user
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Successfully logged out!');
    }
}
