<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="blog" class="bg-gray-100 px-4 xl:px-4 py-14">
                    <div class="mx-auto container">
                        <span role="contentinfo">
                        <h1 tabindex="0" class="focus:outline-none text-center text-3xl lg:text-5xl tracking-wider text-gray-900">Latest from our Blog</h1>
                    </span>
                        <div tabindex="0"  aria-label="Group of cards" class="focus:outline-none mt-12 lg:mt-24">
                            <div  class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-8">
                                @foreach ($popularArticle as $article)
                                    <div tabindex="0" class="focus:outline-none" aria-label="card 1">
                                        <img role="img" aria-label="code editor" tabindex="0" class="focus:outline-none w-full" src="{{ $article->getFirstMediaUrl('articles', 'thumb') }}" alt="code editor" />
                                        <div class="py-4 px-8 w-full flex justify-between bg-indigo-700">
                                            <p  tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">{{ $article->user->name }}</p>
                                            <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">{{ $article->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="bg-white px-10 py-6 rounded-bl-3xl rounded-br-3xl">
                                            <h1 tabindex="0" class="focus:outline-none text-4xl text-gray-900 font-semibold tracking-wider">{{ $article->title }}</h1>
                                            <p tabindex="0" class="focus:outline-none text-gray-700 text-base lg:text-lg lg:leading-8 tracking-wide mt-6 w-11/12">{!! Str::words($article->body, 200) !!}</p>
                                            <div class="w-full flex justify-end" >
                                                
                                                <button class="focus:outline-none focus:ring-2 ring-offset-2 focus:ring-gray-600 hover:opacity-75 mt-4 justify-end flex items-center cursor-pointer">
                                                    <span class=" text-base tracking-wide text-indigo-700">Read more</span>
                                                    <svg class="ml-3 lg:ml-6 text-indigo-700" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                                        <path d="M11.7998 1L18.9998 8.53662L11.7998 16.0732" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M1 8.53662H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="h-5 w-2"></div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <div>
                                    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8">
                                        @foreach($articles as $article)
                                            <div tabindex="0" class="focus:outline-none" aria-label="card 1" >
                                                <img tabindex="0" role="img" aria-label="gaming" class="focus:outline-none w-full bg-cover rounded-t-lg" src="{{ $article->getFirstMediaUrl('articles', 'thumb') }}" alt="games" />
                                                <div class="py-2 px-4 w-full flex justify-between bg-indigo-700">
                                                    <p tabindex="0" class="focus:outline-none  text-sm text-white font-semibold tracking-wide">{{ $article->user->name }}</p>
                                                    <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">{{ $article->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="bg-white px-3 lg:px-6 py-4 rounded-bl-3xl rounded-br-3xl mb-4">
                                                    <h1 tabindex="0" class="focus:outline-none text-lg text-gray-900 font-semibold tracking-wider">{{ $article->title }}</h1>
                                                    <p tabindex="0" class="focus:outline-none text-gray-700 text-sm lg:text-base lg:leading-8 pr-4 tracking-wide mt-2">{!! Str::words($article->body, 10) !!}</p>
                                                    <div class="w-full flex justify-between">                                                       
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
                                                        <div>
                                                            <a href="{{ route('articles.show', $article) }}">
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
                                                </div>
                                            </div>
                                        @endforeach                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>