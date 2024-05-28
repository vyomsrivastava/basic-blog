<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function returnBlogList()
    {
        $allBlogPosts = Blog::select('title', 'updated_at', 'id')->get();

        return view('index')
            ->with('posts', $allBlogPosts);
    }

    public function createArticle()
    {
        return view('admin.create-article');
    }


    public function storeArticle(Request $request): RedirectResponse
    {
        $inputs = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'featured_image' => ['required'],
        ]);
        dd($inputs);
    }
}
