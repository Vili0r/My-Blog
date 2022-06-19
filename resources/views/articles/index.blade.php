<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <div class="flex-1 w-64">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Articles') }}
                </h2>
            </div>
            <div class="flex justify-end w-32">
                @hasrole('writer|Super Admin')
                    <a href="{{ route('articles.create') }}">
                        <x-ri-article-line class="w-8 h-8"/>
                    </a>
                @endhasrole
            </div>            
        </div>
        
    </x-slot>
    
    @hasanyrole('publisher|admin|writer|Super Admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-2/3 mx-auto">
                    <div class="bg-white shadow-md rounded my-6">
                      <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                        <thead>
                          <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">#</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Title</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Author</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Category</th>
                            @hasanyrole('publisher|admin|Super Admin')
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Publish</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"># likes</th>
                            @endhasanyrole
                            @hasrole('writer|Super Admin')
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
                            @endhasrole
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $key=>$article)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $key+1 }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $article->title }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $article->user->name }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $article->category->name }}</td>
                                    @hasanyrole('publisher|admin|Super Admin')
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <livewire:publish-article :article="$article">
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $article->number_of_likes }}</td>
                                    @endhasanyrole
                                    @hasrole('writer|Super Admin')
                                    <td class="py-4 px-6 border-b border-grey-light justify-center">   
                                        <div class="flex gap-2">
                                            <x-jet-secondary-button class="bg-yellow-200 hover:bg-yellow-400">
                                                <a href="{{ route('articles.edit', $article) }}"><x-ri-edit-fill class="w-6 h-6"/></a>
                                            </x-jet-secondary-button>
                                            <form method="POST" action="{{ route('articles.destroy', $article) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-jet-secondary-button class="bg-red-400 hover:bg-red-600" type="submit" onclick="return confirm('Are you sure?')">
                                                    <x-eos-delete class="w-6 h-6"/>
                                                </x-jet-secondary-button>
                                            </form>
                                        </div>
                                    </td>
                                    @endhasrole
                                </tr>
                            @empty
                                There are no articles 
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endhasanyrole
</x-app-layout>
