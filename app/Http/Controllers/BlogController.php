<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function returnBlogList(){
        $allBlogPosts = Blog::select('title', 'updated_at', 'id')->get();
        
        return view('index')
            ->with('posts', $allBlogPosts);
    }
}
