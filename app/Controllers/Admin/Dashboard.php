<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Admin Dashboard Controller
 * Handles dashboard overview and analytics
 */
class Dashboard extends BaseController
{
    /**
     * Display admin dashboard overview
     */
    public function index()
    {
        // Sample stats - in production, fetch from database/models
        $data = [
            'stats' => [
                ['label' => 'Total Projects', 'val' => '24', 'trend' => '+12%', 'color' => 'text-emerald-500', 'bgColor' => 'bg-emerald-500', 'icon' => '📁'],
                ['label' => 'Active Users', 'val' => '1.2k', 'trend' => '+5%', 'color' => 'text-blue-500', 'bgColor' => 'bg-blue-500', 'icon' => '👥'],
                ['label' => 'Page Views', 'val' => '8.4k', 'trend' => '+18%', 'color' => 'text-purple-500', 'bgColor' => 'bg-purple-500', 'icon' => '📊'],
                ['label' => 'Server Uptime', 'val' => '99.9%', 'trend' => 'Stable', 'color' => 'text-orange-500', 'bgColor' => 'bg-orange-500', 'icon' => '⚡']
            ],
            'recentActivities' => [
                ['icon' => '📁', 'text' => 'New deployment pushed to production', 'time' => '2 hours ago', 'color' => 'blue'],
                ['icon' => '👤', 'text' => 'User Adi updated profile settings', 'time' => '5 hours ago', 'color' => 'green'],
                ['icon' => '✅', 'text' => 'Backup completed successfully', 'time' => '1 day ago', 'color' => 'purple'],
                ['icon' => '🔒', 'text' => 'SSL certificate renewed for domain', 'time' => '2 days ago', 'color' => 'orange'],
            ],
            'title' => 'Dashboard Overview'
        ];
        
        return view('dashboard/index', $data);
    }

    /**
     * Display analytics page
     */
    public function analytics()
    {
        $data = [
            'title' => 'Analytics'
        ];
        
        return view('dashboard/analytics', $data);
    }
}
