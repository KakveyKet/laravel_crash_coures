<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Use the request helper to get the query parameter
    $search = request()->query('search'); // Equivalent to $request->query('search')

    // Query the users, applying the search filter if present
    $users = User::when($search, function ($query) use ($search) {
        $query
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    })->paginate(5)->withQueryString();

    // Return the Inertia response with users, search, and permissions
    return Inertia::render('Home', [
        'users' => $users,
        'search' => $search,
        'can' => [
            'delete_user' => Auth::user() ? Auth::user()->can('delete', User::class) : null
        ]
    ]);
})->name('home');



// group

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// group guest

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return Inertia::render('Auth/Resgister');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    // login
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// log out
