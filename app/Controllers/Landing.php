<?php namespace App\Controllers;

/**
 * Landing Page Controller
 * Handles all public-facing landing page routes
 */
class Landing extends \CodeIgniter\Controller {
    
    /**
     * Display the main landing page
     */
    public function index() {
        return view('layouts/index');
    }
    
    /**
     * About section (for SEO-friendly URL)
     */
    public function about() {
        return redirect()->to('/#about');
    }
    
    /**
     * Skills section (for SEO-friendly URL)
     */
    public function skills() {
        return redirect()->to('/#skills');
    }
    
    /**
     * Projects section (for SEO-friendly URL)
     */
    public function projects() {
        return redirect()->to('/#projects');
    }
    
    /**
     * Contact section (for SEO-friendly URL)
     */
    public function contact() {
        return redirect()->to('/#contact');
    }
    
    /**
     * Project detail page (dynamic)
     * @param string $slug Project slug
     */
    public function project(string $slug) {
        // Sample project data - in production, fetch from database
        $projects = [
            'ui-modern-systems' => [
                'title' => 'UI Modern Systems',
                'tag' => 'Design System',
                'desc' => 'Component-driven architecture with design tokens, strict accessibility (WCAG 2.1), and seamless dark mode support.',
                'tech' => ['React', 'TypeScript', 'Storybook', 'Tailwind CSS']
            ],
            'web-applications' => [
                'title' => 'Web Applications',
                'tag' => 'Fullstack',
                'desc' => 'Full-stack SPA/SSR applications with state management, routing, API integration, and optimized performance.',
                'tech' => ['Next.js', 'Node.js', 'PostgreSQL', 'Redis']
            ],
            'developer-docs' => [
                'title' => 'Developer Documentation',
                'tag' => 'Content',
                'desc' => 'Technical documentation portals, API references, onboarding guides with search and versioning.',
                'tech' => ['Docusaurus', 'Markdown', 'Algolia']
            ],
            'community-platform' => [
                'title' => 'Community Platform',
                'tag' => 'Platform',
                'desc' => 'Forum systems with real-time chat, role-based access control, moderation tools, and engagement features.',
                'tech' => ['Vue.js', 'Socket.io', 'MongoDB', 'Express']
            ]
        ];
        
        if (!array_key_exists($slug, $projects)) {
            return redirect()->to('/#projects');
        }
        
        $data = $projects[$slug];
        return view('layouts/project_detail', $data);
    }
}