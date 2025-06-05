<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;



Route::get('/social-feed', [PostController::class, 'index'])->name('posts.index');

// Home page
Route::get('/', function () {
    return view('Signup');
})->name('home');

// Authentication Routes
Route::get('/index', [AuthController::class, 'showIndex'])->name('home');
Route::post('/register', [AuthController::class, 'signUp'])->name('register');
Route::post('/login', [AuthController::class, 'signIn'])->name('login.post');
Route::get('/signin', [AuthController::class, 'showSignInForm'])->name('login');
Route::post('/signin', [AuthController::class, 'signIn'])->name('login.post');
Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('register');
Route::post('/signup', [AuthController::class, 'signUp'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Static content pages
Route::get('/social-feed', [AuthController::class, 'socialFeed'])->name('social_feed');
Route::get('/artist', [AuthController::class, 'showArtist'])->name('artist');
Route::get('/artist/{id}', [AuthController::class, 'showArtistProfile'])->name('artist.profile');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::get('/article', [AuthController::class, 'showArticles'])->name('articles');
Route::get('/social-feed', [AuthController::class, 'socialFeed'])->name('social_feed');
Route::get('/about', [AuthController::class, 'showAboutUs'])->name('aboutus');
Route::get('/contact', [AuthController::class, 'showContact'])->name('contact');
Route::get('/Support', [AuthController::class, 'showSupport'])->name('support');
Route::get('/Paterns', [AuthController::class, 'showPatterns'])->name('patterns');


//admin routes
Route::get('/admin/Dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
Route::get('/admin/ArtistPartners', [AdminController::class, 'showArtistPartner'])->name('admin.ArtistPartners');
Route::get('/admin/ArtUpload', [AdminController::class, 'showArtUpload'])->name('admin.ArtUpload');
Route::get('/admin/Backup', [AdminController::class, 'showBackup'])->name('admin.Backup');
Route::get('/admin/Location', [AdminController::class, 'showLocation'])->name('admin.Location');
Route::get('/admin/Reports', [AdminController::class, 'showReports'])->name('admin.Reports');
Route::get('/admin/Settings', [AdminController::class, 'showSettings'])->name('admin.Settings');
Route::get('/admin/UserManagement', [AdminController::class, 'showUserManagement'])->name('admin.UserManagement');
Route::post('/profile/update-bio', [AuthController::class, 'updateBio'])->middleware('auth');
Route::post('/profile/update-cover', [AuthController::class, 'updateCover'])->middleware('auth');


//


Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// routes/web.php
Route::get('/tags/list', function() {
    return App\Models\Tag::orderBy('name')->get();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/user/cover-update', [AuthController::class, 'updateCoverPhoto'])->name('user.cover.update');
    Route::post('/user/bio-update', [AuthController::class, 'updateBio'])->name('user.bio.update');
});


Route::get('/posts', function () {
    $posts = App\Models\Post::with(['user', 'tags'])->latest()->get();
    return view('posts.index', compact('posts'));
});

