<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update user') }}
        </h2>
    </x-slot>

    @hasrole('Super Admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 m-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Name -->
                            <div class="mb-3">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block w-full mt-1" type="text" name="name" :value="$user->name" autofocus autocomplete="name" />
                                <x-jet-input-error for="name" class="mt-2" />
                            </div>
                
                            <!-- Email -->
                            <div class="mb-3">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block w-full mt-1" type="text" name="email" :value="$user->email" autofocus autocomplete="email" />
                                <x-jet-input-error for="email" class="mt-2" />
                            </div>
                            
                            <!-- Role -->
                            <div class="mb-3">
                                <x-jet-label for="roles" value="{{ __('Role') }}" />
                                <select name="roles" id="roles" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                                    <option value="">Please select a role</option>
                                    @foreach ($roles as $id => $roles)
                                        <option 
                                            >{{ $roles->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="roles" class="mt-2" />
                            </div>
                
                            <div class="mb-0">
                                <x-jet-button>
                                    {{ __('Update') }}
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
