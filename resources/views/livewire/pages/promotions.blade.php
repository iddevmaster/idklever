<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\Promotion;

new class extends Component
{
    public array $promotions = [];

    /**
     * Delete the currently authenticated user.
     */
     public function mount(): void
    {
        $this->promotions = Promotion::orderBy('id', 'desc')->get()->toArray();
    }
}; ?>

<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        {{-- <div class="text-center">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">From the blog</h1>

            <p class="max-w-lg mx-auto mt-4 text-gray-500">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure veritatis sint autem nesciunt, laudantium
                quia tempore delect
            </p>
        </div> --}}

        @if ($promotions)
            <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2">
                @foreach ($promotions as $promotion)
                    <div>
                        <img class="relative z-10 object-cover w-full rounded-md h-96" src="/uploads/promotion/{{ $promotion['cover'] }}" alt="">

                        <div class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                            <a href="/promotion/detail/{{ $promotion['id'] }}" class="font-semibold text-gray-800 hover:underline dark:text-white md:text-xl">
                                {{ $promotion['title'] }}
                            </a>

                            <div class="flex mt-3 justify-between">
                                <p class="text-blue-500 text-sm">
                                    @php
                                        $dateRange = explode(' - ', $promotion['date']);
                                        $endDate = DateTime::createFromFormat('d/m/Y', $dateRange[1]);
                                        $now = new DateTime();

                                        // Check if the current date is past the end date
                                        if ($now > $endDate) {
                                            echo "<span class=\"text-red-500 text-sm\"><i class='fa fa-clock-o' aria-hidden='true'></i> Expired</span>";
                                        } else {
                                            $interval = $now->diff($endDate);
                                            $daysDifference = $interval->format('%a');
                                            $hoursDifference = $interval->format('%h');;

                                            if ($daysDifference == 0) {
                                                echo "<span ><i class='fa fa-clock-o' aria-hidden='true'></i> $hoursDifference hours</span>";
                                            } else {
                                                echo "<span ><i class='fa fa-clock-o' aria-hidden='true'></i> $daysDifference days</span>";
                                            }
                                        }
                                    @endphp
                                </p>
                                <p class="text-sm text-blue-500">
                                    {{ \Carbon\Carbon::parse($promotion['updated_at'])->locale( config('app.locale', 'th') )->isoFormat('D MMMM YYYY') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex justify-center">
                <span
                    class="inline-block whitespace-nowrap rounded-[0.27rem] bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-xl font-bold leading-none text-primary-700">
                    ไม่พบข้อมูลในขณะนี้
                </span>
            </div>
        @endif
    </div>
</section>
