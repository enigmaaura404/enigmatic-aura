<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Content Management Controller
 * Manage landing page content dynamically
 */
class ContentController extends BaseController
{
    public function landing()
    {
        $data = [
            'title' => 'Landing Page Editor',
            'content' => [
                'hero_title' => 'EnigmaticAura ⚡',
                'hero_subtitle' => 'Crafting Interfaces, Solving Problems, Exploring the Future of the Web',
                'about_text' => 'I don\'t just write code; I architect experiences...',
                'philosophy_quote' => 'Good design is invisible. Great systems feel effortless.'
            ]
        ];
        
        return view('dashboard/content/landing', $data);
    }

    public function updateLanding()
    {
        // Validate input
        $rules = [
            'hero_title' => 'required|max_length[255]',
            'hero_subtitle' => 'required|max_length[500]',
            'about_text' => 'permit_empty|max_length[2000]',
            'philosophy_quote' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save to database or config file
        // In production, save to database table 'site_settings'

        return redirect()->to('/admin/content/landing')->with('success', 'Content updated successfully!');
    }
}
