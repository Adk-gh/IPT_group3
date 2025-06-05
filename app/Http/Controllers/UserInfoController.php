<?php
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class UserInfoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:1000',
            'birthdate' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();

        // Handle profile picture
        $profilePath = null;
        if ($request->hasFile('profile_picture')) {
            $image = Image::make($request->file('profile_picture'))->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $filename = uniqid().'_profile.jpg';
            $path = public_path('uploads/profiles/');
            $image->save($path . $filename);
            $profilePath = 'uploads/profiles/' . $filename;
        }

        // Handle cover photo
        $coverPath = null;
        if ($request->hasFile('cover_photo')) {
            $image = Image::make($request->file('cover_photo'))->resize(1200, 400);
            $filename = uniqid().'_cover.jpg';
            $path = public_path('uploads/covers/');
            $image->save($path . $filename);
            $coverPath = 'uploads/covers/' . $filename;
        }

        // Save or update user info
        UserInfo::updateOrCreate(
            ['user_id' => $user->id],
            [
                'bio' => $request->input('bio'),
                'birthdate' => $request->input('birthdate'),
                'profile_picture' => $profilePath,
                'cover_photo' => $coverPath,
                'location' => $request->input('location'),
                'phone' => $request->input('phone'),
            ]
        );

        return redirect()->back()->with('success', 'Profile updated!');
    }
}
