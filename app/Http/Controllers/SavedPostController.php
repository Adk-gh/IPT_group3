<?php
// app/Http/Controllers/SavedPostController.php
namespace App\Http\Controllers;

use App\Models\SavedPost;
use Illuminate\Http\Request;

class SavedPostController extends Controller
{
    public function toggleSave(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id'
        ]);

        $userId = auth()->id();
        $postId = $request->post_id;

        $savedPost = SavedPost::where('user_id', $userId)
                            ->where('post_id', $postId)
                            ->first();

        if ($savedPost) {
            $savedPost->delete();
            return response()->json([
                'success' => true,
                'saved' => false,
                'message' => 'Post unsaved successfully'
            ]);
        }

        SavedPost::create([
            'user_id' => $userId,
            'post_id' => $postId
        ]);

        return response()->json([
            'success' => true,
            'saved' => true,
            'message' => 'Post saved successfully'
        ]);
    }
}
