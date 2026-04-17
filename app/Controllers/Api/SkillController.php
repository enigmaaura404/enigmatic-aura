<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Skill API Controller
 * Provides skill data for frontend consumption
 */
class SkillController extends BaseController
{
    /**
     * Get list of all skills
     */
    public function list()
    {
        // Sample data - replace with Model fetch in production
        $skills = [
            ['id' => 1, 'name' => 'React', 'category' => 'Frontend', 'level' => 90, 'icon' => '⚛️'],
            ['id' => 2, 'name' => 'Vue.js', 'category' => 'Frontend', 'level' => 85, 'icon' => '💚'],
            ['id' => 3, 'name' => 'TypeScript', 'category' => 'Language', 'level' => 88, 'icon' => '📘'],
            ['id' => 4, 'name' => 'Tailwind CSS', 'category' => 'CSS', 'level' => 95, 'icon' => '🌬️'],
            ['id' => 5, 'name' => 'Node.js', 'category' => 'Backend', 'level' => 80, 'icon' => '🟢'],
            ['id' => 6, 'name' => 'CodeIgniter 4', 'category' => 'Backend', 'level' => 85, 'icon' => '🔥'],
            ['id' => 7, 'name' => 'Next.js', 'category' => 'Frontend', 'level' => 82, 'icon' => '▲'],
            ['id' => 8, 'name' => 'Figma', 'category' => 'Design', 'level' => 88, 'icon' => '🎨'],
            ['id' => 9, 'name' => 'Git', 'category' => 'DevOps', 'level' => 90, 'icon' => '📦'],
            ['id' => 10, 'name' => 'MySQL', 'category' => 'Database', 'level' => 85, 'icon' => '🐬'],
            ['id' => 11, 'name' => 'PostgreSQL', 'category' => 'Database', 'level' => 80, 'icon' => '🐘'],
            ['id' => 12, 'name' => 'Docker', 'category' => 'DevOps', 'level' => 75, 'icon' => '🐳']
        ];

        // Filter by category if provided
        $category = $this->request->getGet('category');
        if ($category) {
            $skills = array_filter($skills, fn($s) => 
                strcasecmp($s['category'], $category) === 0
            );
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => array_values($skills),
            'categories' => array_unique(array_column($skills, 'category')),
            'meta' => [
                'total' => count($skills),
                'timestamp' => time()
            ]
        ]);
    }
}
