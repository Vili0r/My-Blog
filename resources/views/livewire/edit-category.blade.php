<div class="p-8">
    <form wire:submit.prevent="update">

        <div class="space-y-6">
            <!-- Name -->
            <div class="mb-3">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block w-full mt-1" type="text" wire:model.defer="category.name" :value="old('name')" autofocus autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <div class="mb-0">
                <x-jet-button>
                    {{ __('Update Category') }}
                </x-jet-button>
            </div>
        </div>
    </form>
</div>
