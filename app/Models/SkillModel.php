<?php namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table            = 'skills';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'category',
        'level',
        'icon',
        'description',
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
        'name'     => 'required|min_length[2]|max_length[100]',
        'category' => 'required|in_list[Frontend,Backend,CSS,Language,Database,DevOps,Tools,Other]',
        'level'    => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
        'icon'     => 'permit_empty|max_length[50]',
        'description' => 'permit_empty|max_length[500]',
        'sort_order' => 'permit_empty|integer|greater_than_equal_to[0]',
        'is_active' => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Skill name is required',
            'min_length' => 'Skill name must be at least 2 characters'
        ],
        'category' => [
            'required' => 'Category is required',
            'in_list' => 'Please select a valid category'
        ],
        'level' => [
            'required' => 'Skill level is required',
            'integer' => 'Level must be a number',
            'greater_than_equal_to' => 'Level must be between 0 and 100',
            'less_than_equal_to' => 'Level must be between 0 and 100'
        ]
    ];

    // Search
    protected $allowFilters = false;

    /**
     * Get paginated skills with search and filter
     */
    public function getPaginatedSkills($perPage = 10, $page = 1, $search = '', $category = '', $sortBy = 'name', $sortOrder = 'asc')
    {
        $builder = $this->orderBy($sortBy, $sortOrder);

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('category', $search)
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
                    ->like('name', $search)
                    ->orLike('category', $search)
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
}
