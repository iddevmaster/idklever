@php
    // Find the position of "<p>"
    $startPos = strpos($blog->desc, "<p>");

    // Find the position of "</p>"
    $endPos = strpos($blog->desc, "</p>");

    $textBetweenTags = '';
    if ($startPos !== false && $endPos !== false) {
        // Extract text between "<p>" and "</p>"
        $textBetweenTags = substr($blog->desc, $startPos + strlen("<p>"), $endPos - $startPos - strlen("<p>"));
    }

    $desc = Illuminate\Support\Str::limit($textBetweenTags, 50, '...');
@endphp

<x-landing-layout>
    @section('title', $blog->title)
    @section('desc' , $desc)
    @section('cover' , asset('uploads/news/'. $blog->cover))

    <!-- Header -->
    <header class="ex-header bg-gray">
        <div class="container px-4 sm:px-8 xl:px-4">
            <h1 class="xl:ml-24">{{ $blog->title }}</h1>
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
                    <li>
                        <a
                        href="/blogs"
                        class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                        >{{ __('messages.news') }}</a
                        >
                    </li>
                    <li>
                        <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
                    </li>
                    <li style="color: #eb427e">
                        {{ $blog->title }}
                    </li>
                </ol>
            </nav>
        </div> <!-- end of container -->
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->

    <livewire:pages.blog_detail :blog_id="$blog_id" />

</x-landing-layout>
