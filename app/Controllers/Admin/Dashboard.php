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
                ['label' => 'Total Projects', 'val' => '24', 'trend' => '+12%', 'color' => 'text-emerald-500 bg-emerald-500', 'icon' => '📁'],
                ['label' => 'Active Users', 'val' => '1.2k', 'trend' => '+5%', 'color' => 'text-brand-500 bg-brand-500', 'icon' => '👥'],
                ['label' => 'Page Views', 'val' => '8.4k', 'trend' => '+18%', 'color' => 'text-purple-500 bg-purple-500', 'icon' => '📊'],
                ['label' => 'Server Uptime', 'val' => '99.9%', 'trend' => 'Stable', 'color' => 'text-blue-500 bg-blue-500', 'icon' => '⚡']
            ],
            'recentActivities' => [
                'New deployment pushed to production',
                'User Adi updated profile settings',
                'Backup completed successfully',
                'SSL certificate renewed for domain'
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
