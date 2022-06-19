<?php

namespace App\Http\Controllers;

use App\Models\Article;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularArticles = Article::featured()
                ->published()
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->take(4)
                ->get();

        return view('welcome', compact('popularArticles'));
    }

    public function show(Article $article)
    {
        return view('blog.show', compact('article'));
    }

    public function posts()
    {
        return view('blog.posts');
    }
}
