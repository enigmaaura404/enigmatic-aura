<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Contact API Controller
 * Handles contact form submissions via AJAX
 */
class ContactController extends BaseController
{
    /**
     * Process contact form submission
     */
    public function send()
    {
        // Validate input
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[255]',
            'message' => 'required|min_length[10]|max_length[2000]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = $this->request->getPost();

        // TODO: Save to database or send email
        // In production: save to contacts table and/or send notification email

        // Log the contact submission (for demo)
        log_message('info', 'Contact form submission: ' . json_encode($data));

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully.'
        ]);
    }
}
