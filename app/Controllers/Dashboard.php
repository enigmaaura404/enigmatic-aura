<?php namespace App\Controllers;
class Dashboard extends \CodeIgniter\Controller {
    public function index() { return view('dashboard/index'); }
    public function projects() { return view('dashboard/projects'); }
}