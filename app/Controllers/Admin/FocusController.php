<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Focus Section Management Controller
 */
class FocusController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Focus Section',
            'focusItems' => [
                [
                    'id' => 1,
                    'icon' => '💻',
                    'title' => 'Frontend Developer',
                    'description' => 'Building pixel-perfect, responsive interfaces with modern frameworks. Specialized in React, Vue, and component-driven architecture.'
                ],
                [
                    'id' => 2,
                    'icon' => '🎨',
                    'title' => 'UI/UX Designer',
                    'description' => 'Creating intuitive, accessible designs that users love. Expert in Figma, design systems, and user-centered workflows.'
                ],
                [
                    'id' => 3,
                    'icon' => '🖥️',
                    'title' => 'IT Support',
                    'description' => 'Ensuring systems run smoothly. From infrastructure management to troubleshooting, I keep everything reliable and secure.'
                ]
            ]
        ];
        
        return view('dashboard/focus/index', $data);
    }

    public function create()
    {
        // Handle create
    }

    public function update(int $id)
    {
        // Handle update
    }

    public function delete(int $id)
    {
        // Handle delete
    }
}
