<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    // Optional: Show admin page if email matches
    public function showAdminDashboard()
    {
        $user = Auth::user();
        if ($user && $user->email === 'admin@gmail.com') {
            return view('admin.Dashboard', ['user' => $user]);
        }

        return redirect()->route('home')->withErrors(['You do not have permission to access this page.']);
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
}

