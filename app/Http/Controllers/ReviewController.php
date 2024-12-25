<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review()
    {
        $reviews = Review::orderBy('created_at', 'desc')->paginate(3); // أو حسب الترتيب المطلوب
        return view('review', compact('reviews'));
    }

    public function storereview(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|numeric',
            'message' => 'required',
            'subject' => 'required',
            'email' => 'required|email'
        ]);

        $newreview = new Review();
        $newreview->name = htmlspecialchars($request->name);
        $newreview->phone = htmlspecialchars($request->phone);
        $newreview->email = htmlspecialchars($request->email);
        $newreview->subject = htmlspecialchars($request->subject);
        $newreview->message = htmlspecialchars($request->message);

        $newreview->save();

        return redirect()->route('review')->with('success', 'Your review has been submitted successfully!');
    }
}
