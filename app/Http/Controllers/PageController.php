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
