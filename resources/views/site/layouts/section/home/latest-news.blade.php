@if (count($blogs) > 0)
    <section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-30p md:mt-12">
        <div class="flex justify-center md:justify-between md:items-center">
            <P class="dm-bold text-sm text-center md:text-left md:text-22 text-gray-12 uppercase">
                {{ __('Latest News') }}</P>
            <a href="{{ route('blog.all') }}"
                class="process-goto relative justify-center text-gray-10 font-medium text-base dm-sans hidden md:inline-flex items-center py-2 dm-sans">
                <span class="-ml-5">{{ __('Read Blogs') }}</span>
                <svg class="ml-2 relative" width="15" height="10" viewBox="0 0 15 10" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z"
                        fill="#898989" />
                </svg>
            </a>
        </div>
        <div class="flex space-x-5 md:space-x-0 md:flex-wrap md:-mx-4 -mb-10 overflow-auto md:mt-15p mt-2">
            @foreach ($blogs as $blog)
                <div class="md:p-4 w-4/5 md:w-1/3 sm:mb-0 mb-6">
                    <div class="relative rounded-lg w-260p md:w-auto h-48 overflow-hidden">
                        <img alt="content" class="object-cover object-center h-full w-full"
                            src="{{ $blog->fileUrl() }}">
                        <div
                            class="absolute left-2.5 top-2.5 h-10 w-10 bg-opacity rounded md:left-4 md:top-4 md:h-11 md:w-11">
                            <p class="text-center text-15 md:text-xl font-bold dm-bold leading-3 mt-2 md:mt-0">
                                {{ date('d', strtotime($blog->created_at)) }}</p>
                            <p class="text-center text-xs md:text-sm font-normal mt-0.5 md:-mt-1.5 dm-regular">
                                {{ date('M', strtotime($blog->created_at)) }}</p>
                        </div>
                        <p class="text-xss md:text-13 font-medium break-all title-font text-gray-10 mt-3  dm-sans">
                            {{ $blog->user->name }}</p>
                        <p class="text-base md:text-xl md:leading-relaxed break-all font-medium text-gray-12 dm-sans">
                            {{ trimWords($blog->title, 65) }}</p>
                        <a href="{{ route('blog.details', $blog->slug) }}"
                            class="text-gray-10 font-medium text-sm md:text-base inline-flex items-center mt-1 dm-sans">{{ __('Read Now') }}
                            <svg class="w-3 md:w-4 h-4 ml-2 mt-0.5" viewBox="0 0 15 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z"
                                    fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-xss md:text-13 font-medium break-all title-font text-gray-10 mt-3  dm-sans">
                        {{ $blog->user->name }}</p>
                    <p class="text-base md:text-xl md:leading-relaxed break-all font-medium text-gray-12 dm-sans">
                        {{ trimWords($blog->title, 65) }}</p>
                    <a href="{{ route('blog.details', $blog->slug) }}"
                        class="process-goto relative justify-center text-gray-10 font-medium text-sm md:text-base dm-sans hidden md:inline-flex items-center py-2 dm-sans">
                        <span>{{ __('Read Now') }}</span>
                        <svg class="w-3 md:w-4 h-4 mt-0.5 ml-2 relative" width="15" height="10" viewBox="0 0 15 10"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z"
                                fill="#898989" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endif
