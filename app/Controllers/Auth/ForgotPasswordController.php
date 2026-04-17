<?php namespace App\Controllers\Auth;

use App\Controllers\BaseController;

/**
 * Forgot Password Controller
 */
class ForgotPasswordController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Forgot Password'];
        return view('auth/forgot-password', $data);
    }

    public function sendLink()
    {
        $rules = ['email' => 'required|valid_email'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // TODO: Send password reset email
        // In production: generate token, save to DB, send email

        return redirect()->to('/auth/forgot-password')->with('success', 'If that email exists, we\'ve sent a reset link.');
    }
}
