<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('featured', 1)->get();

        // $popularArticle = Article::with('likes')
        //         ->orderBy('likes_count', 'desc')
        //         ->take(1)
        //         ->get();

        $popularArticle = Article::select('title', 'created_at', 'body', 'cover_image', 'user_id')
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->take(1)
                ->get();

        return view('blogs.index', compact('articles', 'popularArticle'));
    }
}
