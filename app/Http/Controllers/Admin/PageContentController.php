<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key')->all();
        return view('admin.content.pages.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Website content updated successfully.');
    }
}
