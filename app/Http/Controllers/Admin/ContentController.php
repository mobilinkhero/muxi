<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    // Team Methods
    public function teamIndex()
    {
        $members = \App\Models\TeamMember::all();
        return view('admin.content.team.index', compact('members'));
    }

    public function teamStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'image' => 'nullable|image',
        ]);

        $member = new \App\Models\TeamMember($request->all());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $member->image_url = '/storage/' . $path;
        }
        $member->save();

        return back()->with('success', 'Team member added.');
    }

    public function teamDelete($id)
    {
        \App\Models\TeamMember::destroy($id);
        return back()->with('success', 'Team member deleted.');
    }

    // Careers Methods
    public function careersIndex()
    {
        $jobs = \App\Models\JobPosting::all();
        return view('admin.content.careers.index', compact('jobs'));
    }

    public function careerStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'department' => 'required',
            'location' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        \App\Models\JobPosting::create($request->all());
        return back()->with('success', 'Job posting added.');
    }

    public function careerDelete($id)
    {
        \App\Models\JobPosting::destroy($id);
        return back()->with('success', 'Job posting deleted.');
    }

    // Blog Methods
    public function blogIndex()
    {
        $posts = \App\Models\BlogPost::latest()->get();
        return view('admin.content.blog.index', compact('posts'));
    }

    public function blogCreate()
    {
        return view('admin.content.blog.create');
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blog_posts',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $post = new \App\Models\BlogPost($request->all());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $post->image_url = '/storage/' . $path;
        }
        $post->published_at = $request->is_published ? now() : null;
        $post->save();

        return redirect()->route('admin.content.blog.index')->with('success', 'Blog post created.');
    }

    public function blogDelete($id)
    {
        \App\Models\BlogPost::destroy($id);
        return back()->with('success', 'Blog post deleted.');
    }
}
