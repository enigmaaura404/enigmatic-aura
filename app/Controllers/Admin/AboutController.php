<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * About Section Management Controller
 */
class AboutController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'About Section',
            'about' => [
                'name' => 'Adi',
                'title' => 'Frontend Developer & UI/UX Designer',
                'description' => 'I don\'t just write code; I architect experiences. With a hybrid background in frontend engineering and UI/UX design, I bridge the gap between how things look and how they work.',
                'roles' => ['Frontend Developer', 'UI/UX Designer', 'IT Support'],
                'image_emoji' => '🧑‍💻'
            ]
        ];
        
        return view('dashboard/about/index', $data);
    }

    public function update()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'title' => 'required|max_length[255]',
            'description' => 'required|max_length[2000]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // In production, save to database
        return redirect()->to('/admin/about')->with('success', 'About section updated successfully!');
    }
}
