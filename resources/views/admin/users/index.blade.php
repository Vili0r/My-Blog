<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    @hasanyrole('Super Admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-2/3 mx-auto">
                    <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                        <thead>
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">#</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nr of Articles</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Role</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key=>$user)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $key+1 }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $user->name }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $user->email}}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $user->articles->count() }}</td>
                                    @foreach($user->roles()->pluck('name') as $role)
                                        <td class="py-4 px-6 border-b border-grey-light">{{ $role }}</td>
                                    @endforeach
                                    <td class="py-4 px-6 border-b border-grey-light justify-center">   
                                        <div class="flex gap-2">
                                            <x-jet-secondary-button class="bg-yellow-200 hover:bg-yellow-400">
                                                <a href="{{ route('users.edit', $user) }}"><x-ri-edit-fill class="w-6 h-6"/></a>
                                            </x-jet-secondary-button>
                                            
                                            <form method="POST" action="{{ route('users.destroy', $user) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-jet-secondary-button class="bg-red-400 hover:bg-red-600" type="submit" onclick="return confirm('Are you sure?')">
                                                    <x-eos-delete class="w-6 h-6"/>
                                                </x-jet-secondary-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                There are no users
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