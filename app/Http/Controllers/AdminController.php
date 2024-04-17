<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsersCount = User::count();
        $newlyRegisteredUsersCount = User::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $newlyDeletedUsersCount = User::onlyTrashed()->whereBetween('deleted_at', [now()->subWeek(), now()])->count();
        $newUsersCount = $newlyRegisteredUsersCount - $newlyDeletedUsersCount;

        return Inertia::render('Admin/Index', [
            'userStats' => [
                'title' => 'Total Users',
                'totalUsersCount' => $totalUsersCount,
                'newUsersCount' => $newUsersCount,
                'when' => 'Since last week',
            ]
        ]);
    }
}
