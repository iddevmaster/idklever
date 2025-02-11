<!-- Navigation -->
<nav class="navbar top-0 w-full" id="navbarContainer">
    <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">

        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="text-gray-800 font-semibold text-3xl leading-4 no-underline page-scroll" href="index.html">Pavo</a> -->

        <!-- Image Logo -->
        <a class="flex gap-2 mr-4 py-0.5 text-xl whitespace-nowrap hover:no-underline focus:no-underline" href="/">
            <img src="/img/logoschool.jpg" alt="alternative" class="h-8 sm:h-10  md:h-12 lg:h-14" />
            <div class="self-center">
                <p class="font-bold">โรงเรียนไอดีสอนทักษะอาชีพ</p>
                <p class="font-bold text-sm">ID Vocational Skill School</p>
            </div>
        </a>

        <button class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center" id="navbarsExampleDefault">
            <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col text-lg list-none lg:mt-0 lg:mb-0 lg:flex-row">
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" href="/home" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('messages.home') }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item page-scroll" href="#header">{{ __('messages.home') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item page-scroll" href="#features">{{ __('messages.course_open') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item page-scroll" href="#blogsandnews">{{ __('messages.blog_news') }}</a>
                    </div>
                </li>
                <li>
                    <a class="nav-link page-scroll" href="/aboutme">{{ __('messages.about') }}</a>
                </li>
                <li>
                    <a class="nav-link page-scroll" href="/courses">{{ __('messages.course') }}</a>
                </li>
                </li>
                <li>
                    <a class="nav-link page-scroll" href="/blogs">{{ __('messages.news') }}</a>
                </li>
                <li>
                    <a class="nav-link page-scroll" href="/contacts">{{ __('messages.contact') }}</a>
                </li>
                <li class="dropdown">
                    <div class="py-1 mx-2 cursor-pointer" id="changelang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ app()->getLocale() == 'th' ? '/img/thai.png' : '/img/english.png' }}" class="h-7" alt="">
                    </div>
                    <div class="dropdown-menu" aria-labelledby="changelang">
                        <a class="dropdown-item cursor-pointer" href="{{ route('switch-language', ['locale' => 'th']) }}">
                            <div class="flex gap-2">
                                <img src="/img/thai.png" class="h-6" alt="">
                                <p>{{ __('messages.thai') }}</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item cursor-pointer" href="{{ route('switch-language', ['locale' => 'en']) }}">
                            <div class="flex gap-2">
                                <img src="/img/english.png" class="h-6" alt="">
                                <p>{{ __('messages.eng') }}</p>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div> <!-- end of navbar-collapse -->
    </div> <!-- end of container -->
</nav> <!-- end of navbar -->
<!-- end of navigation -->
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbarContainer');
        const scrollY = window.scrollY;

        if (scrollY > 500) {
            navbar.classList.add('fixed-top');
        } else {
            navbar.classList.remove('fixed-top');
        }
    });
</script>
