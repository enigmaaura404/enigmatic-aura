<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 * EnigmaticAura - Routing Configuration
 * Professional CI4 Setup with Security Best Practices
 */

// =============================================================================
// ⚙️ GLOBAL SETTINGS
// =============================================================================
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Landing');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // 🔒 Security: Disable auto-routing

// =============================================================================
// 🔒 FILTERS (Load once for all routes)
// =============================================================================
// Note: Filters are now applied directly in route groups

// =============================================================================
// 🌐 PUBLIC ROUTES (Landing Page)
// =============================================================================

// Main Landing Page
$routes->get('/', 'Landing::index', ['as' => 'home']);

// Landing Page Sections (Anchor links handled by JS, but SEO-friendly URLs)
$routes->get('/about', 'Landing::about', ['as' => 'about']);
$routes->get('/skills', 'Landing::skills', ['as' => 'skills']);
$routes->get('/projects', 'Landing::projects', ['as' => 'projects']);
$routes->get('/contact', 'Landing::contact', ['as' => 'contact']);

// Dynamic Project Detail (SEO Friendly)
$routes->get('/project/(:segment)', 'Landing::project/$1', ['as' => 'project.detail']);

// =============================================================================
// 📡 API ROUTES (AJAX / Frontend Interactions)
// =============================================================================
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'csrf'], function($routes) {
    
    // Public API (No Auth Required)
    $routes->post('contact/send', 'ContactController::send');
    $routes->get('projects/list', 'ProjectController::list');
    $routes->get('skills/list', 'SkillController::list');
    
    // Theme Preference (Save user dark/light mode)
    $routes->post('theme/preference', 'ThemeController::setPreference');
});

// =============================================================================
// 🔐 ADMIN DASHBOARD ROUTES (TailAdmin Architecture)
// =============================================================================
$routes->group('admin', ['filter' => 'auth', 'namespace' => 'App\Controllers\Admin'], function($routes) {
    
    // Dashboard Overview
    $routes->get('/', 'Dashboard::index', ['as' => 'admin.dashboard']);
    $routes->get('analytics', 'Dashboard::analytics', ['as' => 'admin.analytics']);
    
    // ─────────────────────────────────────────────────────────────────────
    // 📁 Project Management (CRUD)
    // ─────────────────────────────────────────────────────────────────────
    $routes->resource('projects', [
        'controller' => 'ProjectController',
        'only'       => ['index', 'show', 'new', 'create', 'edit', 'update', 'delete'],
        'placeholder' => '(:num)'
    ]);
    
    // Custom Project Actions
    $routes->post('projects/(:num)/publish', 'ProjectController::publish/$1', ['as' => 'admin.projects.publish']);
    $routes->post('projects/(:num)/toggle-status', 'ProjectController::toggleStatus/$1', ['as' => 'admin.projects.toggle']);
    $routes->post('projects/bulk-delete', 'ProjectController::bulkDelete', ['as' => 'admin.projects.bulkDelete']);
    
    // ─────────────────────────────────────────────────────────────────────
    // ⚙️ Skills & Tech Stack Management
    // ─────────────────────────────────────────────────────────────────────
    $routes->resource('skills', [
        'controller' => 'SkillController',
        'only'       => ['index', 'create', 'edit', 'update', 'delete'],
        'placeholder' => '(:num)'
    ]);

    // Custom Skill Actions
    $routes->post('skills/(:num)/toggle-status', 'SkillController::toggleStatus/$1', ['as' => 'admin.skills.toggle']);
    
    // ─────────────────────────────────────────────────────────────────────
    // 🔧 Settings Management (Full CRUD)
    // ─────────────────────────────────────────────────────────────────────
    $routes->resource('settings', [
        'controller' => 'SettingController',
        'only'       => ['index', 'show', 'create', 'store', 'edit', 'update', 'delete'],
        'placeholder' => '(:num)'
    ]);

    // Custom Settings Actions
    $routes->post('settings/(:num)/toggle-status', 'SettingController::toggleStatus/$1', ['as' => 'admin.settings.toggle']);
    $routes->post('settings/bulk-delete', 'SettingController::bulkDelete', ['as' => 'admin.settings.bulkDelete']);
    
    // ─────────────────────────────────────────────────────────────────────
    // 📝 Content Management (Landing Page Editor)
    // ─────────────────────────────────────────────────────────────────────
    $routes->get('content/landing', 'ContentController::landing', ['as' => 'admin.content.landing']);
    $routes->post('content/landing/update', 'ContentController::updateLanding', ['as' => 'admin.content.landing.update']);
    
    // ─────────────────────────────────────────────────────────────────────
    // 👤 Authentication & Profile (Within Admin Area)
    // ─────────────────────────────────────────────────────────────────────
    $routes->get('profile', 'AuthController::profile', ['as' => 'admin.profile']);
    $routes->post('profile/update', 'AuthController::updateProfile', ['as' => 'admin.profile.update']);
    $routes->post('logout', 'AuthController::logout', ['as' => 'admin.logout']);
});

// =============================================================================
// 🔑 AUTHENTICATION ROUTES (Public - Login/Register)
// =============================================================================
$routes->group('auth', ['namespace' => 'App\Controllers\Auth'], function($routes) {
    $routes->get('login', 'LoginController::index', ['as' => 'login']);
    $routes->post('login/process', 'LoginController::authenticate', ['as' => 'login.process']);
    
    // Optional: Register (if you want public registration)
    // $routes->get('register', 'RegisterController::index', ['as' => 'register']);
    // $routes->post('register/process', 'RegisterController::create', ['as' => 'register.process']);
    
    $routes->get('forgot-password', 'ForgotPasswordController::index', ['as' => 'forgot.password']);
    $routes->post('forgot-password/send', 'ForgotPasswordController::sendLink', ['as' => 'forgot.password.send']);
});

// =============================================================================
// 🧩 UTILITY & FALLBACK ROUTES
// =============================================================================

// Health Check (For VPS/Deploy monitoring)
$routes->get('health', fn() => response()->setJSON(['status' => 'ok', 'timestamp' => time()]), ['filter' => 'throttle:60,1']);

// Sitemap & Robots (SEO)
$routes->get('sitemap.xml', 'SeoController::sitemap');
$routes->get('robots.txt', 'SeoController::robots');

// 404 Handler (Custom Page)
$routes->set404Override(function() {
    return view('errors/html/error_404'); // Create this view for branded 404
});

// =============================================================================
// 🎨 ROUTE OPTIMIZATION (Production)
// =============================================================================
// Cache routes for faster boot time in production
// Uncomment below when deploying:
// $routes->cacheConfig('routes');