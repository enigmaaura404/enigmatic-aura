<?php namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'key',
        'label',
        'description',
        'type',
        'value',
        'default_value',
        'options',
        'category',
        'sort_order',
        'is_active',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'key'           => 'required|min_length[2]|max_length[100]|alpha_dash',
        'label'         => 'required|min_length[2]|max_length[255]',
        'type'          => 'required|in_list[text,textarea,number,boolean,select,email,url,color,file]',
        'category'      => 'permit_empty|max_length[50]',
        'value'         => 'permit_empty',
        'default_value' => 'permit_empty',
        'options'       => 'permit_empty|valid_json',
        'sort_order'    => 'permit_empty|integer|greater_than_equal_to[0]',
        'is_active'     => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [
        'key' => [
            'required'   => 'Setting key is required',
            'min_length' => 'Key must be at least 2 characters',
            'alpha_dash' => 'Key can only contain letters, numbers, and underscores'
        ],
        'label' => [
            'required'   => 'Label is required',
            'min_length' => 'Label must be at least 2 characters'
        ],
        'type' => [
            'required' => 'Type is required',
            'in_list'  => 'Please select a valid type'
        ]
    ];

    // Search
    protected $allowFilters = false;

    /**
     * Get paginated settings with search and filter
     */
    public function getPaginatedSettings($perPage = 10, $page = 1, $search = '', $category = '', $sortBy = 'sort_order', $sortOrder = 'asc')
    {
        $builder = $this->orderBy($sortBy, $sortOrder);

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('key', $search)
                    ->orLike('label', $search)
                    ->orLike('description', $search)
                    ->groupEnd();
        }

        if (!empty($category)) {
            $builder->where('category', $category);
        }

        return $builder->paginate($perPage, 'default', $page);
    }

    /**
     * Get total count with filters
     */
    public function getTotalCount($search = '', $category = '')
    {
        $builder = $this;

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('key', $search)
                    ->orLike('label', $search)
                    ->orLike('description', $search)
                    ->groupEnd();
        }

        if (!empty($category)) {
            $builder->where('category', $category);
        }

        return $builder->countAllResults(false);
    }

    /**
     * Get all categories
     */
    public function getCategories()
    {
        return $this->select('category')->distinct()->get()->getResultArray();
    }

    /**
     * Get setting by key
     */
    public function getByKey($key)
    {
        return $this->where('key', $key)->first();
    }

    /**
     * Update or create setting by key
     */
    public function updateByKey($key, $data)
    {
        $setting = $this->getByKey($key);
        
        if ($setting) {
            return $this->update($setting['id'], $data);
        }
        
        $data['key'] = $key;
        return $this->insert($data);
    }

    /**
     * Get all active settings grouped by category
     */
    public function getGroupedByCategory()
    {
        $settings = $this->where('is_active', 1)->orderBy('category')->orderBy('sort_order')->findAll();
        
        $grouped = [];
        foreach ($settings as $setting) {
            $grouped[$setting['category']][] = $setting;
        }
        
        return $grouped;
    }

    /**
     * Get settings value by key (helper for app usage)
     */
    public function getValue($key, $default = null)
    {
        $setting = $this->getByKey($key);
        return $setting ? $setting['value'] : $default;
    }
}
