<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Message Management Controller
 * Handles contact form messages from landing page
 */
class MessageController extends BaseController
{
    /**
     * Display messages inbox
     */
    public function index()
    {
        // Sample data - in production, fetch from database
        $data = [
            'messages' => [
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'message' => 'Hi, I am interested in your services. Could you please provide more information about your pricing and availability?',
                    'is_read' => false,
                    'created_at' => '2024-03-15 10:30:00'
                ],
                [
                    'id' => 2,
                    'name' => 'Jane Smith',
                    'email' => 'jane@company.com',
                    'message' => 'Great portfolio! I would love to discuss a potential collaboration for our upcoming project.',
                    'is_read' => true,
                    'created_at' => '2024-03-14 15:45:00'
                ],
                [
                    'id' => 3,
                    'name' => 'Mike Johnson',
                    'email' => 'mike@startup.io',
                    'message' => 'We are looking for a frontend developer with React expertise. Are you available for freelance work?',
                    'is_read' => false,
                    'created_at' => '2024-03-13 09:15:00'
                ]
            ],
            'title' => 'Messages',
            'unreadCount' => 2
        ];
        
        return view('dashboard/messages/index', $data);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(int $id)
    {
        // In production, update database
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Message marked as read'
        ]);
    }

    /**
     * Mark all messages as read
     */
    public function markAllAsRead()
    {
        // In production, update database
        return $this->response->setJSON([
            'success' => true,
            'message' => 'All messages marked as read'
        ]);
    }

    /**
     * Delete a message
     */
    public function delete(int $id)
    {
        // In production, delete from database
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Message deleted successfully'
        ]);
    }
}
