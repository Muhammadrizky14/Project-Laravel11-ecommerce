<?php
// app/Http/Livewire/CreateProduct.php
namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public $name = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $image;
    public $createAnother = false;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'required|image|max:2048'
    ];

    public function save($createAnother = false)
    {
        $this->validate();

        $imagePath = $this->image->store('products', 'public');

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $imagePath
        ]);

        if ($createAnother) {
            $this->reset(['name', 'description', 'price', 'stock', 'image']);
            session()->flash('message', 'Product created successfully. Create another one!');
        } else {
            return redirect()->route('products.index')->with('message', 'Product created successfully!');
        }
    }

    public function cancel()
    {
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}