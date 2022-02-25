<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class PublishArticle extends Component
{
    public Article $article;

    public function mount(Article $article){
        $this->article = $article;
    }

    public function published()
    {
        $this->article->featured = !$this->article->featured;

        $this->article->save();

        return redirect()->route('articles.index');
    }

    public function render()
    {
        return view('livewire.publish-article');
    }
}
