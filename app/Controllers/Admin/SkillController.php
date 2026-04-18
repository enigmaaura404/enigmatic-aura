<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SkillModel;

/**
 * Skill Management Controller
 * Full CRUD with modern UI/UX features
 */
class SkillController extends BaseController
{
    protected $skillModel;
    protected $perPage = 10;

    public function __construct()
    {
        $this->skillModel = new SkillModel();
    }

    /**
     * Display skills management page with pagination
     */
    public function index()
    {
        $page = (int)$this->request->getVar('page') ?? 1;
        $search = $this->request->getVar('search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = $this->request->getVar('category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sortBy = $this->request->getVar('sort_by', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'name';
        $sortOrder = $this->request->getVar('sort_order', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'asc';

        // Validate sort parameters
        $allowedSorts = ['name', 'category', 'level', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'name';
        }
        $sortOrder = strtolower($sortOrder) === 'desc' ? 'desc' : 'asc';

        // Get paginated skills
        $skills = $this->skillModel->getPaginatedSkills(
            $this->perPage,
            $page,
            $search,
            $category,
            $sortBy,
            $sortOrder
        );

        // Get total count for pagination
        $total = $this->skillModel->getTotalCount($search, $category);
        $pager = $this->skillModel->pager;

        // Get categories for filter dropdown
        $categories = $this->skillModel->getCategories();

        $data = [
            'skills' => $skills,
            'pager' => $pager,
            'pagination' => [
                'currentPage' => $page,
                'perPage' => $this->perPage,
                'total' => $total,
                'totalPages' => ceil($total / $this->perPage)
            ],
            'filters' => [
                'search' => $search,
                'category' => $category,
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder
            ],
            'categories' => array_column($categories, 'category'),
            'title' => 'Skills Management'
        ];

        return view('dashboard/skills', $data);
    }

    /**
     * Show create skill modal/form
     */
    public function create()
    {
        $data = [
            'skill' => null,
            'categories' => ['Frontend', 'Backend', 'CSS', 'Language', 'Database', 'DevOps', 'Tools', 'Other'],
            'title' => 'Add New Skill'
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'html' => view('dashboard/skills_form', $data)
            ]);
        }

        return view('dashboard/skills_form', $data);
    }

    /**
     * Store new skill
     */
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'category' => 'required|in_list[Frontend,Backend,CSS,Language,Database,DevOps,Tools,Other]',
            'level' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
            'icon' => 'permit_empty|max_length[50]',
            'description' => 'permit_empty|max_length[500]',
            'sort_order' => 'permit_empty|integer|greater_than_equal_to[0]',
            'is_active' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $skillData = [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'level' => (int)$this->request->getPost('level'),
            'icon' => $this->request->getPost('icon') ?: null,
            'description' => $this->request->getPost('description') ?: null,
            'sort_order' => (int)$this->request->getPost('sort_order') ?: 0,
            'is_active' => (int)($this->request->getPost('is_active') ?? 1)
        ];

        $skillId = $this->skillModel->insert($skillData);

        if ($skillId) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Skill added successfully!',
                    'skill_id' => $skillId
                ]);
            }
            return redirect()->to('/admin/skills')->with('success', 'Skill added successfully!');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to add skill. Please try again.'
            ]);
        }
        return redirect()->back()->with('error', 'Failed to add skill. Please try again.');
    }

    /**
     * Show edit skill modal/form
     */
    public function edit(int $id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Skill not found'
                ], 404);
            }
            return redirect()->to('/admin/skills')->with('error', 'Skill not found');
        }

        $data = [
            'skill' => $skill,
            'categories' => ['Frontend', 'Backend', 'CSS', 'Language', 'Database', 'DevOps', 'Tools', 'Other'],
            'title' => 'Edit Skill'
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'html' => view('dashboard/skills_form', $data)
            ]);
        }

        return view('dashboard/skills_form', $data);
    }

    /**
     * Update existing skill
     */
    public function update(int $id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Skill not found'
                ], 404);
            }
            return redirect()->to('/admin/skills')->with('error', 'Skill not found');
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'category' => 'required|in_list[Frontend,Backend,CSS,Language,Database,DevOps,Tools,Other]',
            'level' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
            'icon' => 'permit_empty|max_length[50]',
            'description' => 'permit_empty|max_length[500]',
            'sort_order' => 'permit_empty|integer|greater_than_equal_to[0]',
            'is_active' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $skillData = [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'level' => (int)$this->request->getPost('level'),
            'icon' => $this->request->getPost('icon') ?: null,
            'description' => $this->request->getPost('description') ?: null,
            'sort_order' => (int)$this->request->getPost('sort_order') ?: 0,
            'is_active' => (int)($this->request->getPost('is_active') ?? 1)
        ];

        if ($this->skillModel->update($id, $skillData)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Skill updated successfully!'
                ]);
            }
            return redirect()->to('/admin/skills')->with('success', 'Skill updated successfully!');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update skill. Please try again.'
            ]);
        }
        return redirect()->back()->with('error', 'Failed to update skill. Please try again.');
    }

    /**
     * Delete skill
     */
    public function delete(int $id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Skill not found'
                ], 404);
            }
            return redirect()->to('/admin/skills')->with('error', 'Skill not found');
        }

        if ($this->skillModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Skill deleted successfully!'
                ]);
            }
            return redirect()->to('/admin/skills')->with('success', 'Skill deleted successfully!');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete skill. Please try again.'
            ]);
        }
        return redirect()->back()->with('error', 'Failed to delete skill. Please try again.');
    }

    /**
     * Toggle skill active status
     */
    public function toggleStatus(int $id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Skill not found'
            ], 404);
        }

        $newStatus = (int)!$skill['is_active'];

        if ($this->skillModel->update($id, ['is_active' => $newStatus])) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Skill status updated!',
                'is_active' => $newStatus
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update status'
        ]);
    }
}
