<?php

use Livewire\Volt\Component;
use App\Models\Promotion;

new class extends Component
{
    public string $promo_id;
    public array $promotions = [];
    public string $shareComponent;

    /**
     * Delete the currently authenticated user.
     */
     public function mount($promo_id)
    {
        $this->promo_id = $promo_id;
        $this->promotions = Promotion::find($promo_id)->toArray();

        $this->shareComponent = Share::currentPage()->facebook();
    }
}; ?>
<section>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v18.0";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="ex-basic-1 py-12">
        <div class="container mx-auto px-4 sm:px-8 xl:max-w-5xl xl:px-12">
            {{-- {!! $shareComponent !!} --}}

            @if ($promotions)
                <div class="flex items-center justify-end py-2 " style="gap: 10px">
                    <div class="line-it-button" data-lang="th" data-type="share-a" data-env="REAL" data-url="{{ url()->current() }}" data-color="default" data-size="small" data-count="true" data-ver="3" style="display: none;"></div>

                    <!-- Your share button code -->
                    <div class="fb-share-button"
                        data-href="{{ url()->current() }}"
                        data-layout="button_count">
                    </div>
                    <style>
                        .fb-share-button > span {
                            vertical-align: sub !important;
                        }
                    </style>

                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="true"></a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>

                <div class="flex justify-center ">
                    <img class="inline drone-float" src="/uploads/promotion/{{ $promotions['cover'] }}" alt="alternative" />
                </div>
                {{-- <div class="m-2 flex justify-end">
                    <div class="line-it-button" data-lang="th" data-type="like" data-env="REAL" data-url="{{ url()->current() }}"  style="display: none;"></div>
                </div> --}}
                <div class="my-10 px-4">
                    {!! $promotions['desc'] !!}
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
    </div>
    <script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
</section>
