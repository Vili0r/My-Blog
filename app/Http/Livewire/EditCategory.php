<?php

namespace App\Http\Livewire;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class EditCategory extends ModalComponent
{
    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function update()
    {
        $this->validate();

        $this->category->save();

        $this->closeModal();

        session()->flash('message', 'Category successfully updated.');

        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.edit-category');
    }

    protected function rules(): array
    {
        return [
            'category.name' => ['required', 'string', 'unique:categories,name', 'min:3', 'max:30']
        ];
    }
}
