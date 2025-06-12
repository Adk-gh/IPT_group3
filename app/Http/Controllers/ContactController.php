<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $validated = $request->validate([
                'fullName' => 'required|string|max:255',
                'email' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|string',
                'agreeTerms' => 'required|accepted'
            ]);

         Log::info('Form data validated:', $validated);

            // Send the email
            Mail::to('streetandink@gmail.com')->send(new ContactFormSubmission($validated));
            Log::info('Email sent to streetandink@gmail.com with subject: ' . $validated['subject']);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Server error occurred',
                'details' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }
}