<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Skill Management Controller
 */
class SkillController extends BaseController
{
    public function index()
    {
        $data = [
            'skills' => [
                ['id' => 1, 'name' => 'React', 'category' => 'Frontend', 'level' => 90],
                ['id' => 2, 'name' => 'Vue.js', 'category' => 'Frontend', 'level' => 85],
                ['id' => 3, 'name' => 'TypeScript', 'category' => 'Language', 'level' => 88],
                ['id' => 4, 'name' => 'Tailwind CSS', 'category' => 'CSS', 'level' => 95],
                ['id' => 5, 'name' => 'Node.js', 'category' => 'Backend', 'level' => 80],
                ['id' => 6, 'name' => 'CodeIgniter 4', 'category' => 'Backend', 'level' => 85],
            ],
            'title' => 'Skills Management'
        ];
        
        return view('dashboard/skills', $data);
    }

    public function create()
    {
        // Validate and create skill
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'category' => 'required|in_list[Frontend,Backend,CSS,Language,Database,DevOps]',
            'level' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return redirect()->to('/admin/skills')->with('success', 'Skill added successfully!');
    }

    public function update(int $id)
    {
        // Validate and update skill
        return redirect()->to('/admin/skills')->with('success', 'Skill updated successfully!');
    }

    public function delete(int $id)
    {
        // Delete skill
        return redirect()->to('/admin/skills')->with('success', 'Skill deleted successfully!');
    }
}
