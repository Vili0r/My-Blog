<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        $articles->load(['user', 'category']);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create articles');

        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleStoreRequest $request)
    {
        $this->authorize('create articles');

        $article = Article::create($request->validated() + [
            'user_id' => auth()->id(),
            'category_id' => $request->category_id
        ]);

        $article->tags()->attach($request->tags);

        if($request->hasFile('cover_image')) {   
            $article->addMediaFromRequest('cover_image')->toMediaCollection('articles');
        }

        return redirect()->route('articles.index')->banner('Article created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('edit articles');

        $categories = Category::all();
        $tags = Tag::all();

        $article->load('tags');

        return view('articles.edit', compact('categories', 'tags', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleStoreRequest $request, Article $article)
    {
        $this->authorize('edit articles');

        $article->update($request->validated() + ['category_id' => $request->category_id]);
        $article->tags()->sync($request->tags);

        return redirect()->route('articles.index')->banner('Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete articles');

        $article->delete();

        return redirect()->route('articles.index')->dangerBanner('Article deleted.');
    }
}
