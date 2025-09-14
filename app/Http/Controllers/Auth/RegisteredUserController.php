<?php

// File: app/Http/Controllers/Auth/RegisteredUserController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): RedirectResponse
    {
        // Redirect to login since registration is disabled
        return redirect()->route('login')->with('error', 'Registration is disabled. Please contact an administrator.');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Registration is disabled
        return redirect()->route('login')->with('error', 'Registration is disabled. Please contact an administrator.');
    }
}