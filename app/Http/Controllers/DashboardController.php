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
       // Fetch all users
$users = User::all();

// Count unique locations from posts
$uniqueLocationsCount = Post::whereNotNull('location_name')
                            ->distinct('location_name')
                            ->count('location_name');

// Pass both variables to the 'dashboard' view
return view('admin.dashboard', compact('users', 'uniqueLocationsCount'));
    }

    // app/Http/Controllers/DashboardController.php
   public function chartData()
{
    try {
        // User growth data (last 6 months)
        $userGrowth = User::select(
                DB::raw('COUNT(*) as count'),
                DB::raw("DATE_FORMAT(created_at, '%b') as month")
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        // Fill missing months with 0
        $months = [];
        $currentMonth = Carbon::now()->month;
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('M');
            $months[$month] = 0;
        }

        foreach ($userGrowth as $growth) {
            $months[$growth->month] = $growth->count;
        }

        // Artwork types data
        $artworkTypes = Post::select(
                'category',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('category')
            ->get();

        $artworkTypesData = [];
        $artworkTypesLabels = [];
        foreach ($artworkTypes as $type) {
            $artworkTypesLabels[] = $type->category;
            $artworkTypesData[] = $type->count;
        }

        // Monthly uploads data (current year)
        $monthlyUploads = Post::select(
                DB::raw('COUNT(*) as count'),
                DB::raw("DATE_FORMAT(created_at, '%b') as month")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        $uploadsData = array_fill(0, 12, 0);
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($monthlyUploads as $upload) {
            $monthIndex = array_search($upload->month, $monthNames);
            if ($monthIndex !== false) {
                $uploadsData[$monthIndex] = $upload->count;
            }
        }

        return response()->json([
            'user_growth' => array_values($months),
            'user_growth_labels' => array_keys($months),
            'artwork_types' => $artworkTypesData,
            'artwork_types_labels' => $artworkTypesLabels,
            'monthly_uploads' => $uploadsData,
            'monthly_uploads_labels' => $monthNames
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Failed to fetch chart data',
            'message' => $e->getMessage()
        ], 500);
    }
}
}
