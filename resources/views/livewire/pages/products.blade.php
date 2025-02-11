<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\Product;
use App\Models\Product_category;

new class extends Component {
    public array $products = [];

    /**
     * Delete the currently authenticated user.
     */
    public function mount(): void
    {
        $this->products = Product::all()->toArray();
    }
}; ?>
<section>
    <div class="ex-basic-1 py-12">
        <div class="container mx-auto px-4 sm:px-8 xl:max-w-5xl xl:px-12">

            @foreach ($products as $index => $prod)
                @if ($index % 2 == 0)
                    <!-- Details 2 -->
                    <div class="py-8">
                        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
                            <div class="lg:col-span-7 transition hover:scale-125">
                                <div class="mb-12 lg:mb-0 xl:mr-14" data-aos="fade-right" data-aos-duration="600"
                                    data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
                                    <img class="inline drone-float" src="uploads/product/{{ $prod['img'] }}"
                                        alt="alternative" />
                                </div>
                            </div> <!-- end of col -->
                            <div class="lg:col-span-5">
                                <div class="xl:mt-12" data-aos="zoom-in" data-aos-once="true" data-aos-delay="300"
                                    data-aos-offset="200" data-aos-duration="400" data-aos-once="true"
                                    data-aos-mirror="true" data-aos-easing="ease-in-out">
                                    <h2 class="mb-6">{{ $prod['name'] }}</h2>
                                    <p class="mb-4">{{ $prod['desc'] }}</p>
                                    <p class="mb-4">ค่าธรรมเนียมการศึกษา {{ number_format($prod['price'], 0, ',', ',') }} {{ __('messages.baht') }}</p>
                                    <a class="btn-solid-reg mr-1.5"
                                        href="/product/detail/{{ $prod['id'] }}">รายละเอียดเพิ่มเติม</a>
                                    {{-- <a class=" mr-1.5" href="">ค่าธรรมเนียมการศึกษา
                                        {{ number_format($prod['price'], 0, ',', ',') }}
                                        {{ __('messages.baht') }}</a> --}}
                                    {{-- <a class="btn-outline-reg" href="article.html">Details</a> --}}
                                </div>
                            </div> <!-- end of col -->
                        </div> <!-- end of container -->
                    </div>
                    <!-- end of details 2 -->
                @else
                    <!-- Details 1 -->
                    <div id="details" class="pt-8 pb-8 lg:pt-8">
                        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
                            <div class="lg:col-span-5">
                                <div class="mb-16 lg:mb-0 xl:mt-16" data-aos="zoom-in" data-aos-once="true"
                                    data-aos-delay="300" data-aos-offset="200" data-aos-duration="400"
                                    data-aos-once="true" data-aos-mirror="true" data-aos-easing="ease-in-out">
                                    <h2 class="mb-6">{{ $prod['name'] }}</h2>
                                    <p class="mb-4">{{ $prod['desc'] }}</p>
                                    <p class="mb-4">ค่าธรรมเนียมการศึกษา {{ number_format($prod['price'], 0, ',', ',') }} {{ __('messages.baht') }}</p>
                                    <a class="btn-solid-reg mr-1.5"
                                        href="/product/detail/{{ $prod['id'] }}">รายละเอียดเพิ่มเติม</a>
                                    {{-- <a class=" mr-1.5" href="">{{ __('messages.begin') }}
                                        {{ number_format($prod['price'], 0, ',', ',') }}
                                        {{ __('messages.baht') }}</a> --}}
                                </div>
                            </div> <!-- end of col -->
                            <div class="lg:col-span-7 transition hover:scale-125">
                                <div class="xl:ml-14" data-aos="fade-left" {{-- data-aos-offset="200" --}} {{-- data-aos-delay="50" --}}
                                    data-aos-duration="600" data-aos-easing="ease-in-out" data-aos-mirror="true"
                                    data-aos-once="true">
                                    <img class="inline drone-float" src="uploads/product/{{ $prod['img'] }}" alt="alternative" />
                                </div>
                            </div> <!-- end of col -->
                        </div> <!-- end of container -->
                    </div>
                    <!-- end of details 1 -->
                @endif
            @endforeach
        </div>
    </div>
</section>
