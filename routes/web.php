<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home',['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about',['name' => 'Muhammad Rifki Ramadhani', 'title' => 'About'] );
});

Route::get('/posts', function () {
    return view('posts', [
        'tittle' => 'Blog',
        'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(9)->withQueryString()]);
});


Route::get('/posts/{post:slug}', function (Post $post){
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user){
    // $posts = $user->posts->load('category', 'author');

    return view('posts', ['title' => count($user->posts) . ' Article by ' . $user->name, 'posts' => $user -> posts]);
});

Route::get('/categories/{category:slug}', function (Category $category){
    // $posts = $category->posts->load('category', 'author');

    return view('posts', ['title' =>  'Article in ' . $category->name, 'posts' => $category -> posts]);
});

Route::get('/contact', function () {
    return view('contact',['title' => 'Contact'] );
});