<?php

namespace App\Http\Livewire\FrontEnd;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    public $catergory;
    public $sortBy = 'recentdesc';

    protected $querystring = [
        'category' => ['except' => ''],
        'sortBy' => ['except' => 'recentdesc'],
    ];

    public function render()
    {
        $articles = Article::featured()->published();
        $catergories = Category::all();

        if($this->catergory){
            $articles->category($this->catergory);
        }

        $articles->{ $this->sortBy }();

        return view('livewire.front-end.blog', [
            'articles' => $articles->paginate(10),
            'categories' => $catergories,
            'selectedCategory' => $this->catergory,
            'selectedSortBy' => $this->sortBy
        ]);

    }

    public function changeCategory($catergory): void
    {
        $this->catergory = $this->catergory !== $catergory && $this->categoryExists($catergory) ? $catergory : null;
    }
    
    public function sortBy($sort): void
    {
        $this->sortBy = $this->validSort($sort) ? $sort : 'recentDesc';
    }

    public function categoryExists($catergory): bool
    {
        return Category::where('id', $catergory)->exists();
    }
    
    public function validSort($sort): bool
    {
        return in_array($sort, [
            'recentAsc',
            'recentDesc',
        ]);
    }
}
