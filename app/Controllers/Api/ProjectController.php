<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Project API Controller
 * Provides project data for frontend consumption
 */
class ProjectController extends BaseController
{
    /**
     * Get list of projects (with optional filtering)
     */
    public function list()
    {
        // Sample data - replace with Model fetch in production
        $projects = [
            [
                'id' => 1,
                'name' => 'E-Commerce Platform',
                'slug' => 'ecommerce-platform',
                'description' => 'Full-featured online store with payment integration',
                'tech_stack' => ['React', 'Node.js', 'PostgreSQL', 'Stripe'],
                'status' => 'published',
                'featured' => true,
                'thumbnail' => '/assets/images/projects/ecommerce.jpg',
                'repository_url' => 'https://github.com/example/ecommerce',
                'live_url' => 'https://example-store.com',
                'created_at' => '2024-01-15T10:00:00Z'
            ],
            [
                'id' => 2,
                'name' => 'Portfolio Website',
                'slug' => 'portfolio-website',
                'description' => 'Modern portfolio with dark mode and animations',
                'tech_stack' => ['Tailwind CSS', 'Alpine.js', 'CodeIgniter 4'],
                'status' => 'published',
                'featured' => true,
                'thumbnail' => '/assets/images/projects/portfolio.jpg',
                'repository_url' => 'https://github.com/example/portfolio',
                'live_url' => 'https://adi.dev',
                'created_at' => '2024-02-20T14:30:00Z'
            ],
            [
                'id' => 3,
                'name' => 'Task Management App',
                'slug' => 'task-management-app',
                'description' => 'Collaborative task manager with real-time updates',
                'tech_stack' => ['Vue.js', 'Firebase', 'Vuex'],
                'status' => 'draft',
                'featured' => false,
                'thumbnail' => '/assets/images/projects/taskapp.jpg',
                'repository_url' => 'https://github.com/example/taskapp',
                'live_url' => null,
                'created_at' => '2024-03-10T09:15:00Z'
            ]
        ];

        // Filter by status if provided
        $status = $this->request->getGet('status');
        if ($status) {
            $projects = array_filter($projects, fn($p) => $p['status'] === $status);
        }

        // Filter by search query if provided
        $search = $this->request->getGet('search');
        if ($search) {
            $projects = array_filter($projects, fn($p) => 
                stripos($p['name'], $search) !== false || 
                stripos($p['description'], $search) !== false
            );
        }

        // Only return published projects for public API
        $projects = array_filter($projects, fn($p) => $p['status'] === 'published');

        return $this->response->setJSON([
            'success' => true,
            'data' => array_values($projects),
            'meta' => [
                'total' => count($projects),
                'timestamp' => time()
            ]
        ]);
    }
}
