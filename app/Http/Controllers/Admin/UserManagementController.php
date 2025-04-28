<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountApproved;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware is applied in routes
    }

    /**
     * Display a listing of the users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        
        $query = User::where('role', 'user')
            ->with(['region', 'station']);
            
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $users = $query->latest()->paginate(10);
        
        return view('admin.users.index', compact('users', 'status'));
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Approve the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(User $user)
    {
        if ($user->status === 'inactive') {
            $user->status = 'active';
            $user->save();
            
            // Send email notification
            Mail::to($user->email)->send(new AccountApproved($user));
            
            return redirect()->route('admin.users.index', ['status' => 'inactive'])
                ->with('success', 'User has been approved successfully and notification email has been sent.');
        }
        
        return redirect()->route('admin.users.index', ['status' => 'inactive'])
            ->with('info', 'User is already active.');
    }
}