<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-8 mx-auto">
        <div class="lg:flex lg:-mx-2">
            <div class="space-y-3 lg:w-1/5 lg:px-2 lg:space-y-4">
                <div class="flex items-center">
                    <h2 class="mr-4">Sort:</h2>
                    <div class="space-x-4">
                        <button wire:click="sortBy('recentAsc')" class="{{ $selectedSortBy === 'recentAsc' ? 'bg-indigo-500 text-white focus:outline-none' : '' }} p-1">
                            <x-heroicon-o-sort-ascending class="w-8 h-8"/>
                        </button>
                        <button wire:click="sortBy('recentDesc')" class="{{ $selectedSortBy === 'recentDesc' ? 'bg-indigo-500 text-white focus:outline-none' : '' }} p-1">
                            <x-heroicon-o-sort-descending class="w-8 h-8"/>
                        </button>
                    </div>
                </div>
                {{-- Categories --}}
                <div>
                    <div class="p-2 text-black">
                        <h2>Categories</h2>
                        <div class="flex flex-col items-start">
                            @foreach($categories as $category)
                                <button wire:click="changeCategory('{{ $category->id }}')" 
                                    class="{{ $selectedCategory == $category->id ? 'bg-indigo-500 text-white focus:outline-none' : '' }} p-2">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 lg:mt-0 lg:px-2 lg:w-4/5 ">
                
                
                <div class="grid grid-cols-1 mb-4">
                    @foreach($articles as $article)
                        <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <a href="{{ route('blog.show', $article) }}">
                                <img class="rounded-t-lg" src="{{ $article->getFirstMediaUrl('articles', 'thumb') }}" alt="" />
                            </a>
                            <div class="p-5">
                                <a href="{{ route('blog.show', $article) }}">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->title }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! Str::words($article->body, 10) !!} </p>
                                <div class="flex justify-between">
                                    <p tabindex="0" class="focus:outline-none  text-sm text-white font-semibold tracking-wide">{{ $article->user->name }}</p>
                                    <div class="w-full flex justify-between"> 
                                        @auth  
                                            <div class="mt-2">
                                                <form method="POST" action="{{ route('articles.likes', $article) }}">
                                                    @csrf
                                                    <button type="submit"><x-bxs-like class="h-8 w-8"/></button>                                                              
                                                </form>                                                       
                                            </div>
                                            <div class="mt-2">
                                                <form method="POST" action="{{ route('articles.likes', $article) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><x-bxs-dislike class="h-8 w-8"/></button>
                                                </form>                                                                                            
                                            </div> 
                                        @else
                                        <a href="{{ route('blog.show', $article) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Read more
                                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </a>                          
                                        @endauth                                                             
                                    </div>
                                    <p class="text-gray-600 text-xs md:text-sm">{{ $article->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="grid grid-cols-1 gap-8 mt-8">
                            <div class="flex flex-col items-center justify-center w-full max-w-lg mx-auto">
                                <a href="#" class="flex flex-wrap no-underline hover:no-underline">	
                                    <img src="{{ $article->getFirstMediaUrl('articles', 'thumb') }}" class="h-full w-full rounded-t pb-6">
                                    <p class="w-full text-gray-600 text-xs md:text-sm px-6">GETTING STARTED</p>
                                    <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $article->title }}</div>
                                    <p class="text-gray-800 font-serif text-base px-6 mb-5">
                                        {!! Str::words($article->body, 10) !!} 
                                    </p>
                                </a>
                            </div>
                            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                                <div class="flex items-center justify-between">
                                    <p tabindex="0" class="focus:outline-none  text-sm text-white font-semibold tracking-wide">{{ $article->user->name }}</p>
                                    <div class="w-full flex justify-between"> 
                                        @auth  
                                            <div class="mt-2">
                                                <form method="POST" action="{{ route('articles.likes', $article) }}">
                                                    @csrf
                                                    <button type="submit"><x-bxs-like class="h-8 w-8"/></button>                                                              
                                                </form>                                                       
                                            </div>
                                            <div class="mt-2">
                                                <form method="POST" action="{{ route('articles.likes', $article) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><x-bxs-dislike class="h-8 w-8"/></button>
                                                </form>                                                                                            
                                            </div>                                
                                        @endauth                                                      
                                        <div>
                                            <a href="{{ route('blog.show', $article) }}">
                                                <button class="focus:outline-none focus:ring-2 ring-offset-2 focus:ring-gray-600 hover:opacity-75 mt-4 justify-end flex items-center cursor-pointer">
                                                    <span class=" text-base tracking-wide text-indigo-700">Read more</span>
                                                    <svg class="ml-3 lg:ml-6 text-indigo-700" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                                        <path d="M11.7998 1L18.9998 8.53662L11.7998 16.0732" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M1 8.53662H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>       
                                    </div>
                                    <p class="text-gray-600 text-xs md:text-sm">{{ $article->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                        </div> --}}
                            
            </div>
        </div>
    </div>
</section>