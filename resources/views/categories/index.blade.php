<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around">
            <div class="flex-1 w-64">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Categories') }}
                </h2>
            </div>
            <div class="flex justify-end w-32">
                @hasanyrole('publisher|admin|Super Admin')
                <a href="{{ route('categories.create') }}">
                    <x-bxs-category class="w-8 h-8"/>
                </a>
                @endhasanyrole
            </div>            
        </div>
        
    </x-slot>

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
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Used Category</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Created at</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key=>$category)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $key+1 }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $category->name }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $category->articles_count_per_category }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $category->created_at->format('y/m/d') }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light justify-center">
                                        @hasanyrole('publisher|admin|Super Admin')
                                        <div class="flex gap-2">
                                            <button class="mb-2 bg-yellow-200 hover:bg-yellow-400" 
                                                    onclick='Livewire.emit("openModal", "edit-category", {{ json_encode([$category]) }})'>
                                                <x-ri-edit-fill class="w-6 h-6"/>
                                            </button>
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-400 hover:bg-red-600" type="submit" onclick="return confirm('Are you sure?')">
                                                    <x-eos-delete class="w-6 h-6"/>
                                                </button>
                                            </form>
                                        </div>
                                        @endhasanyrole
                                    </td>
                                </tr>
                            @empty
                                There are no categories
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
