<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Routing\Controller;

class ContentController extends Controller
{
    // Static content pages
    public function socialFeed()
    {

        return view('SocialFeed');
    }

    public function showArtist()
    {
        return view('Artist');
    }

    public function showArticles()
    {
        return view('Articles');
    }

    public function showAboutUs()
    {
        return view('AboutUs');
    }

    public function showContact()
    {
        return view('Contact');
    }
    // Add your other methods here

   
}
