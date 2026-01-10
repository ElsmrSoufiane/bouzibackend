<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated AND is admin
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Example: Check if user has admin role
        // You need to add a 'role' field to your users table
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        
        return $next($request);
    }
}