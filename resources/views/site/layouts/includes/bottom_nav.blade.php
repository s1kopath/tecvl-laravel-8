<section>
    <div class="md:border-b w-full mt-16 absolute">
    </div>
    <header class="header bg-gray-12 md:bg-white">
        <div class="flex lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92">
            <!--  onent -->
            <div class="group group-category dm-sans w-63 h-16 hidden md:block">
                <div class="relative bg-gray-11 text-gray-600
                        md:flex items-center border-r border-l h-16 px-5 hidden md:block">
                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.25C0 0.559644 0.559644 0 1.25 0H18.75C19.4404 0 20 0.559644 20 1.25C20 1.94036 19.4404 2.5 18.75 2.5H1.25C0.559644 2.5 0 1.94036 0 1.25Z" fill="#2C2C2C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 7.5C0 6.80964 0.559644 6.25 1.25 6.25H18.75C19.4404 6.25 20 6.80964 20 7.5C20 8.19036 19.4404 8.75 18.75 8.75H1.25C0.559644 8.75 0 8.19036 0 7.5Z" fill="#2C2C2C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 13.75C0 13.0596 0.559644 12.5 1.25 12.5H18.75C19.4404 12.5 20 13.0596 20 13.75C20 14.4404 19.4404 15 18.75 15H1.25C0.559644 15 0 14.4404 0 13.75Z" fill="#2C2C2C"/>
                    </svg>

                    <span class="ml-3 text-base text-gray-12">{{ __('Categories') }}</span>
                    <span class="mr-4 absolute right-0">
                        <svg class="fill-current h-4 w-4
                            " xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </span>
                </div>
                <?php
                $categories = App\Models\Category::parents();
                ?>
                <div class="bg-white border {{ isset($slides) && $slides->count() ? 'transform scale-1' : 'transform scale-0 group-hover:scale-100'  }} relative
                        z-30 h-100 w-63 hidden md:block">
                    @foreach($categories as $category)
                    <li class="border-b text-left text-gray-10 category-hover">
                        <button class="w-full text-left flex items-center outline-none focus:outline-none">
                            <div class="w-64 h-12 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left p-1 py-2 relative">
                                <a class="flex title-font font-medium items-center md:justify-start justify-center text-sm ml-4 m-1">

                                    <div class="h-4 w-5">
                                        <img class="h-full" src="{{ $category->fileUrl() }}" alt="">
                                    </div>
                                    <span class="rtl-direction-space ml-3 text-sm cursor-pointer text-one">
                                        {{ $category->name }}
                                    </span>
                                    @if(count($category->childrenCategories))
                                        <span
                                            class="rtl-direction absolute top-0 -right-1 ml-3 text-center text-sm h-6 w-6 p-0.5 mt-3">
                                            <svg class="fill-current h-4 w-4
                                                " xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </span>
                                    @endif
                                </a>
                            </div>
                        </button>
                        <ul class="bg-white border border-l-0 absolute top-0 right-0
                            ul-mr min-h-full w-63">
                            @foreach($category->childrenCategories as $childCategory)
                                @include('../site/layouts.includes.child_category', ['child_category' => $childCategory])
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                    <li class="border-b text-left text-gray-10 see-all">
                        <button class="w-full text-left flex items-center outline-none focus:outline-none">
                            <div class="w-64 h-12 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left p-1 py-2 relative">
                                <a class="flex title-font font-medium items-center md:justify-start justify-center text-sm ml-2 m-1">
                                    <span class="rtl-direction-space ml-2.5 text-sm cursor-pointer text-one uppercase">
                                        See All Categories
                                    </span>
                                    <svg class="mt-0.5 ml-2 category-svg gray-10" width="12" height="8" viewBox="0 0 12 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 4L10.7071 3.29289L11.4142 4L10.7071 4.70711L10 4ZM1 5C0.447715 5 0 4.55228 0 4C0 3.44772 0.447715 3 1 3V5ZM7.70711 0.292893L10.7071 3.29289L9.29289 4.70711L6.29289 1.70711L7.70711 0.292893ZM10.7071 4.70711L7.70711 7.70711L6.29289 6.29289L9.29289 3.29289L10.7071 4.70711ZM10 5H1V3H10V5Z" fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
                        </button>
                    </li>
                </div>
            </div>

            @php
                $menus = Modules\MenuBuilder\Http\Models\MenuItems::menus(4);
            @endphp

            <div class="w-full overflow-x-hidden">
                <div class="flex mx-4 md:mx-0">
                    <div class="w-full md:w-5/6 lg:w-3/4 md:mt-4">
                        @php
                            $menus = Modules\MenuBuilder\Http\Models\MenuItems::menus(4);
                        @endphp
                        <ul class="custom-border pt-0.5 text-white md:text-black flex space-x-9 mx-1 md:mx-8 pb-4">
                            @foreach ($menus as $menu)
                            <li>
                                <a class="custom-bottom-border dm-sans text-sm {{ !empty($menu->class) ? $menu->class : '' }}" href="{{ route('site.page', $menu->link) }}">
                                    {{ ucwords($menu->label) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="w-1/4 hidden lg:block">
                        <div class="flex justify-end">
                            <div class="mt-3">
                            <details x-data x-ref="dropdown" @click.away="$refs.dropdown.removeAttribute('open');" class="relative inline-block text-left">
                                <summary>
                                <div class="inline-flex justify-center w-full py-2 bg-white text-sm font-medium text-gray-700 cursor-pointer">
                                    <svg class="mr-2" width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="path-1-outside-1_513_1062" maskUnits="userSpaceOnUse" x="2" y="0" width="10" height="6" fill="black">
                                        <rect fill="white" x="2" width="10" height="6"/>
                                        <path d="M8.33333 3H5.66667C5.51167 3 5.43417 3 5.37059 2.98296C5.19804 2.93673 5.06327 2.80196 5.01704 2.62941C5 2.56583 5 2.48833 5 2.33333C5 2.25584 5 2.21709 5.00852 2.1853C5.03164 2.09902 5.09902 2.03164 5.1853 2.00852C5.21709 2 5.25584 2 5.33333 2H8.66667C8.74416 2 8.78291 2 8.8147 2.00852C8.90098 2.03164 8.96836 2.09902 8.99148 2.1853C9 2.21709 9 2.25584 9 2.33333C9 2.48833 9 2.56583 8.98296 2.62941C8.93673 2.80196 8.80196 2.93673 8.62941 2.98296C8.56583 3 8.48833 3 8.33333 3Z"/>
                                        </mask>
                                        <path d="M5.01704 2.62941L3.08519 3.14705L3.08519 3.14705L5.01704 2.62941ZM5.37059 2.98296L4.85295 4.91481H4.85295L5.37059 2.98296ZM8.98296 2.62941L7.05111 2.11177L7.05111 2.11177L8.98296 2.62941ZM8.62941 2.98296L9.14705 4.91481L9.14705 4.91481L8.62941 2.98296ZM8.99148 2.1853L10.9233 1.66766L10.9233 1.66766L8.99148 2.1853ZM8.8147 2.00852L8.29706 3.94037L8.29707 3.94037L8.8147 2.00852ZM5.00852 2.1853L6.94037 2.70293L5.00852 2.1853ZM5.1853 2.00852L5.70293 3.94037L5.1853 2.00852ZM5.66667 5H8.33333V1H5.66667V5ZM8.66667 0H5.33333V4H8.66667V0ZM3 2.33333C3 2.35957 2.98282 2.76502 3.08519 3.14705L6.94889 2.11177C6.99348 2.2782 6.99913 2.40436 7.00005 2.42453C7.00059 2.43631 7.00036 2.43764 7.00019 2.41833C7.00002 2.39894 7 2.37464 7 2.33333H3ZM5.66667 1C5.62536 1 5.60106 0.999984 5.58167 0.999812C5.56236 0.999641 5.56369 0.99941 5.57547 0.999947C5.59564 1.00087 5.7218 1.00652 5.88823 1.05111L4.85295 4.91481C5.23498 5.01718 5.64043 5 5.66667 5V1ZM3.08519 3.14705C3.31635 4.00978 3.99022 4.68365 4.85295 4.91481L5.88823 1.05111C6.40587 1.18981 6.81019 1.59413 6.94889 2.11177L3.08519 3.14705ZM7 2.33333C7 2.37464 6.99998 2.39894 6.99981 2.41833C6.99964 2.43764 6.99941 2.43631 6.99995 2.42453C7.00087 2.40436 7.00652 2.2782 7.05111 2.11177L10.9148 3.14705C11.0172 2.76502 11 2.35957 11 2.33333H7ZM8.33333 5C8.35957 5 8.76502 5.01718 9.14705 4.91481L8.11177 1.05111C8.2782 1.00652 8.40436 1.00087 8.42453 0.999947C8.43631 0.99941 8.43764 0.999641 8.41833 0.999812C8.39894 0.999984 8.37464 1 8.33333 1V5ZM7.05111 2.11177C7.18981 1.59413 7.59413 1.18981 8.11177 1.05111L9.14705 4.91481C10.0098 4.68365 10.6836 4.00978 10.9148 3.14705L7.05111 2.11177ZM11 2.33333C11 2.31271 11.0005 2.23053 10.9969 2.15106C10.9927 2.06084 10.9807 1.88178 10.9233 1.66766L7.05963 2.70293C7.01077 2.5206 7.003 2.37681 7.00101 2.33329C6.99994 2.30984 6.99991 2.29541 6.99995 2.29969C6.99998 2.30405 7 2.3114 7 2.33333H11ZM8.66667 4C8.6886 4 8.69595 4.00002 8.70031 4.00005C8.70459 4.00009 8.69016 4.00006 8.66671 3.99899C8.62318 3.997 8.47939 3.98923 8.29706 3.94037L9.33235 0.0766677C9.11822 0.0192933 8.93916 0.00725603 8.84894 0.0031414C8.76947 -0.000483036 8.68729 0 8.66667 0V4ZM10.9233 1.66766C10.7153 0.8912 10.1088 0.284717 9.33234 0.0766666L8.29707 3.94037C7.69316 3.77855 7.22145 3.30684 7.05963 2.70293L10.9233 1.66766ZM7 2.33333C7 2.3114 7.00002 2.30405 7.00005 2.29969C7.00009 2.29541 7.00006 2.30984 6.99899 2.33329C6.997 2.37682 6.98923 2.5206 6.94037 2.70293L3.07667 1.66766C3.01929 1.88178 3.00726 2.06084 3.00314 2.15106C2.99952 2.23053 3 2.31271 3 2.33333H7ZM5.33333 0C5.31271 0 5.23053 -0.000483036 5.15106 0.0031414C5.06084 0.00725603 4.88178 0.0192934 4.66766 0.076667L5.70293 3.94037C5.5206 3.98923 5.37682 3.997 5.33329 3.99899C5.30984 4.00006 5.29541 4.00009 5.29969 4.00005C5.30405 4.00002 5.3114 4 5.33333 4V0ZM6.94037 2.70293C6.77855 3.30684 6.30684 3.77855 5.70293 3.94037L4.66766 0.076667C3.8912 0.284718 3.28472 0.8912 3.07667 1.66766L6.94037 2.70293Z" fill="#2C2C2C" mask="url(#path-1-outside-1_513_1062)"/>
                                        <rect x="1" y="1" width="12" height="18" rx="2" stroke="#2C2C2C" stroke-width="2"/>
                                        <circle cx="7" cy="16" r="1" fill="#2C2C2C"/>
                                    </svg>

                                    <p class="text-sm 2xl:text-base dm-sans -mt-0.5">{{ __('Download Our App') }}</p>
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                </summary>

                                <details-menu role="menu" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-30">

                                <div class="py-1" role="none">
                                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Android app</a>
                                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">iOS app</a>
                                </div>
                                </details-menu>
                            </details>

                            </div>
                        </div>
                    </div>
                </div>
                @if (isset($slides) && $slides->count())
                <div class="md:mt-2.5 md:px-1">
                    <div class="slideshow-container ml-0 md:mt-7 md:mx-4 lg:mr-0 lg:ml-4">
                        @php
                            $buttonDirection = ['left' => 'mr-auto', 'right' => 'ml-auto', 'center' => 'mx-auto'];
                        @endphp
                        @foreach ($slides as $slide)
                            <div class="mySlides fade-in">
                                <div class="costume-title">
                                    <p class="text-x-title dm-sans animated {{ $slide->title_animation }} small-title text-{{ $slide->title_direction }}" style="animation-delay: {{ $slide->title_delay }}s; color: {{ $slide->title_font_color }}; font-size: {{ $slide->title_font_size . 'px' }}" >{{ $slide->title_text }}</p>
                                    <p class="text-y-title dm-bold animated {{ $slide->sub_title_animation }} bold-title text-{{ $slide->sub_title_direction }}" style="animation-delay: {{ $slide->sub_title_delay }}s; color: {{ $slide->sub_title_font_color }}; font-size: {{ $slide->sub_title_font_size . 'px' }}">{{ $slide->sub_title_text }}</p>
                                    <p class="text-z-title dm-bold animated {{ $slide->description_title_animation }} bottom-title text-{{ $slide->description_title_direction }}" style="animation-delay: {{ $slide->description_title_delay }}s; color: {{ $slide->description_title_font_color }}; font-size: {{ $slide->description_title_font_size . 'px' }}">{{ $slide->description_title_text }}</p>
                                    <a href="{{ $slide->button_link }}" {{ $slide->is_open_in_new_window == 'Yes' ? "target=_blank" : '' }}>
                                        <p class="shop-btn dm-bold {{ $buttonDirection[strtolower($slide->button_position)] }}" style="border: 1px solid {{ $slide->sub_title_font_color }}; color: {{ $slide->sub_title_font_color }}; --hover-bg-color:#2c2c2c; --hover-color:#FFFFFF">{{ $slide->button_title }}
                                            <svg class="shop-direction w-9p md:h-2 md:w-13p" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.87915 0L7.70313 1.20177L9.60983 3.15022H1.63861C1.17935 3.15022 0.80704 3.53068 0.80704 4C0.80704 4.46932 1.17935 4.84978 1.63861 4.84978H9.60983L7.70313 6.79823L8.87915 8L12.7934 4L8.87915 0Z" fill="currentColor"/>
                                            </svg>
                                        </p>
                                    </a>
                                </div>
                                <img class="hero-slide-img md:rounded-lg object-cover" src="{{ $slide->fileUrl() }}" style="width:100%">
                            </div>
                        @endforeach

                        <a class="prev text-gray-10 hidden md:block" onclick="plusSlides(-1)">
                            <svg class="ml-3 mt-1.5" width="9" height="13" viewBox="0 0 9 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.32668 0.337159L8.66402 1.65614L3.65882 6.59262L8.66402 11.5291L7.32667 12.8481L0.98413 6.59262L7.32668 0.337159Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <a class="next text-gray-10 hidden md:block" onclick="plusSlides(1)">
                            <svg class="ml-3 mt-1.5" width="9" height="13" viewBox="0 0 9 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.3231 0.337159L0.985761 1.65614L5.99096 6.59262L0.985762 11.5291L2.32311 12.8481L8.66565 6.59262L2.3231 0.337159Z" fill="currentColor"/>
                            </svg>
                        </a>

                        <div class="text-center relative -mt-10 z-50">
                            @foreach ($slides as $slide)
                                <span class="dot" onclick="currentSlides({{ $loop->iteration }})"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </header>
</section>

