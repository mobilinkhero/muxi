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

        if ($request->filled('cropped_image')) {
            $data = $request->input('cropped_image');
            $image_parts = explode(";base64,", $data);
            $image_base64 = base64_decode($image_parts[1]);
            $filename = 'team/' . uniqid() . '.jpg';
            \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $image_base64);
            $member->image_url = '/storage/' . $filename;
        } elseif ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $member->image_url = '/storage/' . $path;
        }
        $member->save();

        return back()->with('success', 'Team member added.');
    }

    public function teamEdit($id)
    {
        $member = \App\Models\TeamMember::findOrFail($id);
        return view('admin.content.team.edit', compact('member'));
    }

    public function teamUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'image' => 'nullable|image',
        ]);

        $member = \App\Models\TeamMember::findOrFail($id);
        $member->fill($request->except('image', 'cropped_image'));

        if ($request->filled('cropped_image')) {
            $data = $request->input('cropped_image');
            $image_parts = explode(";base64,", $data);
            $image_base64 = base64_decode($image_parts[1]);
            $filename = 'team/' . uniqid() . '.jpg';
            \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $image_base64);
            $member->image_url = '/storage/' . $filename;
        } elseif ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $member->image_url = '/storage/' . $path;
        }

        $member->is_active = $request->has('is_active');
        $member->save();

        return redirect()->route('admin.content.team.index')->with('success', 'Team member updated.');
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
            'salary' => 'nullable',
            'experience_level' => 'nullable',
            'deadline' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        \App\Models\JobPosting::create($data);
        return back()->with('success', 'Job posting added.');
    }

    public function careerEdit($id)
    {
        $job = \App\Models\JobPosting::findOrFail($id);
        return view('admin.content.careers.edit', compact('job'));
    }

    public function careerUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'department' => 'required',
            'location' => 'required',
            'type' => 'required',
            'description' => 'required',
            'salary' => 'nullable',
            'experience_level' => 'nullable',
            'deadline' => 'nullable|date',
        ]);

        $job = \App\Models\JobPosting::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $job->update($data);

        return redirect()->route('admin.content.careers.index')->with('success', 'Job posting updated.');
    }

    public function careerDelete($id)
    {
        \App\Models\JobPosting::destroy($id);
        return back()->with('success', 'Job posting deleted.');
    }

    public function careerApplications($id)
    {
        $job = \App\Models\JobPosting::with('applications')->findOrFail($id);
        return view('admin.content.careers.applications', compact('job'));
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
        $post->is_published = $request->has('is_published');
        $post->published_at = $request->has('is_published') ? now() : null;
        $post->save();

        return redirect()->route('admin.content.blog.index')->with('success', 'Blog post created.');
    }

    public function blogEdit($id)
    {
        $post = \App\Models\BlogPost::findOrFail($id);
        return view('admin.content.blog.edit', compact('post'));
    }

    public function blogUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blog_posts,slug,' . $id,
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $post = \App\Models\BlogPost::findOrFail($id);
        $post->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $post->image_url = '/storage/' . $path;
        }

        // Handle publication status change logic if needed, simplify for now
        $post->is_published = $request->has('is_published');
        if ($post->is_published && !$post->published_at) {
            $post->published_at = now();
        } elseif (!$post->is_published) {
            $post->published_at = null;
        }

        $post->save();

        return redirect()->route('admin.content.blog.index')->with('success', 'Blog post updated.');
    }

    public function blogDelete($id)
    {
        \App\Models\BlogPost::destroy($id);
        return back()->with('success', 'Blog post deleted.');
    }

    // Review Methods
    public function reviewIndex()
    {
        $reviews = \App\Models\Review::latest()->get();
        return view('admin.content.reviews.index', compact('reviews'));
    }

    public function reviewStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');
        \App\Models\Review::create($data);

        return back()->with('success', 'Review added successfully.');
    }

    public function reviewDelete($id)
    {
        \App\Models\Review::destroy($id);
        return back()->with('success', 'Review deleted.');
    }
}
