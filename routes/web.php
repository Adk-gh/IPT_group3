<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileSetupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SavedPostController;
use Illuminate\Http\Request;
use App\Models\Post;

// Public Routes
Route::get('/', [AuthController::class, 'showSignInForm'])->name('signin');
Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('register');
Route::post('/signup', [AuthController::class, 'signUp'])->name('register.post');
Route::get('/signin', [AuthController::class, 'showSignInForm'])->name('login');
Route::post('/signin', [AuthController::class, 'signIn'])->name('login.post');

Route::get('/about', [AuthController::class, 'showAboutUs'])->name('aboutus');
Route::get('/contact', [AuthController::class, 'showContact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/support', [AuthController::class, 'showSupport'])->name('support');
Route::get('/patterns', [AuthController::class, 'showPatterns'])->name('patterns');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/ProfileSetup', [ProfileSetupController::class, 'show'])->name('profile.setup');
    Route::post('/ProfileSetup', [ProfileSetupController::class, 'store'])->name('profile.setup.store');
    Route::post('/ProfileSetup/skip', [ProfileSetupController::class, 'skip'])->name('profile.skip');

    // Complete Profile Required Routes
    Route::middleware(['profile.complete'])->group(function () {
        // Main App Routes
        Route::get('/home', [AuthController::class, 'Index'])->name('home');
        Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
        Route::post('/user/cover-update', [AuthController::class, 'updateCoverPhoto'])->name('user.cover.update');
        Route::post('/user/bio-update', [AuthController::class, 'updateBio'])->name('user.bio.update');

        // Posts
        Route::post('/posts', [AuthController::class, 'storePost'])->name('posts.store');
        Route::get('/posts', function () {
            $posts = Post::with(['user', 'tags'])->latest()->get();
            return view('posts.index', compact('posts'));
        });
        Route::post('/posts/{post}/share', [AuthController::class, 'share'])->name('posts.share');
        Route::post('/posts/{post}/report', [AuthController::class, 'report'])->name('posts.report');
        Route::get('/posts/filter', [AuthController::class, 'filterPosts'])->name('posts.filter');

        // Social Features
        Route::get('/social-feed', [AuthController::class, 'socialFeed'])->name('social_feed');
        Route::get('/artist', [AuthController::class, 'showArtist'])->name('artist');
        Route::get('/artist/{id}', [AuthController::class, 'showArtistProfile'])->name('artist.profile');
        Route::get('/article', [AuthController::class, 'showArticles'])->name('articles');

        // Interactions
        Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
        Route::delete('/posts/{post}/unlike', [LikeController::class, 'destroy'])->name('posts.unlike');
        Route::post('/likes/toggle', [LikeController::class, 'toggle'])->name('likes.toggle');
        Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/posts/save', [SavedPostController::class, 'toggleSave'])->name('posts.save');

        // Tags
        Route::get('/tags/list', [AuthController::class, 'listTags']);

        // Language
        Route::post('/change-language', function (Request $request) {
            if (in_array($request->locale, ['en', 'es', 'fr'])) {
                session(['locale' => $request->locale]);
            }
            return redirect()->back();
        })->name('changeLang');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Admin Routes (with proper middleware)
        Route::prefix('admin')->middleware(['admin'])->group(function () {
            Route::get('/dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');

            // User Management
            Route::get('/users', [AdminController::class, 'showUserManagement'])->name('admin.user-management');
            Route::get('/users/{user}', [AdminController::class, 'getUser'])->name('admin.users.show');
            Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
            Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

            // Other Admin Routes (using kebab-case)
            Route::get('/artist-partners', [AdminController::class, 'showArtistPartner'])->name('admin.artist-partners');
            Route::get('/art-upload', [AdminController::class, 'showArtUpload'])->name('admin.arts-upload');
            Route::get('/backup', [AdminController::class, 'showBackup'])->name('admin.backup');
            Route::get('/location', [AdminController::class, 'showLocation'])->name('admin.location');
            Route::get('/reports', [AdminController::class, 'showReports'])->name('admin.reports');
            Route::get('/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
            Route::post('/posts/bulk-delete', [AdminController::class, 'bulkDeletePosts'])->name('admin.posts.bulk-delete');
            Route::get('/reports/{report}/details', [AdminController::class, 'getReportDetails'])->name('admin.reports.details');
        });
    });
});
Route::get('/dashboard/chart-data', [AdminController::class, 'chartData']);
// API Routes
Route::get('/api/posts/{post}', function($postId) {
    try {
        $post = Post::with('user')->findOrFail($postId);
        return response()->json(['success' => true, 'post' => $post]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Post not found'], 404);
    }
});

Route::get('/api/tags', function () {
    return \App\Models\Tag::select('id', 'name')->get();
});
