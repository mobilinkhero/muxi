<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'name' => $request->name,
            'review' => $request->review,
            'rating' => $request->rating,
            'is_published' => false, // Student submissions need moderation
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted for moderation.');
    }
}
