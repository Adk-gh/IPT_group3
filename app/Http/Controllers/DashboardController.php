<?php
namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('admin.user.table', compact('users')); // Pass $users to the view
    }
    // app/Http/Controllers/DashboardController.php
 public function chartData()
    {
        // User growth data (last 6 months)
        $userGrowth = User::select(
                DB::raw('COUNT(*) as count'),
                DB::raw("DATE_FORMAT(created_at, '%b') as month")
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->pluck('count', 'month')
            ->toArray();

        // Artwork types data
        $artworkTypes = Post::select(
                'category',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        // Monthly uploads data (current year)
        $monthlyUploads = Post::select(
                DB::raw('COUNT(*) as count'),
                DB::raw("DATE_FORMAT(created_at, '%b') as month")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->pluck('count')
            ->toArray();

        return response()->json([
            'user_growth' => array_values($userGrowth),
            'user_growth_labels' => array_keys($userGrowth),
            'artwork_types' => array_values($artworkTypes),
            'artwork_types_labels' => array_keys($artworkTypes),
            'monthly_uploads' => $monthlyUploads,
            'monthly_uploads_labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ]
        ]);
    }
}

