<x-landing-layout>

    <!-- Header -->
    <header class="ex-header bg-gray">
        <div class="container px-4 sm:px-8 xl:px-4">
            <h1 class="xl:ml-24">{{ __('messages.news') }}</h1>
            <nav class="bg-grey-light w-full rounded-md xl:ml-24">
                <ol class="list-reset flex">
                    <li>
                        <a href="/home"
                            class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">{{ __('messages.home') }}</a>
                    </li>
                    <li>
                        <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
                    </li>
                    <li style="color: #eb427e">
                        {{ __('messages.news') }}
                    </li>
                </ol>
            </nav>
        </div> <!-- end of container -->
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->


    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <!--Tabs navigation-->
    <div class="container px-4 sm:px-8 xl:px-4">
        <!--Tabs navigation-->
        <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0" role="tablist" data-twe-nav-ref>
            <li role="presentation" class="flex-auto text-center">
                <a href="#tabs-all"
                    class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                    data-twe-toggle="pill" data-twe-target="#tabs-all" data-twe-nav-active role="tab"
                    aria-controls="tabs-all" aria-selected="true">{{ __('messages.all') }}</a>
            </li>
            <li role="presentation" class="flex-auto text-center">
                <a href="#tabs-news"
                    class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                    data-twe-toggle="pill" data-twe-target="#tabs-news" role="tab"
                    aria-controls="tabs-news" aria-selected="false">{{ __('messages.news') }}</a>
            </li>
            <li role="presentation" class="flex-auto text-center">
                <a href="#tabs-blog"
                    class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                    data-twe-toggle="pill" data-twe-target="#tabs-blog" role="tab"
                    aria-controls="tabs-blog" aria-selected="false">{{ __('messages.blogs') }}</a>
            </li>
            <li role="presentation" class="flex-auto text-center">
                <a href="#tabs-gallery"
                    class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                    data-twe-toggle="pill" data-twe-target="#tabs-gallery" role="tab"
                    aria-controls="tabs-blog" aria-selected="false">{{ __('messages.gallery') }}</a>
            </li>
            {{-- <li role="presentation" class="flex-auto text-center">
                <a href="#tabs-gallery"
                    class="pointer-events-none my-2 block border-x-0 border-b-2 border-t-0 border-transparent bg-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-400 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent dark:text-neutral-600"
                    data-twe-toggle="pill" data-twe-target="#tabs-gallery" role="tab"
                    aria-controls="tabs-gallery" aria-selected="false">{{ __('messages.gallery') }}</a>
            </li> --}}
        </ul>

        <!--Tabs content-->
        <div class="mb-6">
            <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                id="tabs-all" role="tabpanel" aria-labelledby="tabs-home-tab01" data-twe-tab-active>
                <livewire:pages.all />
            </div>
            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                id="tabs-news" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                <livewire:pages.news />
            </div>
            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                id="tabs-blog" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                <livewire:pages.blogs />
            </div>
            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                id="tabs-gallery" role="tabpanel" aria-labelledby="tabs-contact-tab01">
                <livewire:pages.portfolio />
            </div>
        </div>
    </div> <!-- end of container -->
    {{-- <livewire:pages.blogs /> --}}

</x-landing-layout>
