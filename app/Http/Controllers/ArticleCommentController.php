<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCommentStoreRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCommentStoreRequest $request, Article $article)
    {
        $article->comments()->create($request->validated() + [
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, Comment $comment)
    {
        if ($comment->user_id != auth()->id()){
            abort(403);
        }

        $comment->delete();

        return back();
    }
}
