<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>
    
    @hasanyrole('publisher|admin|Super Admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 m-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('categories.store') }}" >
                        @csrf

                        <div class="space-y-6">
                            <!-- Name -->
                            <div class="mb-3">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                                <x-jet-input-error for="name" class="mt-2" />
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
    @endhasanyrole
</x-app-layout>
