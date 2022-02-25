<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleLikeController extends Controller
{
    public function store(Article $article, Request $request)
    {
        if($article->likedBy($request->user())) {
            return response(null, 409);
        }

        $article->likes()->create([
            'user_id' => auth()->id()
        ]);

        return back();
    }

    public function destroy(Article $article, Request $request)
    {
        $request->user()->likes()->where('article_id', $article->id)->delete();

        return back();
    }
}
