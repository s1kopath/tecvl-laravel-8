@extends('../site/layouts.app')
@section('page_title', __('Details'))
@section('content')
    <!-- component -->
    @if (count($blogs) >= 1)
        <div class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92">
            <div class="mt-5 md:hidden block">
                <div class="flex">
                    <div class="relative w-full">
                        <form action="{{ route('blog.search') }}" method="get">
                            <div class="h-50p focus:border-gray-12 md:w-63 rounded border text-decoration-none hover:border-gray-200 border-gray-2">
                                <input class="border-none text-sm h-12 w-56 text-gray-10 roboto-regular font-regular" type="text" name="search" value="{{ request()->search }}" placeholder="Search your keyword..">
                            </div>
                            <div class="absolute top-4 right-5">
                                <button type="submit">
                                    <svg class="cursor-pointer " xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 18 18" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2ZM0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8Z" fill="#2C2C2C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"  d="M13.2929 13.2929C13.6834 12.9024 14.3166 12.9024 14.7071 13.2929L17.7071 16.2929C18.0976 16.6834 18.0976 17.3166 17.7071 17.7071C17.3166 18.0976 16.6834 18.0976 16.2929 17.7071L13.2929 14.7071C12.9024 14.3166 12.9024 13.6834 13.2929 13.2929Z" fill="#2C2C2C" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <nav class="xl:mt-50p md:mt-8 mt-6 leading-4 md:mb-5 mb-6" aria-label="Breadcrumb">
                <ol class="list-none inline-flex">
                    <li class="flex items-center">
                        <svg class="-mt-0.5" xmlns="http://www.w3.org/2000/svg" width="13" height="15"
                            viewBox="0 0 13 15" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.35643 1.89407C4.93608 2.1717 4.43485 2.59943 3.69438 3.23412L2.916 3.9013C2.0595 4.63545 1.82512 4.85827 1.69934 5.13174C1.57357 5.4052 1.55692 5.72817 1.55692 6.85625V10.1569C1.55692 10.9127 1.55857 11.4013 1.60698 11.7613C1.65237 12.099 1.72565 12.2048 1.7849 12.264C1.84416 12.3233 1.94997 12.3966 2.28759 12.442C2.64759 12.4904 3.13619 12.492 3.89206 12.492H8.56233C9.31819 12.492 9.80679 12.4904 10.1668 12.442C10.5044 12.3966 10.6102 12.3233 10.6695 12.264C10.7287 12.2048 10.802 12.099 10.8474 11.7613C10.8958 11.4013 10.8975 10.9127 10.8975 10.1569V6.85625C10.8975 5.72817 10.8808 5.4052 10.755 5.13174C10.6293 4.85827 10.3949 4.63545 9.53838 3.9013L8.76 3.23412C8.01953 2.59943 7.5183 2.1717 7.09795 1.89407C6.69581 1.62848 6.44872 1.55676 6.22719 1.55676C6.00566 1.55676 5.75857 1.62848 5.35643 1.89407ZM4.49849 0.595063C5.03749 0.239073 5.5849 0 6.22719 0C6.86948 0 7.41689 0.239073 7.95589 0.595063C8.4674 0.932894 9.04235 1.42573 9.7353 2.01972L10.5515 2.71933C10.5892 2.75162 10.6264 2.78347 10.6632 2.81492C11.3564 3.40806 11.8831 3.85873 12.1694 4.48124C12.4557 5.10375 12.4551 5.79693 12.4543 6.70926C12.4543 6.75764 12.4542 6.80662 12.4542 6.85625L12.4542 10.2081C12.4543 10.8981 12.4543 11.4927 12.3903 11.9688C12.3217 12.479 12.167 12.9681 11.7703 13.3648C11.3736 13.7615 10.8845 13.9162 10.3742 13.9848C9.89812 14.0488 9.30358 14.0488 8.61355 14.0488H3.84083C3.1508 14.0488 2.55626 14.0488 2.08015 13.9848C1.56991 13.9162 1.08082 13.7615 0.68411 13.3648C0.2874 12.9681 0.132701 12.479 0.064101 11.9688C9.07021e-05 11.4927 0.000124017 10.8981 0.000162803 10.2081L0.000164659 6.85625C0.000164659 6.80662 0.000122439 6.75763 8.07765e-05 6.70926C-0.000705247 5.79693 -0.00130245 5.10374 0.285011 4.48124C0.571324 3.85873 1.09802 3.40806 1.79122 2.81492C1.82798 2.78347 1.8652 2.75162 1.90288 2.71933L2.68126 2.05215C2.69391 2.0413 2.70652 2.03049 2.71909 2.01972C3.41204 1.42573 3.98698 0.932893 4.49849 0.595063Z" fill="#898989" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.50293 9.37853C3.50293 8.51876 4.19991 7.82178 5.05969 7.82178H7.39482C8.25459 7.82178 8.95158 8.51876 8.95158 9.37853V13.2704C8.95158 13.7003 8.60309 14.0488 8.1732 14.0488C7.74331 14.0488 7.39482 13.7003 7.39482 13.2704V9.37853H5.05969V13.2704C5.05969 13.7003 4.71119 14.0488 4.28131 14.0488C3.85142 14.0488 3.50293 13.7003 3.50293 13.2704V9.37853Z" fill="#898989" />
                        </svg>
                        <a class="ml-2 text-gray-10 roboto-medium font-medium md:text-sm text-xs" href="{{ URL::to('/') }}">{{ __('Home') }}</a>
                        <p class="ml-2 text-gray-10 roboto-medium font-medium md:text-sm text-xs">/ </p>
                    </li>
                    <li>
                        @if (request()->search)
                            <a href="#" class="text-gray-12 md:text-sm text-xs ml-2 roboto-medium font-medium" aria-current="page">{{ __('Search Results') }}</a>
                        @elseif (request()->year)
                            <a href="#" class="text-gray-12 md:text-sm text-xs ml-2 roboto-medium font-medium" aria-current="page">{{ __('Archives') . ' ' . request()->year }}</a>
                        @elseif ($blogCategory)
                            <a href="#" class="text-gray-12 md:text-sm text-xs ml-2 roboto-medium font-medium" aria-current="page">{{ $blogCategory->name }}</a>
                        @else
                            <a href="#" class="text-gray-12 md:text-sm text-xs ml-2 roboto-medium font-medium" aria-current="page">{{ __('All Posts') }}</a>
                        @endif
                    </li>
                </ol>
            </nav>
            <main>
                <div class="md:flex justify-between w-full lg:p-0 lg:mt-4">
                    {{-- post cards --}}
                    <div class="md:w-4/6 lg:w-full">
                        @foreach ($blogs as $blog)
                            <div class="block lg:flex lg:mb-50p md:mr-30p lg:mr-0">
                                <div class="rounded-md image-width-height blog-image-width-height overflow-hidden">
                                    <div class="grow">
                                        <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">
                                            <img class="h-60 w-340 image-width-height blog-image-width-height" src="{{ $blog->fileUrl() }}" alt="{{ $blog->title }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="flex justify-center lg:w-494p w-full lg:mx-30p items-center">
                                    <div class="md:my-5 my-18p">
                                        <div>
                                            <p class="text-gray-12 ml-1  mr-5 leading-15p md:text-13 text-xs -mt-0.5 roboto-medium font-medium">
                                                <span class="font-normal text-gray-10">By</span>
                                                <span class="cursor-pointer">{{ isset($blog->user) && !empty($blog->user->name) ? $blog->user->name : ''}}
                                                </span>
                                                <span class="text-gray-10">{{__('on')}} </span>
                                                <span class=" text-gray-12">{{ formatDate($blog->created_at) }}</span>
                                            </p>
                                        </div>
                                        <div class="mt-2.5">
                                            <a href="{{ route('blog.details', $blog->slug) }}" class="leading-29p title-text-decoration break-all transition ease-in-out delay-130 text-gray-12 dm-sans font-medium lg:text-22 md:text-lg text-15" title="{{ $blog->title }}"> {{ trimWords($blog->title, 65) }}
                                            </a>
                                            <p class="text-gray-10 leading-22p md:mt-3.5 mt-2.5 break-all md:text-sm text-xs roboto-medium font-medium">{{ trimWords($blog->summary, 120) }}</p>
                                        </div>
                                        <div class="md:mt-13p mt-2.5">
                                            <a href="{{ route('blog.details', $blog->slug) }}"
                                                class="dm-sans font-medium md:text-base text-sm md:w-103p w-84p text-gray-10 inline-flex hover:text-gray-12 checkOut process-hover process-goto relative text-left"> Read Now
                                                <svg class="fill-current absolute w-4 h-4 items-right mt-1 md:block hidden"
                                                width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z" fill="currentColor" />
                                               </svg>
                                                <svg class="absolute md:hidden block mt-7p fill-current" xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08128 0L6.90393 1.20177L8.81279 3.15022H0.832512C0.372728 3.15022 0 3.53068 0 4C0 4.46932 0.372728 4.84978 0.832512 4.84978H8.81279L6.90393 6.79823L8.08128 8L12 4L8.08128 0Z" fill="currentColor"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $blogs->links('site.layouts.section.blog.pagination') }}
                    </div>
                    {{-- <!-- right sidebar --> --}}
                          @include('site.layouts.section.blog.sidebar')
                </div>
            </main>
        </div>
    @else
        <div class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 my-275p 3xl:mx-92">
            <div class="flex flex-col justify-center items-center inset-0">
                <span>
                    <img src="{{ asset('public/frontend/assets/img/blog/sorry.svg') }}" alt="">
                </span>
                <h1 class="text-center dm-sans font-medium text-32 text-gray-14 mt-30p">
                    {{ __('We’re sorry!') }}<br>
                    <span>{{ __('Blog post are not available') }}</span>
                </h1>
            </div>
        </div>
    @endif

    
@endsection
