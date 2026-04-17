<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Project Management Controller
 * CRUD operations for projects
 */
class ProjectController extends BaseController
{
    /**
     * Display list of all projects
     */
    public function index()
    {
        // Sample data - replace with Model fetch in production
        $data = [
            'projects' => [
                [
                    'id' => 1,
                    'name' => 'E-Commerce Platform',
                    'status' => 'published',
                    'tech_stack' => ['React', 'Node.js', 'PostgreSQL'],
                    'created_at' => '2024-01-15'
                ],
                [
                    'id' => 2,
                    'name' => 'Portfolio Website',
                    'status' => 'published',
                    'tech_stack' => ['Tailwind CSS', 'Alpine.js'],
                    'created_at' => '2024-02-20'
                ],
                [
                    'id' => 3,
                    'name' => 'Task Management App',
                    'status' => 'draft',
                    'tech_stack' => ['Vue.js', 'Firebase'],
                    'created_at' => '2024-03-10'
                ]
            ],
            'title' => 'Projects Management'
        ];
        
        return view('dashboard/projects', $data);
    }

    /**
     * Show single project details
     */
    public function show(int $id)
    {
        // Fetch project by ID from model
        return redirect()->to('/admin/projects');
    }

    /**
     * Show create project form
     */
    public function new()
    {
        $data = [
            'title' => 'Create New Project'
        ];
        
        return view('dashboard/projects/create', $data);
    }

    /**
     * Create new project
     */
    public function create()
    {
        // Validate input
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]',
            'status' => 'required|in_list[draft,published,archived]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save to database (implement in Model)
        // ProjectModel::create($this->request->getPost());

        return redirect()->to('/admin/projects')->with('success', 'Project created successfully!');
    }

    /**
     * Show edit project form
     */
    public function edit(int $id)
    {
        // Fetch project and show edit form
        return redirect()->to('/admin/projects');
    }

    /**
     * Update existing project
     */
    public function update(int $id)
    {
        // Validate and update
        return redirect()->to('/admin/projects')->with('success', 'Project updated successfully!');
    }

    /**
     * Delete project
     */
    public function delete(int $id)
    {
        // Delete from database
        return redirect()->to('/admin/projects')->with('success', 'Project deleted successfully!');
    }

    /**
     * Publish project
     */
    public function publish(int $id)
    {
        // Update status to published
        return redirect()->to('/admin/projects')->with('success', 'Project published!');
    }

    /**
     * Toggle project status
     */
    public function toggleStatus(int $id)
    {
        // Toggle between draft/published
        return redirect()->to('/admin/projects')->with('success', 'Status updated!');
    }

    /**
     * Bulk delete projects
     */
    public function bulkDelete()
    {
        $ids = $this->request->getPost('ids') ?? [];
        
        if (empty($ids)) {
            return redirect()->back()->with('error', 'No projects selected');
        }

        // Delete multiple projects
        return redirect()->to('/admin/projects')->with('success', 'Projects deleted successfully!');
    }
}
