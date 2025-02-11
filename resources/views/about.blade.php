<x-landing-layout>

    <!-- Header -->
    <header class="ex-header bg-gray">
        <div class="container px-4 sm:px-8 xl:px-4">
            <h1 class="xl:ml-24">{{ __('messages.about') }}</h1>
            <nav class="bg-grey-light w-full rounded-md xl:ml-24">
                <ol class="list-reset flex">
                    <li>
                        <a
                        href="/home"
                        class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                        >{{ __('messages.home') }}</a
                        >
                    </li>
                    <li>
                        <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
                    </li>
                    <li style="color: #eb427e">
                        {{ __('messages.about') }}
                    </li>
                </ol>
            </nav>
        </div> <!-- end of container -->
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->

    <livewire:pages.aboutme />

</x-landing-layout>
