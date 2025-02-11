<x-landing-layout>
    <div class="pb-14 text-center">
        {{-- <div class="h-screen px-0 mx-0">
            <img src="/img/banners/banner-0.jpg" class="w-full object-contain" alt="">
        </div> --}}
        <div id="carouselExampleControls" class="relative" data-twe-carousel-init data-twe-ride="carousel">
            <!--Carousel items-->
            <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
                @php
                    // got all banner img from public/img/banners for carosel
                    $banners = Storage::files('/img/banners');
                    $bannersCollection = collect($banners);
                @endphp
                <!--First item-->
                @if (count($banners ?? []) > 0)
                    <div class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                        data-twe-carousel-item data-twe-carousel-active>
                        <img src="{{ $banners[0] }}" class="block w-full" alt="Wild Landscape" />
                    </div>
                    @foreach ($bannersCollection->skip(1) as $banner)
                        <div class="relative float-left hidden -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                            data-twe-carousel-item>
                            <img src="{{ $banner }}" class="block w-full" alt="Wild Landscape" />
                        </div>
                    @endforeach
                @else
                    <div class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                        data-twe-carousel-item data-twe-carousel-active>
                        <img src="/img/intBanner.jpg" class="block w-full" alt="Wild Landscape" />
                    </div>
                @endif
            </div>

            <!--Carousel controls - prev item-->
            <button
                class="absolute bottom-0 left-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-black opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-black hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
                type="button" data-twe-target="#carouselExampleControls" data-twe-slide="prev">
                <span class="inline-block h-8 w-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-10 w-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </span>
                <span
                    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Previous</span>
            </button>
            <!--Carousel controls - next item-->
            <button
                class="absolute bottom-0 right-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-black opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-black hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
                type="button" data-twe-target="#carouselExampleControls" data-twe-slide="next">
                <span class="inline-block h-8 w-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-10 w-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
                <span
                    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Next</span>
            </button>
        </div>
    </div>

    <!-- Introduction -->
    <div class="pt-4 pb-14 text-center">
        <div class="container px-4 sm:px-8 xl:px-4">
            <p class="mb-4 font-bold text-black text-3xl leading-10 lg:max-w-5xl lg:mx-auto"
                style="color: var(--second-color)">
                "มุ่งเป็นศูนย์ฝึกอบรมชั้นนำของอาเซียนสู่สากล"
            </p>
            <p class="mb-4 text-gray-800 text-xl leading-10 lg:max-w-4xl lg:mx-auto">
                เน้นพัฒนาทรัพยากรมนุษย์ด้วยระบบที่เป็นมาตรฐาน เสริมสร้างทักษะอาชีพด้วยหลักสูตรที่ตอบสนองความต้องการและความจำเป็นของตลาดแรงงานไทยและต่างประเทศ เพื่อรองรับการเป็น ศูนย์กลางการแพทย์ครบวงจร (Medical Hub)
            </p>
        </div> <!-- end of container -->
    </div>
    <!-- end of introduction -->


    <!-- Features -->
    <div id="features" class="cards-1">
        <p class="text-4xl mb-12 font-bold text-black">หลักสูตรที่เปิดสอน</p>
        <div class="container px-4 sm:px-8 xl:px-4">

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/child_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">การดูแลเด็กเล็ก</h5>
                    {{-- <p class="mb-4">ตัวแทนจำหน่ายโดรนอย่างเป็นทางการ คุณภาพระดับโลก</p> --}}
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/old_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">การดูแลผู้สูงอายุ</h5>
                    {{-- <p class="mb-4">หลักสูตรอบรมคุณภาพ จากผู้เชี่ยวชาญ ประสบการณ์ตรง</p> --}}
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/japan_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">ภาษาญี่ปุ่น</h5>
                    {{-- <p class="mb-4">ถูกต้องตามกฎหมาย สะดวก รวดเร็ว ปลอดภัย ไปกับเรา</p> --}}
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/english_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">ภาษาอังกฤษ</h5>
                    {{-- <p class="mb-4">อะไหล่แท้ มาตรฐานสากล รับประกันผลงาน มั่นใจได้</p> --}}
                </div>
            </div>

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/china_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">ภาษาจีน</h5>
                    {{-- <p class="mb-4">อะไหล่แท้ มาตรฐานสากล รับประกันผลงาน มั่นใจได้</p> --}}
                </div>
            </div>

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/videomkt_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">การจัดการวิดีโอสำหรับการตลาดดิจิทัล</h5>
                    {{-- <p class="mb-4">ทำประกันภัยโดรนกับเรา มั่นใจในความปลอดภัย บินได้อย่างไร้ขีดจำกัด</p> --}}
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/managemkt_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">การวางแผนและบริหารจัดการการตลาดดิจิทัล</h5>
                    {{-- <p class="mb-4">ตอบโจทย์ทุกความต้องการ รวดเร็ว ปลอดภัย ด้วยเทคโนโลยีล้ำสมัย</p> --}}
                </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
                <div class="card-image">
                    <img src="img/icons/socialmedia_icon.png" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">การใช้สื่อสังคมออนไลน์เพื่อทำการตลาดดิจิทัล</h5>
                    {{-- <p class="mb-4">อะไหล่แท้ มาตรฐานสากล รับประกันผลงาน มั่นใจได้</p> --}}
                </div>
            </div>
            <!-- end of card -->

        </div> <!-- end of container -->
        <a href="/courses"
            class="inline-block rounded-full bg-[#e6f8ff] hover:bg-info px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-gray-700 hover:text-white shadow-info-1 transition duration-150 ease-in-out hover:shadow-info-2 focus:bg-info-accent-300 focus:shadow-info-2 focus:outline-none focus:ring-0 active:bg-info-600 active:shadow-info-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
             รายละเอียดหลักสูตรทั้งหมด
        </a>
    </div> <!-- end of cards-1 -->
    <!-- end of features -->


    <!-- Video -->
    <div class="slider-1 py-32 bg-gray" id="blogsandnews">
        <div class="container px-4 sm:px-8">
            <h2 class="text-center lg:max-w-xl lg:mx-auto">บทความและข่าวสาร</h2>
            {{-- <p class="mb-10 text-center lg:max-w-xl lg:mx-auto">จุดประกายความเป็นมืออาชีพ
                พัฒนาทักษะการบินโดรนและนำไปใช้ในอาชีพที่หลากหลาย</p> --}}

            <div class="container px-6 py-4 mx-auto">
                <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-3">
                    @php
                        $blogs = App\Models\Blog::orderBy('id', 'desc')->limit(6)->get();
                    @endphp
                    @if (count($blogs ?? []) > 0)
                        @foreach ($blogs as $blog)
                            <div>
                                <img class="relative z-10 object-cover w-full rounded-md h-72" src="/uploads/news/{{ $blog->cover }}"
                                    alt="">

                                <div
                                    class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                                    <a href="/blog/detail/{{ $blog->id }}"
                                        class="font-semibold text-gray-800 hover:underline dark:text-white md:text-lg">
                                        {{ $blog->title }}
                                    </a>
                                    <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                                        @php
                                            // got first <p></p> in desc and cut <p> tag got only content
                                            $startPos = strpos($blog->desc, '<p>');
                                            $endPos = strpos($blog->desc, '</p>');
                                            $textBetweenTags = '';
                                            if ($startPos !== false && $endPos !== false) {
                                                $textBetweenTags = substr($blog->desc, $startPos + strlen('<p>'), $endPos - $startPos - strlen('<p>'));
                                            }
                                            echo Illuminate\Support\Str::limit($textBetweenTags, 130, '...');
                                        @endphp
                                    </p>

                                    <div class="flex mt-3 justify-between">
                                        <p class="text-blue-500 text-sm">{{ $blog->type ? 'Blog' : 'News' }}</p>
                                        <p class="text-sm text-blue-500">
                                            {{ \Carbon\Carbon::parse($blog->updated_at)->locale(app()->getLocale())->isoFormat('D MMMM YYYY') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex justify-center col-span-full">
                            <span
                                class="inline-block whitespace-nowrap rounded-[0.27rem] bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-xl font-bold leading-none text-primary-700">
                                ไม่พบข้อมูลในขณะนี้
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            @if (count($blogs ?? []) > 0)
                <div class="flex justify-center">
                    <button type="button"
                        class="inline-block rounded-full bg-[#f1f9fc] hover:bg-info px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-gray-700 hover:text-white shadow-info-1 transition duration-150 ease-in-out hover:shadow-info-2 focus:bg-info-accent-300 focus:shadow-info-2 focus:outline-none focus:ring-0 active:bg-info-600 active:shadow-info-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                        ดูเพิ่มเติม
                    </button>
                </div>
            @endif
        </div> <!-- end of container -->
    </div> <!-- end of slider-1 -->
    <!-- end of Video -->


    <!-- Pricing -->
    <div id="pricing" class="cards-2">
        <div class="container px-4 pb-px sm:px-8">
            <h2 class="mb-2.5 text-white lg:max-w-xl lg:mx-auto">วิสัยทัศน์</h2>
            <p class="mb-16 text-white lg:max-w-3xl lg:mx-auto">
                มุ่งเป็นศูนย์ฝึกอบรมชั้นนำของอาเซียนสู่สากล เน้นพัฒนาทรัพยากรมนุษย์ด้วยระบบที่เป็นมาตรฐาน เสริมสร้างทักษะอาชีพด้วยหลักสูตรที่ตอบสนองความต้องการและความจำเป็นของตลาดแรงงานไทยและต่างประเทศ
            </p>



        </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of pricing -->


    <!-- Conclusion -->
    <div id="download" class="basic-5">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2">
            <div class="mb-16 lg:mb-0">
                <img src="img/footer.jpg" alt="alternative" />
            </div>
            <div class="lg:mt-24 xl:mt-44 xl:ml-12">
                <p class="mb-9 text-gray-800 text-2xl leading-10">
                    เพิ่มโอกาสทางการศึกษา
                    <br>
                    <span class="text-4xl font-bold">
                        <span style="color: var(--second-color)">พัฒนาคุณภาพชีวิต</span>
                    </span>
                    <br>
                    ด้วยองค์ความรู้ สู่การเสริมทักษะในหลักสูตรระยะสั้น
                </p>
                {{-- <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>Download</a>
                <a class="btn-solid-lg secondary" href="#your-link"><i class="fab fa-google-play"></i>Download</a> --}}
            </div>
        </div> <!-- end of container -->
    </div> <!-- end of basic-5 -->
    <!-- end of conclusion -->
    <script>
        const words = ["Drone Technology Training Center", "Welcome to DroneTTC", "We are DroneTTC."];
        let i = 0;
        let j = 0;
        let currentWord = "";
        let isDeleting = false;

        function type() {
            currentWord = words[i];

            if (isDeleting) {
                document.getElementById("typewriter").textContent = currentWord.substring(0, j - 1);
                j--;
                if (j == 0) {
                    isDeleting = false;
                    i++;
                    if (i == words.length) {
                        i = 0;
                    }
                }
                setTimeout(type, 50); // Standard speed when deleting
            } else {
                document.getElementById("typewriter").textContent = currentWord.substring(0, j + 1);
                j++;
                if (j == currentWord.length) {
                    isDeleting = true;
                    setTimeout(type, 5000); // Delay before deleting
                } else {
                    setTimeout(type, 50); // Standard speed when typing
                }
            }
        }

        type(); // Start the typewriter effect
    </script>
    <style>
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        #header {
            width: 100%;
            height: 100vh;
            position: relative;
            display: flex;
            justify-content: center;
            margin-bottom: 10%;
        }

        .video-background video {
            object-fit: cover;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            z-index: 1;
            filter: brightness(0.8);
        }

        .header-content {
            z-index: 2;
        }

        /* Add this to your CSS file */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .drone-float {
            animation: float 3s ease-in-out infinite;
        }

        .slideInRight {
            -webkit-animation-name: slideInRight;
            animation-name: slideInRight;
            -webkit-animation-duration: 1s;
            animation-duration: 2s;
            animation-delay: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes slideInRight {
            0% {
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
                visibility: hidden;
            }

            100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                visibility: visible;
            }
        }

        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            animation-delay: 2s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .fadeIn2 {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            animation-delay: 2.5s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</x-landing-layout>
