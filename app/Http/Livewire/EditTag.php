<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class EditTag extends ModalComponent
{
    public Tag $tag;

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function update()
    {
        $this->validate();

        $this->tag->save();

        $this->closeModal();

        session()->flash('message', 'Tag successfully updated.');

        return redirect()->route('tags.index');
    }
    public function render()
    {
        return view('livewire.edit-tag');
    }

    protected function rules(): array
    {
        return [
            'tag.name' => ['required', 'string', 'unique:tags,name', 'min:3', 'max:15']
        ];
    }
}
