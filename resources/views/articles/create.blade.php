<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Article') }}
        </h2>
    </x-slot>

    @hasrole('writer|Super Admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 m-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            <!-- Title -->
                            <div class="mb-3">
                                <x-jet-label for="title" value="{{ __('Title') }}" />
                                <x-jet-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" autofocus autocomplete="title" />
                                <x-jet-input-error for="title" class="mt-2" />
                            </div>
                
                            <!-- Body -->
                            <div class="mb-3">
                                <x-jet-label for="body" value="{{ __('Enter your artilce:') }}" />
                                <x-trix name="body" styling="overflow-y-scroll h-96"></x-trix>
                                <x-jet-input-error for="body" class="mt-2" />
                            </div>
                            
                            <!-- Category -->
                            <div class="mb-3">
                                <x-jet-label for="category_id" value="{{ __('Categories') }}" />
                                <select name="category_id" id="category_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                                    <option value="">Please select a category</option>
                                    @foreach ($categories as $category )
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="category_id" class="mt-2" />
                            </div>
                
                            <!-- Tags -->
                            <div class="mb-3">
                                <x-jet-label value="{{ __('Tags:') }}" />
                
                                <select name="tags[]" id="tags" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 select2">
                                    <option value="">Select Article Tags</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="tag_id" class="mt-2" />
                            </div>
                
                            <!-- Published at -->
                            <div class="mb-3">
                                <x-jet-label for="published_at" value="{{ __('Schedule Date:') }}" />
                                <x-pikaday name="published_at" format="YYYY-MM-DD"/>
                                <x-jet-input-error for="published_at" class="mt-2" />
                            </div>
                
                            <!-- Cover Image -->
                            <div class="mb-3">
                                <x-jet-label for="cover_image" value="{{ __('Cover Image:') }}" />
                                <input name="cover_image" type="file" id="cover_image">
                                <x-jet-input-error for="cover_image" class="mt-2" />
                            </div>
                
                            <div class="mb-0">
                                <x-jet-button>
                                    {{ __('Create') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endhasrole
</x-app-layout>
