<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
    public function __construct()
    {
        $this->middleware(['auth', 'profile.complete', 'admin']);
    }

    public function showAdminDashboard()
    {
        $reportCount = PostReport::count();
        $stats = [
            'locations' => Post::count(),
            'users' => User::count(),
            'artworks' => Post::count(),
            'reports' => $reportCount,
            'verified_artists' => User::where('verified_artist', 1)->count(),
            'comments' => Comment::count(),
        ];
        $reports = PostReport::with(['post.user', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(5);
Log::debug('Showing view: ' . request()->path());
       return view('admin.Dashboard', ['stats' => $stats, 'reports' => $reports]);
    }

    // User Management Methods
public function showUserManagement(Request $request)
{
    // Get all non-admin users with post counts
    $users = User::where('email', '!=', 'admin@gmail.com')
        ->withCount('posts')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // Get verified artists separately
    $artists = User::where('verified_artist', 1)
        ->orderBy('name')
        ->get();

    return $request->expectsJson()
        ? response()->json($users)
        : view('admin.UserManagement', [
            'users' => $users,
            'verifiedArtists' => $artists  // Changed variable name for clarity
        ]);
}
    public function getUser(User $user)
    {
        return response()->json([
            'user' => $user->loadCount('posts'),
            'profile_picture_url' => $user->profile_picture
                ? Storage::url($user->profile_picture)
                : asset('/img/default.jpg')
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return response()->json(['message' => 'You cannot modify your own account'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'role' => 'required|in:user,artist,admin',
            'status' => 'required|in:active,inactive,banned',
            'verified_artist' => 'nullable|boolean',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                Storage::delete($user->profile_picture);
                $validated['profile_picture'] = $request->file('profile_picture')
                    ->store('profile_pictures', 'public');
            }

            $user->update($validated);

            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user->fresh()
            ]);
        } catch (\Exception $e) {
            Log::error("User update failed: {$e->getMessage()}");
            return response()->json(['message' => 'Error updating user'], 500);
        }
    }

    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return response()->json(['message' => 'You cannot deactivate your own account'], 403);
        }

        try {
            $user->update(['status' => 'inactive']);
            return response()->json(['message' => 'User deactivated successfully']);
        } catch (\Exception $e) {
            Log::error("User deactivation failed: {$e->getMessage()}");
            return response()->json(['message' => 'Error deactivating user'], 500);
        }
    }



    public function showArtistPartner()
    {
        return view('admin.ArtistPartners');
    }

    public function showArtUpload()
    {
        Log::debug('Showing view: ' . request()->path());
        $posts = Post::with(['user', 'comments', 'likes'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

        return view('admin.ArtUpload', compact('posts'));
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
        $reports = PostReport::with(['post.user', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(5);
                // In any controller method
Log::debug('Showing view: ' . request()->path());
        return view('admin.Reports', compact('reports'));

    }

    public function getReportDetails($reportId)
    {
        Log::debug('Showing view: ' . request()->path());
        try {
            $report = PostReport::with([
                    'reporter',
                    'post.user',
                    'post'
                ])
                ->findOrFail($reportId);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $report->id,
                    'reason' => $report->reason,
                    'additional_info' => $report->additional_info,
                    'status' => $report->status,
                    'created_at' => $report->created_at,
                    'reviewed_at' => $report->reviewed_at,
                    'moderator_notes' => $report->moderator_notes,
                    'reporter' => $report->reporter,
                    'reported_user' => $report->post->user ?? null,
                    'post' => $report->post
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Report not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function showSettings()
    {
        return view('admin.Settings');
    }




    public function scopeVerifiedArtists($query)
    {
        return $query->where('verified_artist', 1);
    }

    public function chartData()
    {
        $userGrowth = DB::table('users')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $artUploads = DB::table('posts')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'userGrowth' => $userGrowth,
            'artUploads' => $artUploads,
        ]);
    }

    public function bulkDeletePosts(Request $request)
    {
        try {
            $postIds = $request->input('postIds', []);

            // Delete posts
            Post::whereIn('id', $postIds)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Posts deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting posts: ' . $e->getMessage()
            ], 500);
        }
    }
}
