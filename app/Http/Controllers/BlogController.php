<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

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


    public function storeArticle(Request $request): JsonResponse
    {
        ini_set('memory_limit', '-1');
        $inputs = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'featured_image' => ['required'],
        ]);
        try{
            $article = new Blog();
            $article->title = $inputs['title'];
            $article->content = $inputs['content'];
            $article->featured_image = $inputs['featured_image'];
            $article->save();
            return response()->json(['success' => true, 'route' => route('dashboard')]);
        }catch(Exception $e){
            print_r($e);
            return response()->json(['success' => false, 'message' => "Something wenr wrong"]);
        }
        
    }
}
