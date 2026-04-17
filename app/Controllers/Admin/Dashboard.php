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
                ['label' => 'Total Projects', 'val' => '24', 'trend' => '+12%', 'color' => 'text-emerald-500'],
                ['label' => 'Active Users', 'val' => '1.2k', 'trend' => '+5%', 'color' => 'text-brand-500'],
                ['label' => 'Page Views', 'val' => '8.4k', 'trend' => '+18%', 'color' => 'text-purple-500'],
                ['label' => 'Server Uptime', 'val' => '99.9%', 'trend' => 'Stable', 'color' => 'text-blue-500']
            ],
            'recentActivities' => [
                'New deployment pushed',
                'User Adi updated profile',
                'Backup completed successfully',
                'SSL certificate renewed'
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
