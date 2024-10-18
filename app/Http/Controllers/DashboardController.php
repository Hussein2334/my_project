<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Ensure user has a posts relationship defined
        $posts = Auth::user()->posts()->latest()->paginate(6);

        return view('users.dashboard', ['posts' => $posts]);
    }

    public function userPosts(User $user)
    {
        $UserPosts = $user->posts()->latest()->paginate(6);
       
        return view('users.posts', [
            'posts' => $UserPosts,
            'user' => $user
        ]);
    }
}
