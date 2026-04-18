<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

/**
 * Settings Management Controller
 * Full CRUD with modern UI/UX features for application settings
 */
class SettingController extends BaseController
{
    protected $settingModel;
    protected $perPage = 15;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    /**
     * Display settings management page with pagination
     */
    public function index()
    {
        $page = (int)$this->request->getVar('page') ?? 1;
        $search = $this->request->getVar('search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = $this->request->getVar('category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sortBy = $this->request->getVar('sort_by', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'sort_order';
        $sortOrder = $this->request->getVar('sort_order', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'asc';

        // Validate sort parameters
        $allowedSorts = ['key', 'label', 'category', 'type', 'sort_order', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'sort_order';
        }
        $sortOrder = strtolower($sortOrder) === 'desc' ? 'desc' : 'asc';

        // Get paginated settings
        $settings = $this->settingModel->getPaginatedSettings(
            $this->perPage,
            $page,
            $search,
            $category,
            $sortBy,
            $sortOrder
        );

        // Get total count for pagination
        $total = $this->settingModel->getTotalCount($search, $category);
        $pager = $this->settingModel->pager;

        // Get categories for filter dropdown
        $categories = $this->settingModel->getCategories();

        $data = [
            'settings' => $settings,
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
            'settingTypes' => $this->getSettingTypes(),
            'title' => 'Settings Management'
        ];

        return view('dashboard/settings/index', $data);
    }

    /**
     * Show create setting modal/form
     */
    public function create()
    {
        $data = [
            'setting' => null,
            'settingTypes' => $this->getSettingTypes(),
            'categories' => $this->getSettingCategories(),
            'title' => 'Add New Setting'
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'html' => view('dashboard/settings/form', $data)
            ]);
        }

        return view('dashboard/settings/form', $data);
    }

    /**
     * Store new setting
     */
    public function store()
    {
        $rules = [
            'key'           => 'required|min_length[2]|max_length[100]|alpha_dash|is_unique[settings.key]',
            'label'         => 'required|min_length[2]|max_length[255]',
            'type'          => 'required|in_list[text,textarea,number,boolean,select,email,url,color,file]',
            'description'   => 'permit_empty|max_length[1000]',
            'value'         => 'permit_empty',
            'default_value' => 'permit_empty',
            'options'       => 'permit_empty|valid_json',
            'category'      => 'permit_empty|max_length[50]',
            'sort_order'    => 'permit_empty|integer|greater_than_equal_to[0]',
            'is_active'     => 'permit_empty|in_list[0,1]'
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

        $settingData = [
            'key'           => $this->request->getPost('key'),
            'label'         => $this->request->getPost('label'),
            'type'          => $this->request->getPost('type'),
            'description'   => $this->request->getPost('description') ?: null,
            'value'         => $this->request->getPost('value') ?: null,
            'default_value' => $this->request->getPost('default_value') ?: null,
            'options'       => !empty($this->request->getPost('options')) ? json_encode($this->request->getPost('options')) : null,
            'category'      => $this->request->getPost('category') ?: 'general',
            'sort_order'    => (int)$this->request->getPost('sort_order') ?: 0,
            'is_active'     => (int)($this->request->getPost('is_active') ?? 1)
        ];

        $settingId = $this->settingModel->insert($settingData);

        if ($settingId) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Setting added successfully!',
                    'setting_id' => $settingId
                ]);
            }
            return redirect()->to('/admin/settings')->with('success', 'Setting added successfully!');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to add setting. Please try again.'
            ]);
        }
        return redirect()->back()->with('error', 'Failed to add setting. Please try again.');
    }

    /**
     * Show single setting detail
     */
    public function show(int $id)
    {
        $setting = $this->settingModel->find($id);

        if (!$setting) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Setting not found'
                ], 404);
            }
            return redirect()->to('/admin/settings')->with('error', 'Setting not found');
        }

        // Decode options if exists
        if (!empty($setting['options'])) {
            $setting['options'] = json_decode($setting['options'], true);
        }

        $data = [
            'setting' => $setting,
            'title' => 'Setting Detail'
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'html' => view('dashboard/settings/detail', $data)
            ]);
        }

        return view('dashboard/settings/detail', $data);
    }

    /**
     * Show edit setting modal/form
     */
    public function edit(int $id)
    {
        $setting = $this->settingModel->find($id);

        if (!$setting) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Setting not found'
                ], 404);
            }
            return redirect()->to('/admin/settings')->with('error', 'Setting not found');
        }

        // Decode options if exists
        if (!empty($setting['options'])) {
            $setting['options'] = json_decode($setting['options'], true);
        }

        $data = [
            'setting' => $setting,
            'settingTypes' => $this->getSettingTypes(),
            'categories' => $this->getSettingCategories(),
            'title' => 'Edit Setting'
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'html' => view('dashboard/settings/form', $data)
            ]);
        }

        return view('dashboard/settings/form', $data);
    }

    /**
     * Update existing setting
     */
    public function update(int $id)
    {
        $setting = $this->settingModel->find($id);

        if (!$setting) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Setting not found'
                ], 404);
            }
            return redirect()->to('/admin/settings')->with('error', 'Setting not found');
        }

        $rules = [
            'key'           => "required|min_length[2]|max_length[100]|alpha_dash|is_unique[settings.key,id,{$id}]",
            'label'         => 'required|min_length[2]|max_length[255]',
            'type'          => 'required|in_list[text,textarea,number,boolean,select,email,url,color,file]',
            'description'   => 'permit_empty|max_length[1000]',
            'value'         => 'permit_empty',
            'default_value' => 'permit_empty',
            'options'       => 'permit_empty|valid_json',
            'category'      => 'permit_empty|max_length[50]',
            'sort_order'    => 'permit_empty|integer|greater_than_equal_to[0]',
            'is_active'     => 'permit_empty|in_list[0,1]'
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

        $settingData = [
            'key'           => $this->request->getPost('key'),
            'label'         => $this->request->getPost('label'),
            'type'          => $this->request->getPost('type'),
            'description'   => $this->request->getPost('description') ?: null,
            'value'         => $this->request->getPost('value') ?: null,
            'default_value' => $this->request->getPost('default_value') ?: null,
            'options'       => !empty($this->request->getPost('options')) ? json_encode($this->request->getPost('options')) : null,
            'category'      => $this->request->getPost('category') ?: 'general',
            'sort_order'    => (int)$this->request->getPost('sort_order') ?: 0,
            'is_active'     => (int)($this->request->getPost('is_active') ?? 1)
        ];

        if ($this->settingModel->update($id, $settingData)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Setting updated successfully!'
                ]);
            }
            return redirect()->to('/admin/settings')->with('success', 'Setting updated successfully!');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update setting. Please try again.'
            ]);
        }
        return redirect()->back()->with('error', 'Failed to update setting. Please try again.');
    }

    /**
     * Delete setting
     */
    public function delete(int $id)
    {
        $setting = $this->settingModel->find($id);

        if (!$setting) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Setting not found'
                ], 404);
            }
            return redirect()->to('/admin/settings')->with('error', 'Setting not found');
        }

        if ($this->settingModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Setting deleted successfully!'
                ]);
            }
            return redirect()->to('/admin/settings')->with('success', 'Setting deleted successfully!');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete setting. Please try again.'
            ]);
        }
        return redirect()->back()->with('error', 'Failed to delete setting. Please try again.');
    }

    /**
     * Toggle setting active status
     */
    public function toggleStatus(int $id)
    {
        $setting = $this->settingModel->find($id);

        if (!$setting) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Setting not found'
            ], 404);
        }

        $newStatus = (int)!$setting['is_active'];

        if ($this->settingModel->update($id, ['is_active' => $newStatus])) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Setting status updated!',
                'is_active' => $newStatus
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update status'
        ]);
    }

    /**
     * Bulk delete settings
     */
    public function bulkDelete()
    {
        $ids = $this->request->getPost('ids');

        if (empty($ids)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No settings selected'
            ], 400);
        }

        $deleted = 0;
        foreach ($ids as $id) {
            if ($this->settingModel->delete((int)$id)) {
                $deleted++;
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => "{$deleted} setting(s) deleted successfully!"
        ]);
    }

    /**
     * Get available setting types
     */
    private function getSettingTypes()
    {
        return [
            'text' => 'Text Input',
            'textarea' => 'Text Area',
            'number' => 'Number',
            'boolean' => 'Toggle/Switch',
            'select' => 'Dropdown Select',
            'email' => 'Email',
            'url' => 'URL',
            'color' => 'Color Picker',
            'file' => 'File Upload'
        ];
    }

    /**
     * Get available setting categories
     */
    private function getSettingCategories()
    {
        return [
            'general' => 'General',
            'email' => 'Email',
            'social' => 'Social Media',
            'seo' => 'SEO',
            'analytics' => 'Analytics',
            'api' => 'API Keys',
            'security' => 'Security',
            'appearance' => 'Appearance',
            'other' => 'Other'
        ];
    }
}
