<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;

it('it returns the index page', function (){
    $this->withExceptionHandling();
    $this->artisan('migrate');
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertViewHas('posts'); //Check if the variable is present or not
});


it('it returns the index page with an article', function (){
    $this->withExceptionHandling();
    Blog::create(
        [
            "title" => "Random Title",
            "content" => "Content",
            "is_public" => 1,
            "featured_image" => "apple"
        ]
        );
    $post = Blog::select('title', 'updated_at', 'id', 'content', 'featured_image')->get();
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertViewHas('posts'); //Check if the variable is present or not
    $response->assertViewHas('posts', $post); 
});

it('it updates an article with new title', function (){

    $user = User::first();
    $post = Blog::create(
        [
            "title" => "Random Title",
            "content" => "Content",
            "is_public" => 1,
            "featured_image" => "apple"
        ]
        );
    
    $response = $this->actingAs($user)->patch(route('update-article', ['id' => $post->id]), [
        'title' => "New Title",
        'content' => $post->content,
        'featured_image' => $post->featured_image
    ]);
    $response->assertJson(['success' => true, 'route' => route('dashboard')]);
});

it('it does not update article because of missing required param and returns validation error', function (){
    $this->withExceptionHandling();
    $user = User::first();
    $post = Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    
    $response = $this->actingAs($user)->patch(route('update-article', ['id' => $post->id]), [
        'title' => "New Title",
        'featured_image' => $post->featured_image
    ]);
    $errors = session('errors');
    $response->assertSessionHasErrors();
    $this->assertEquals($errors->get('content')[0], 'The content field is required.'); //Check for exact error message
});

it('it doesnot update article because of incorrect article ID and returns error', function (){
    $this->withExceptionHandling();
    $user = User::first();
    $post = Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    
    $response = $this->actingAs($user)->patch(route('update-article', ['id' => 999999999]), [
        'title' => "New Title",
        "content" => "Content",
        'featured_image' => $post->featured_image
    ]);
    $response->assertJson(['success' => false, 'message' => "Article not found"]);
});

it('it returns dashboard of admin page with article variable', function (){
    $this->withExceptionHandling();
    $user = User::first();
    $post = Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    
    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertStatus(200);
    $response->assertViewHas('articles');
});

it('it returns dashboard of admin page with article collection', function (){
    $this->withExceptionHandling();
    $user = User::first();
    Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    $articles = Blog::get();
    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertStatus(200);
    $response->assertViewHas('articles');
    $response->assertViewHas('articles', $articles); 
});

it('it returns edit page for an article with all details', function (){
    $this->withExceptionHandling();
    $user = User::first();
    $post = Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    $response = $this->actingAs($user)->get(route('edit-article', ['id' => $post->id]));
    $response->assertStatus(200);
    $response->assertViewHas('article');
    $response->assertViewHas('article', $post); 
});

it('it returns 404 instead of article edit page', function (){
    $this->withExceptionHandling();
    $user = User::first();
    $post = Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    $response = $this->actingAs($user)->get(route('edit-article', ['id' => 69696969]));
    $response->assertStatus(404);
});

it('it returns article details page', function (){
    $this->withExceptionHandling();
    $user = User::first();
    $post = Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    $response = $this->actingAs($user)->get(route('detail-article', ['id' => $post->id]));
    $response->assertStatus(200);
    $response->assertViewHas('article');
    $response->assertViewHas('article', $post); 
});

it('it returns 404 as the article id doesn not exist', function (){
    $this->withExceptionHandling();
    $user = User::first();
    $post = Blog::create(
            [
                "title" => "Random Title",
                "content" => "Content",
                "is_public" => 1,
                "featured_image" => "apple"
            ]
        );
    $response = $this->actingAs($user)->get(route('detail-article', ['id' => 6969696969]));
    $response->assertStatus(404);
});