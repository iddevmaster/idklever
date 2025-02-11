<?php

use Livewire\Volt\Component;
use App\Models\Activity;

new class extends Component
{
    public array $activities = [];

    /**
     * Delete the currently authenticated user.
     */
     public function mount()
    {
        $this->activities = Activity::all()->toArray();
    }
}; ?>

<section>
    <div class="ex-basic-1 py-12">
        @if ($activities)
            @foreach ($activities as $activity)
                <div class="container mx-auto px-4 sm:px-8 xl:max-w-5xl xl:px-12 mb-10">
                    <div class="mb-5">
                        <h2>{{ $activity['title'] }}</h2>
                        <p>{{ $activity['desc'] }}</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 ">
                        @foreach ($activity['media'] as $key => $media)
                            @if ($key !== 'by')
                                <div class="overflow-hidden imgnine"><div class="imgcon" style="background-image: url('/uploads/activity/{{ $media }}')"></div></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex justify-center">
                <span
                    class="inline-block whitespace-nowrap rounded-[0.27rem] bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-xl font-bold leading-none text-primary-700">
                    ไม่พบข้อมูลในขณะนี้
                </span>
            </div>
        @endif
    </div>
    <script>

    </script>
    <style>
        .imgnine {
            border-radius: 10px;
        }
        .imgcon {
            width: 400px;
            height: 300px;
            background-size: cover; /* You can use contain, 100% 100%, or leave it out */
            background-position: center;
            transition: .5s;
        }
        .imgnine:hover > .imgcon {
            transform: scale(1.2)
        }
    </style>
</section>
