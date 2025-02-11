<?php

use Livewire\Volt\Component;
use App\Models\Product;

new class extends Component
{
    public string $prod_id;
    public array $products;

    /**
     * Delete the currently authenticated user.
     */
     public function mount($prod_id)
    {
        $this->prod_id = $prod_id;
        $this->products = Product::find($prod_id)->toArray();
    }
}; ?>
<section>
    <div class="ex-basic-1 py-12">
        <div class="container mx-auto px-4 sm:px-8 xl:max-w-5xl xl:px-12">
            {!! $products['detail'] !!}
        </div>
    </div>
</section>
