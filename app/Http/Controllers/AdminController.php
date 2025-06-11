<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Artwork;
use App\Models\Location;
use App\Models\ArtistPartner;
use App\Models\PostReport;
use App\Models\Post;
use App\Models\SharedPost;
use App\Models\Comment;
use App\Models\Tag;


class AdminController extends Controller
{
    // Optional: Show admin page if email matches
   public function showAdminDashboard()
{
    $user = Auth::user();

    // Check if user is admin
    if ($user && $user->email === 'admin@gmail.com') {
        // Add stats data
        $reportCount = PostReport::count();
        $stats = [
            'locations' => Post::count(),
            'users' => User::count(),
            'artworks' => Post::count(),
            'reports' => $reportCount,
            'verified_artists' => User::where('verified_artist', 1)->count(),
            'comments' => Comment::count(),
            // Add other metrics as needed
        ];

        return view('admin.Dashboard', compact('user', 'stats'));
    }

    return redirect()->route('home')
           ->withErrors(['You do not have permission to access this page.']);
}

    public function showArtistPartner()
    {
        return view('admin.ArtistPartners');
    }

    public function showArtUpload()
    {
        return view('admin.ArtUpload');
    }

    public function showBackup()
    {
        return view('admin.Backup');
    }

    public function showLocation()
    {
        return view('admin.Location');
    }

    public function showReports()
    {
        return view('admin.Reports');
    }

    public function showSettings()
    {
        return view('admin.Settings');
    }

    public function showUserManagement()
    {
        return view('admin.UserManagement');
    }

    public function scopeVerifiedArtists($query)
    {
        return $query->where('verified_artist', 1);
    }

}

