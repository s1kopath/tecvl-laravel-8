@php
$blogs = $homeService->getBlogs($component->type);
@endphp
@if (count($blogs) > 0)
    <section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-12">
        <div class="flex justify-between">
            @if (componentValue($component, 'title'))
                <P class="font-bold text-22 text-gray-12 uppercase mb-5 dm-bold">
                    {{ componentValue($component, 'title') }}</P>
            @endif
            <a class="text-gray-10 font-medium text-base inline-flex items-center mt-1 dm-sans">{{ __('Read Blogs') }}
                <svg class="w-4 h-4 ml-2 mt-0.5" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z"
                        fill="currentColor" />
                </svg>
            </a>
        </div>
        <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10">
            @foreach ($blogs as $blog)
                <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
                    <div class="relative rounded-lg h-48 overflow-hidden">
                        <img alt="content" class="object-cover object-center h-full w-full"
                            src="{{ $blog->fileUrl() }}">
                        <div class="absolute left-4 top-4 h-11 w-11 bg-opacity rounded">
                            <p class="text-center text-xl font-bold dm-bold leading-3 mt-2">
                                {{ date('d', strtotime($blog->created_at)) }}</p>
                            <p class="text-center text-sm font-normal mt-0.5 dm-regular">
                                {{ date('M', strtotime($blog->created_at)) }}</p>
                        </div>
                    </div>
                    <p class="text-13 font-medium title-font text-gray-10 mt-3  dm-sans">{{ optional($blog->user)->name }}</p>
                    <p class="text-xl leading-relaxed font-medium text-gray-12 dm-sans">
                        {{ trimWords($blog->title, 65) }}</p>
                    <a href="{{ route('blog.details', $blog->slug) }}"
                        class="text-gray-10 font-medium text-base inline-flex items-center mt-1 dm-sans">{{ __('Read Now') }}
                        <svg class="w-4 h-4 ml-2 mt-0.5" viewBox="0 0 15 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endif
