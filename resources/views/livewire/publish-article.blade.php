<div>
    <label class="switch">
        <input wire:click="published" type="checkbox" {{ $article->featured ? 'checked' : '' }} ">
        <span class="slider round"></span>
    </label>
</div>
