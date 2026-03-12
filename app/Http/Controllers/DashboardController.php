<?php

namespace App\Http\Controllers;

use App\Services\PilrekService;

class DashboardController extends Controller
{
    public function __construct(protected PilrekService $pilrekService) {}

    /**
     * Display the dashboard analytics page
     */
    public function index()
    {
        $user = auth()->user();
        
        // Check if user is Admin or Super Admin
        if ($user->role && in_array($user->role->slug, ['super-admin', 'admin'])) {
            $pilrekData = $this->pilrekService->getLandingData();
            return view('pages.dashboard.admin', $pilrekData);
        }

        // Default dashboard for non-admin users
        return view('pages.dashboard.user');
    }
}
