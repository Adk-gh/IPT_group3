<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
 public function index(Request $request)
    {
        $users = User::where('email', '!=', 'admin@gmail.com')
            ->withCount('posts') // Adds posts_count for artworks_count
            ->paginate(10);


        return view('admin.UserManagement', compact('users'));
    }
}
