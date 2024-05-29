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
        $allBlogPosts = Blog::select('title', 'updated_at', 'id', 'content', 'featured_image')->get();

        return view('index')
            ->with('posts', $allBlogPosts);
    }

    public function createArticle()
    {
        return view('admin.create-article');
    }


    public function storeArticle(Request $request): JsonResponse
    {
        
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
            return response()->json(['success' => false, 'message' => "Something went wrong"]);
        }
    }

    public function editArticle($id) 
    {
        $article = Blog::find($id);
        if($article){
            return view('admin.edit-article')->with('article', $article);
        }else{
            return route('dashboard');
        }
    }

    public function updateArticle(Request $request, $id) 
    {
        $inputs = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'featured_image' => ['nullable']
        ]);

        $article = Blog::find($id);
        if($article){
            $article->title = $inputs['title'];
            $article->content = $inputs['content'];
            if(isset($inputs['featured_image'])){
                $article->featured_image = $inputs['featured_image'];
            }
            $article->save();
            return response()->json(['success' => true, 'route' => route('dashboard')]);
        }else{
            echo "H";
        }
    }

    public function deleteArticle($id) 
    {
        $article = Blog::find($id);
        if($article){
            $article->delete();
            return redirect()->route('dashboard')->with('success' , 'Deleted Successfully');
        }else{
            return redirect()->route('dashboard')->with('error', 'Article not found');
        }
    }
}
