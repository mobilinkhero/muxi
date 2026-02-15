<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Markets
    public function crypto()
    {
        return view('markets.crypto');
    }

    public function forex()
    {
        return view('markets.forex');
    }

    public function stocks()
    {
        return view('markets.stocks');
    }

    public function commodities()
    {
        return view('markets.commodities');
    }

    // Company
    public function about()
    {
        return view('company.about');
    }

    public function team()
    {
        $members = \App\Models\TeamMember::where('is_active', true)->get();
        return view('company.team', compact('members'));
    }

    public function careers()
    {
        $jobs = \App\Models\JobPosting::where('is_active', true)->get();
        return view('company.careers', compact('jobs'));
    }

    public function careerShow($id)
    {
        $job = \App\Models\JobPosting::where('id', $id)->where('is_active', true)->firstOrFail();
        return view('company.careers_show', compact('job'));
    }

    public function careerApply(Request $request, $id)
    {
        $job = \App\Models\JobPosting::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('cv')->store('resumes', 'public');

        \App\Models\JobApplication::create([
            'job_posting_id' => $job->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv_path' => '/storage/' . $path,
            'cover_letter' => $request->cover_letter,
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    // Blog
    public function blog()
    {
        $posts = \App\Models\BlogPost::where('is_published', true)->orderBy('published_at', 'desc')->paginate(10);
        return view('company.blog.index', compact('posts'));
    }

    public function blogPost($slug)
    {
        $post = \App\Models\BlogPost::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('company.blog.show', compact('post'));
    }
}
