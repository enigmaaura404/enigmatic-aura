<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Theme Controller
 * Handles user theme preference (dark/light mode)
 */
class ThemeController extends BaseController
{
    /**
     * Set user theme preference
     */
    public function setPreference()
    {
        $theme = $this->request->getPost('theme');

        if (!in_array($theme, ['light', 'dark'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid theme. Must be "light" or "dark"'
            ]);
        }

        // Store in session (or cookie for persistence across sessions)
        session()->set('theme_preference', $theme);

        // Also set a cookie for 1 year persistence
        $this->response->setCookie('theme', $theme, YEAR, '/');

        return $this->response->setJSON([
            'success' => true,
            'theme' => $theme
        ]);
    }
}
