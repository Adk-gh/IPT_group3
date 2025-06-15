<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileSetupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SavedPostController;
use App\Http\Controllers\ContactController;
use App\Models\Post;
use Illuminate\Http\Request;

// 🔓 Public Routes
Route::get('/', [AuthController::class, 'showSignInForm'])->name('signin');
Route::get('/signup', [AuthController::class, 'showSignUpForm'])->name('register');
Route::post('/signup', [AuthController::class, 'signUp'])->name('register.post');
Route::get('/signin', [AuthController::class, 'showSignInForm'])->name('login');
Route::post('/signin', [AuthController::class, 'signIn'])->name('login.post');
Route::get('/about', [AuthController::class, 'showAboutUs'])->name('aboutus');
Route::get('/contact', [AuthController::class, 'showContact'])->name('contact');
Route::get('/support', [AuthController::class, 'showSupport'])->name('support');
Route::get('/patterns', [AuthController::class, 'showPatterns'])->name('patterns');

// 🔐 Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Profile setup
    Route::get('/ProfileSetup', [ProfileSetupController::class, 'show'])->name('profile.setup');
    Route::post('/ProfileSetup', [ProfileSetupController::class, 'store'])->name('profile.setup.store');
    Route::post('/ProfileSetup/skip', [ProfileSetupController::class, 'skip'])->name('profile.skip');

    // Complete profile required routes
    Route::middleware(['profile.complete'])->group(function () {
        Route::get('/home', [AuthController::class, 'showIndex'])->name('home');
        Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
        Route::post('/user/cover-update', [AuthController::class, 'updateCoverPhoto'])->name('user.cover.update');
        Route::post('/user/bio-update', [AuthController::class, 'updateBio'])->name('user.bio.update');

        // Posts
        Route::post('/posts', [AuthController::class, 'storePost'])->name('posts.store');
        Route::get('/posts', function () {
            $posts = Post::with(['user', 'tags'])->latest()->get();
            return view('posts.index', compact('posts'));
        });

        // Social features
        Route::get('/social-feed', [AuthController::class, 'socialFeed'])->name('social_feed');
        Route::get('/artist', [AuthController::class, 'showArtist'])->name('artist');
        Route::get('/artist/{id}', [AuthController::class, 'showArtistProfile'])->name('artist.profile');
        Route::get('/article', [AuthController::class, 'showArticles'])->name('articles');

        // Likes & Comments
        Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
        Route::delete('/posts/{post}/unlike', [LikeController::class, 'destroy'])->name('posts.unlike');
        Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/posts/{post}/share', [AuthController::class, 'share'])->name('posts.share');

        // Saved posts
        Route::post('/posts/save', [SavedPostController::class, 'toggleSave'])->name('posts.save');

        // Reports
        Route::post('/posts/{post}/report', [AuthController::class, 'report'])->name('posts.report');
    });

    // Admin routes with email verification
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
        Route::get('/ArtistPartners', [AdminController::class, 'showArtistPartner'])->name('admin.ArtistPartners');
        Route::get('/ArtUpload', [AdminController::class, 'showArtUpload'])->name('admin.ArtUpload');
        Route::get('/Backup', [AdminController::class, 'showBackup'])->name('admin.Backup');
        Route::get('/Location', [AdminController::class, 'showLocation'])->name('admin.Location');
        Route::get('/Reports', [AdminController::class, 'showReports'])->name('admin.Reports');
        Route::get('/Settings', [AdminController::class, 'showSettings'])->name('admin.Settings');
        Route::get('/UserManagement', [AdminController::class, 'showUserManagement'])->name('admin.UserManagement');
        Route::post('/posts/bulk-delete', [AdminController::class, 'bulkDeletePosts'])->name('admin.posts.bulk-delete');
        Route::get('/reports/{report}/details', [AdminController::class, 'getReportDetails'])->name('reports.details');

    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// API Routes
Route::get('/api/posts/{post}', function($postId) {
    try {
        $post = Post::with('user')->findOrFail($postId);
        return response()->json([
            'success' => true,
            'post' => $post
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Post not found'
        ], 404);
    }
});

Route::get('/api/tags', function () {
    return \App\Models\Tag::select('id', 'name')->get();
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/change-language', function (Request $request) {
    $locale = $request->input('locale');
    if (in_array($locale, ['en', 'es', 'fr'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('changeLang');

 Route::get('/dashboard/chart-data', [AdminController::class, 'chartData']);
 
Route::post('/likes/toggle', [LikeController::class, 'toggle'])->name('likes.toggle');
Route::get('/tags/list', [AuthController::class, 'listTags'])->name('tags.list');
Route::get('/posts/filter', [AuthController::class, 'filterPosts'])->name('posts.filter');
