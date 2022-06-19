<x-guest-layout>
    <div id="blog" class="bg-gray-100 px-4 xl:px-4 py-14">
        <div class="mx-auto container">
            <span role="contentinfo">
                <h1 tabindex="0" class="focus:outline-none text-center text-3xl lg:text-5xl tracking-wider text-gray-900">{{ $article->title }}</h1>
            </span>
            <div tabindex="0"  aria-label="Group of cards" class="focus:outline-none mt-12 lg:mt-24">
                <div  class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-8">
                    <div tabindex="0" class="focus:outline-none" aria-label="card 1">
                        <img role="img" aria-label="code editor" tabindex="0" class="focus:outline-none w-full ounded-t-lg" src="{{ $article->getFirstMediaUrl('articles', 'thumb') }}" alt="code editor" />
                        <div class="py-4 px-8 w-full flex justify-between bg-indigo-700">
                            <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">Category: {{ $article->category->name }}</p>
                            <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">{{ $article->likes->count() }} {{ Str::plural('like', $article->likes->count()) }}</p>
                            <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">Author: {{ $article->user->name }}</p>
                        </div>
                        <div class="bg-white px-10 py-6 rounded-bl-3xl rounded-br-3xl">
                            <p tabindex="0" class="focus:outline-none text-gray-700 text-base lg:text-lg lg:leading-8 tracking-wide mt-6 w-11/12">{!! $article->body !!}</p>
                            <br>
                            <hr>
                            <br>
                            <div>
                                <form method="POST" action="{{ route('articles.comments.store', $article) }}">
                                    @csrf
                                    <textarea class="w-full mb-2" name="comment_text" rows="3" required></textarea>
                                    <br>
                                    @auth
                                        <x-jet-button type="submit" class="bg-cyan-500 hover:bg-cyan-600 mb-4">
                                            Add Comment
                                        </x-jet-button>
                                    @else 
                                        <x-jet-button type="submit" disabled class="bg-cyan-500 hover:bg-cyan-600 mb-4">
                                            Add Comment
                                        </x-jet-button>
                                    @endauth
                                </form>
                            </div>
                            <div>
                                @forelse ($article->comments as $comment)
                                <div class="mb-5 bg-white px-4 py-6 rounded-sm shadow-md">
                                    <div class="flex">
                                        <div class="flex flex-col justify-center">
                                            <p class="mr-2 font-bold">{{ $comment->user->name }}</p>
                                            <p class="text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <p>{{ $comment->comment_text }}</p>
                                    </div>

                                    <form method="POST" action="{{ route('articles.comments.destroy', [$article, $comment]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md hover:bg-red-600">Delete</button>
                                    </form>
                                </div>
                                @empty
                                    There are no comments.
                                @endforelse 
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>