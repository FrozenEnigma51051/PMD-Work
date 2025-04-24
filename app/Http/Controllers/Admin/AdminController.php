<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pendingUsersCount = User::where('status', 'inactive')->count();
        $activeUsersCount = User::where('status', 'active')->where('is_admin', false)->count();
        $totalUsersCount = User::where('is_admin', false)->count();
        
        return view('admin.dashboard', compact('pendingUsersCount', 'activeUsersCount', 'totalUsersCount'));
    }
}