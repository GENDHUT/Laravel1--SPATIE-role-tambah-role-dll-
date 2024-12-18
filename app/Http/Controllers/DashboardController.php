<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\Request;
// use Spatie\Permission\Tests\TestModels\User;

class DashboardController extends Controller
{

    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $mejas = collect(); // Initialize as a collection

            // Fetch Meja based on user role
            if ($user->hasRole('pelanggan')) {
                // Get the tables reserved by the current user
                $reservedTables = Meja::where('user_id', $user->id)->get();

                // Get the available tables that are not reserved by other users
                $availableTables = Meja::where('status', 'tersedia')
                    ->whereDoesntHave('user', function ($query) use ($user) {
                        $query->where('id', '!=', $user->id);
                    })
                    ->get();

                // Merge the reserved tables and available tables
                $mejas = $reservedTables->merge($availableTables);
            } elseif ($user->hasRole('admin') || $user->hasRole('waiter') || $user->hasRole('kasir') || $user->hasRole('owner')) {
                // Admin, waiter, kasir, or owner can see all tables
                $mejas = Meja::all();
            }

            // Fetch users and order by role
            $roleOrder = ['admin', 'owner', 'waiter', 'kasir', 'pelanggan'];
            $users = User::with('roles')->get();
            $users = $users->sortBy(function($user) use ($roleOrder) {
                return array_search($user->roles->first()->name ?? 'pelanggan', $roleOrder);
            });

            // Pass both $mejas and $users to the view
            return view('dashboard', compact('mejas', 'users'));
        } else {
            return redirect()->route('login'); // If not logged in, redirect to login page
        }
    }
}


