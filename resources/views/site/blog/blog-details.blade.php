@extends('../site/layouts.app')
@section('page_title', __('Blog Details'))
@section('content')
    <!-- component -->
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
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2929 13.2929C13.6834 12.9024 14.3166 12.9024 14.7071 13.2929L17.7071 16.2929C18.0976 16.6834 18.0976 17.3166 17.7071 17.7071C17.3166 18.0976 16.6834 18.0976 16.2929 17.7071L13.2929 14.7071C12.9024 14.3166 12.9024 13.6834 13.2929 13.2929Z" fill="#2C2C2C" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <nav class="text-gray-600 text-sm mt-30p" aria-label="Breadcrumb">
            <ol class="list-none p-0 flex flex-wrap md:inline-flex text-xs md:text-sm roboto-medium font-medium text-gray-10 leading-5">
                <li class="flex items-center">
                    <svg class="-mt-1 mr-2" width="13" height="15" viewBox="0 0 13 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.35643 1.89407C4.93608 2.1717 4.43485 2.59943 3.69438 3.23412L2.916 3.9013C2.0595 4.63545 1.82512 4.85827 1.69934 5.13174C1.57357 5.4052 1.55692 5.72817 1.55692 6.85625V10.1569C1.55692 10.9127 1.55857 11.4013 1.60698 11.7613C1.65237 12.099 1.72565 12.2048 1.7849 12.264C1.84416 12.3233 1.94997 12.3966 2.28759 12.442C2.64759 12.4904 3.13619 12.492 3.89206 12.492H8.56233C9.31819 12.492 9.80679 12.4904 10.1668 12.442C10.5044 12.3966 10.6102 12.3233 10.6695 12.264C10.7287 12.2048 10.802 12.099 10.8474 11.7613C10.8958 11.4013 10.8975 10.9127 10.8975 10.1569V6.85625C10.8975 5.72817 10.8808 5.4052 10.755 5.13174C10.6293 4.85827 10.3949 4.63545 9.53838 3.9013L8.76 3.23412C8.01953 2.59943 7.5183 2.1717 7.09795 1.89407C6.69581 1.62848 6.44872 1.55676 6.22719 1.55676C6.00566 1.55676 5.75857 1.62848 5.35643 1.89407ZM4.49849 0.595063C5.03749 0.239073 5.5849 0 6.22719 0C6.86948 0 7.41689 0.239073 7.95589 0.595063C8.4674 0.932894 9.04235 1.42573 9.7353 2.01972L10.5515 2.71933C10.5892 2.75162 10.6264 2.78347 10.6632 2.81492C11.3564 3.40806 11.8831 3.85873 12.1694 4.48124C12.4557 5.10375 12.4551 5.79693 12.4543 6.70926C12.4543 6.75764 12.4542 6.80662 12.4542 6.85625L12.4542 10.2081C12.4543 10.8981 12.4543 11.4927 12.3903 11.9688C12.3217 12.479 12.167 12.9681 11.7703 13.3648C11.3736 13.7615 10.8845 13.9162 10.3742 13.9848C9.89812 14.0488 9.30358 14.0488 8.61355 14.0488H3.84083C3.1508 14.0488 2.55626 14.0488 2.08015 13.9848C1.56991 13.9162 1.08082 13.7615 0.68411 13.3648C0.2874 12.9681 0.132701 12.479 0.064101 11.9688C9.07021e-05 11.4927 0.000124017 10.8981 0.000162803 10.2081L0.000164659 6.85625C0.000164659 6.80662 0.000122439 6.75763 8.07765e-05 6.70926C-0.000705247 5.79693 -0.00130245 5.10374 0.285011 4.48124C0.571324 3.85873 1.09802 3.40806 1.79122 2.81492C1.82798 2.78347 1.8652 2.75162 1.90288 2.71933L2.68126 2.05215C2.69391 2.0413 2.70652 2.03049 2.71909 2.01972C3.41204 1.42573 3.98698 0.932893 4.49849 0.595063Z" fill="#898989" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.50293 9.37853C3.50293 8.51876 4.19991 7.82178 5.05969 7.82178H7.39482C8.25459 7.82178 8.95158 8.51876 8.95158 9.37853V13.2704C8.95158 13.7003 8.60309 14.0488 8.1732 14.0488C7.74331 14.0488 7.39482 13.7003 7.39482 13.2704V9.37853H5.05969V13.2704C5.05969 13.7003 4.71119 14.0488 4.28131 14.0488C3.85142 14.0488 3.50293 13.7003 3.50293 13.2704V9.37853Z" fill="#898989" />
                    </svg>
                    <a href="{{ route('site.index') }}">{{ __('Home') }}</a>
                    <p class="px-2">/</p>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('blog.category', ['id' => $blog->category_id]) }}">{{ optional($blog->blogCategory)->name }}</a>
                    <p class="px-2">/</p>
                </li>
                <li>
                    <a href="#" class="text-gray-12" aria-current="page"
                        title="{{ $blog->title }}">{{ trimWords($blog->title, 65) }}</a>
                </li>
            </ol>
        </nav>
        <main>
            {{-- left --}}
            <div class="md:flex justify-between w-full mt-5">
                <div class="md:w-4/6 lg:w-full md:mr-8">
                    {{-- post cards --}}
                    <div>
                        <div class="left-side lg:w-833 w-full h-411p">
                            <img src="{{ $blog->fileUrl() }}" class="rounded w-full lg:h-411p h-full" />
                        </div>
                        <div class="mb-10 md:mt-3.5 mt-18p">
                            <div>
                                <p class="text-gray-12 ml-1 mr-5 leading-15p md:text-13 text-xs roboto-medium font-medium">
                                    <span class="font-normal text-gray-10">By</span>
                                    <span class="cursor-pointer">
                                        {{ isset($blog->user) && !empty($blog->user->name) ? $blog->user->name : '' }}
                                    </span>
                                    <span class="text-gray-10">on </span>
                                    <span class=" text-gray-12">{{ formatDate($blog->created_at) }}</span>
                                </p>
                            </div>
                            <p class="lg:leading-42p text-gray-12 break-all font-bold dm-bold mt-2.5 md:text-32 text-lg mb-2">
                                {{ $blog->title }}
                            </p>
                            <div class="roboto-medium lg:mt-6 mt-3 lg:w-833 w-full break-all font-medium text-gray-10 lg:text-15 text-sm">
                                {!! $blog->description !!}</div>
                        </div>
                    </div>
                    <div class="lg:w-833 w-full lg:h-152 border rounded border-gray-2 box-border">
                        <div class="grid lg:grid-cols-4 grid-cols-2">
                            <img class="h-24 w-24 ml-7 my-7 rounded-full" src="{{ optional($blog->user)->fileUrl() }}" alt="">
                            <div class="mt-8 lg:-ml-66p">
                                <p class="roboto-medium text-13 font-medium leading-15p text-gray-10 ">Author</p>
                                <p class="dm-sans font-medium text-lg mt-2p leading-6 text-gray-12 ">{{ optional($blog->user)->name }}</p>
                                <p class="roboto-medium text-13 font-medium mt-5p text-gray-10 leading-15p">{{ optional($blog->user)->designation }}</p>
                                <div class="flex mt-3.5 cursor-pointer text-gray-10">
                                    @if (optional($blog->user)->facebook)
                                        <a href="{{ optional($blog->user)->facebook }}">
                                            <svg class="mr-3 hover:text-gray-12 transition  ease-in-out delay-130" width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 7.51739C15 3.62777 11.6421 0.474609 7.5 0.474609C3.35786 0.474609 0 3.62777 0 7.51739C0 11.0326 2.74263 13.9463 6.32812 14.4746V9.55319H4.42383V7.51739H6.32812V5.96578C6.32812 4.20068 7.44785 3.22569 9.16099 3.22569C9.9813 3.22569 10.8398 3.36325 10.8398 3.36325V5.09643H9.89414C8.9625 5.09643 8.67188 5.63936 8.67188 6.19687V7.51739H10.752L10.4194 9.55319H8.67188V14.4746C12.2574 13.9463 15 11.0326 15 7.51739Z" fill="currentColor" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if (optional($blog->user)->instagram)
                                        <a href="{{optional($blog->user)->twitter}}">
                                            <svg class="mr-3 mt-0.5 hover:text-gray-12 transition ease-in-out delay-130" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.40426 12.4746C9.68598 12.4746 12.5757 7.85738 12.5757 3.85454C12.5757 3.72474 12.5729 3.59205 12.5675 3.46225C13.1296 3.0334 13.6147 2.50222 14 1.89365C13.4765 2.13937 12.9206 2.29984 12.3514 2.3696C12.9507 1.99064 13.3995 1.39532 13.6145 0.693985C13.0507 1.04646 12.4341 1.2951 11.7912 1.42925C11.358 0.943696 10.7852 0.622203 10.1615 0.514475C9.53772 0.406746 8.89769 0.518782 8.34035 0.83326C7.783 1.14774 7.33938 1.64714 7.07808 2.25426C6.81677 2.86138 6.75233 3.5424 6.89473 4.19203C5.75312 4.1316 4.6363 3.81875 3.61666 3.27379C2.59702 2.72882 1.69732 1.96389 0.975898 1.02859C0.609233 1.69547 0.497033 2.48461 0.662101 3.23563C0.82717 3.98665 1.25712 4.64318 1.86457 5.07181C1.40853 5.05653 0.962486 4.92701 0.563281 4.69393V4.73143C0.562873 5.43128 0.792224 6.10967 1.21235 6.65131C1.63247 7.19294 2.21744 7.56437 2.86781 7.70248C2.44537 7.82441 2.00199 7.84217 1.57199 7.7544C1.75552 8.35627 2.11258 8.88268 2.59337 9.26017C3.07415 9.63766 3.65465 9.84739 4.25387 9.86009C3.23658 10.7031 1.97993 11.1603 0.686328 11.1581C0.456917 11.1577 0.227733 11.1429 0 11.1137C1.31417 12.0031 2.84289 12.4755 4.40426 12.4746Z" fill="currentColor" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if (optional($blog->user)->instagram)
                                        <a href="{{ optional($blog->user)->instagram }}">
                                            <svg class="mt-0.5 hover:text-gray-12 transition ease-in-out delay-130" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                                <path d="M7.29625 1.31389C9.24572 1.31389 9.47657 1.32245 10.2433 1.35665C10.9558 1.388 11.3405 1.5077 11.597 1.60746C11.9362 1.73856 12.1813 1.89816 12.435 2.15182C12.6915 2.40833 12.8482 2.65059 12.9793 2.98975C13.0791 3.24626 13.1988 3.63387 13.2302 4.34355C13.2644 5.11307 13.2729 5.34393 13.2729 7.29055C13.2729 9.24002 13.2644 9.47087 13.2302 10.2376C13.1988 10.9501 13.0791 11.3348 12.9793 11.5913C12.8482 11.9305 12.6886 12.1756 12.435 12.4293C12.1785 12.6858 11.9362 12.8425 11.597 12.9736C11.3405 13.0734 10.9529 13.1931 10.2433 13.2245C9.47372 13.2587 9.24287 13.2672 7.29625 13.2672C5.34678 13.2672 5.11593 13.2587 4.34925 13.2245C3.63672 13.1931 3.25196 13.0734 2.99545 12.9736C2.65629 12.8425 2.41118 12.6829 2.15752 12.4293C1.90102 12.1728 1.74426 11.9305 1.61316 11.5913C1.5134 11.3348 1.3937 10.9472 1.36235 10.2376C1.32815 9.46802 1.3196 9.23717 1.3196 7.29055C1.3196 5.34108 1.32815 5.11022 1.36235 4.34355C1.3937 3.63102 1.5134 3.24626 1.61316 2.98975C1.74426 2.65059 1.90387 2.40548 2.15752 2.15182C2.41403 1.89531 2.65629 1.73856 2.99545 1.60746C3.25196 1.5077 3.63957 1.388 4.34925 1.35665C5.11593 1.32245 5.34678 1.31389 7.29625 1.31389ZM7.29625 0C5.31543 0 5.06747 0.00855029 4.2894 0.0427515C3.51417 0.0769526 2.9812 0.202357 2.51949 0.381913C2.03782 0.570019 1.63026 0.817978 1.22554 1.22554C0.817978 1.63026 0.57002 2.03782 0.381913 2.51664C0.202357 2.9812 0.0769526 3.51132 0.0427515 4.28655C0.00855029 5.06747 0 5.31543 0 7.29625C0 9.27707 0.00855029 9.52503 0.0427515 10.3031C0.0769526 11.0783 0.202357 11.6113 0.381913 12.073C0.57002 12.5547 0.817978 12.9622 1.22554 13.367C1.63026 13.7717 2.03782 14.0225 2.51664 14.2077C2.9812 14.3873 3.51132 14.5127 4.28655 14.5469C5.06462 14.5811 5.31258 14.5896 7.2934 14.5896C9.27422 14.5896 9.52218 14.5811 10.3003 14.5469C11.0755 14.5127 11.6084 14.3873 12.0702 14.2077C12.549 14.0225 12.9565 13.7717 13.3613 13.367C13.766 12.9622 14.0168 12.5547 14.202 12.0759C14.3816 11.6113 14.507 11.0812 14.5412 10.306C14.5754 9.52788 14.5839 9.27992 14.5839 7.2991C14.5839 5.31828 14.5754 5.07032 14.5412 4.29225C14.507 3.51702 14.3816 2.98405 14.202 2.52234C14.0225 2.03782 13.7745 1.63026 13.367 1.22554C12.9622 0.820828 12.5547 0.570019 12.0759 0.384763C11.6113 0.205207 11.0812 0.0798027 10.306 0.0456016C9.52503 0.0085503 9.27707 0 7.29625 0Z" fill="currentColor" />
                                                <path d="M7.29671 3.54883C5.22754 3.54883 3.54883 5.22754 3.54883 7.29671C3.54883 9.36588 5.22754 11.0446 7.29671 11.0446C9.36588 11.0446 11.0446 9.36588 11.0446 7.29671C11.0446 5.22754 9.36588 3.54883 7.29671 3.54883ZM7.29671 9.72784C5.95431 9.72784 4.86557 8.6391 4.86557 7.29671C4.86557 5.95431 5.95431 4.86557 7.29671 4.86557C8.6391 4.86557 9.72784 5.95431 9.72784 7.29671C9.72784 8.6391 8.6391 9.72784 7.29671 9.72784Z" fill="currentColor" />
                                                <path d="M12.0673 3.40037C12.0673 3.88489 11.674 4.27535 11.1924 4.27535C10.7078 4.27535 10.3174 3.88204 10.3174 3.40037C10.3174 2.91585 10.7107 2.52539 11.1924 2.52539C11.674 2.52539 12.0673 2.9187 12.0673 3.40037Z" fill="currentColor" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="border mt-6 -ml-20 lg:block hidden border-line w-0 h-25"></div>
                            <p class="lg:block hidden break-all lg:-ml-250p mr-30p my-10 italic text-left roboto-medium text-15 font-medium text-gray-10">{{ optional($blog->user)->description }}</p>
                            <div>
                            </div>
                        </div>
                        <div class="lg:hidden block">
                            <div class="border mx-7 border-gray-2">
                            </div>
                            <div class="text-center italic m-6 break-all roboto-medium lg:text-15 text-13 font-medium text-gray-10">
                                <p>{{ optional($blog->user)->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex lg:justify-between justify-center mt-30p">
                        <div class="lg:block hidden">
                            @if ($previousUrl)
                                <div>
                                    <a href="{{ route('blog.details', $previousUrl->slug) }}"
                                        class="flex relative lg:mt-2 arrow-hover font-medium dm-sans text-gray-10 text-base pl-4 rounded-sm">
                                        <svg class="mt-2 mr-2 absolute" width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.70711 0L6.12132 1.41421L3.82843 3.70711H13.4142C13.9665 3.70711 14.4142 4.15482 14.4142 4.70711C14.4142 5.25939 13.9665 5.70711 13.4142 5.70711H3.82843L6.12132 8L4.70711 9.41421L0 4.70711L4.70711 0Z" fill="currentColor" />
                                        </svg>
                                        <span class="ml-4 dm-sans font-medium">{{ __('Previous Post') }}</span>
                                    </a>
                                    <a href="{{ route('blog.details', $previousUrl->slug) }}" class=" text-base transition ease-in-out delay-120 title-text-decoration dm-sans  font-medium text-gray-12">{{ trimWords($previousUrl->title, 45) }}</a>
                                </div>
                            @else
                                <a href="#" class="flex relative pointer-events-none lg:mt-2 arrow-hover font-medium dm-sans text-gray-10 text-base pl-4 rounded-sm">
                                    <svg class="mt-2 mr-2 absolute" width="15" height="10" viewBox="0 0 15 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.70711 0L6.12132 1.41421L3.82843 3.70711H13.4142C13.9665 3.70711 14.4142 4.15482 14.4142 4.70711C14.4142 5.25939 13.9665 5.70711 13.4142 5.70711H3.82843L6.12132 8L4.70711 9.41421L0 4.70711L4.70711 0Z" fill="currentColor" />
                                    </svg>
                                    <span class="ml-4 dm-sans font-medium">{{ __('Previous Post') }}</span>
                                </a>
                            @endif
                        </div>
                        <div>
                            @if ($nextUrl)
                                <div class="flex flex-col lg:items-end items-center justify-center lg:justify-end">
                                    <a href="{{ route('blog.details', $nextUrl->slug) }}" class="process-goto relative justify-center text-gray-10 font-medium lg:text-base text-sm dm-sans inline-flex items-center py-2 dm-sans">
                                        <span class="-ml-5">{{ __('Next Post') }}</span>
                                        <svg class="ml-2 relative lg:block hidden" width="15" height="10"
                                            viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z" fill="#898989" />
                                        </svg>
                                        <svg class="ml-2 relative lg:hidden block" xmlns="http://www.w3.org/2000/svg"
                                            width="12" height="8" viewBox="0 0 12 8" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08128 0L6.90393 1.20177L8.81279 3.15022H0.832512C0.372728 3.15022 0 3.53068 0 4C0 4.46932 0.372728 4.84978 0.832512 4.84978H8.81279L6.90393 6.79823L8.08128 8L12 4L8.08128 0Z" fill="#898989" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('blog.details', $nextUrl->slug) }}" class=" text-base transition ease-in-out delay-120 title-text-decoration lg:text-right text-center dm-sans font-medium text-gray-12">{{ trimWords($nextUrl->title, 45) }}</a>
                                </div>
                            @else
                                <a href="#" class="process-goto relative justify-center text-gray-10 font-medium lg:text-base text-sm dm-sans inline-flex items-center py-2 dm-sans pointer-events-none">
                                    <span class="-ml-5">{{ __('Next Post') }}</span>
                                    <svg class="ml-2 relative lg:block hidden" width="15" height="10" viewBox="0 0 15 10"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70696 0L8.29274 1.41421L10.5856 3.70711H0.999849C0.447564 3.70711 -0.000150681 4.15482 -0.000150681 4.70711C-0.000150681 5.25939 0.447564 5.70711 0.999849 5.70711H10.5856L8.29274 8L9.70696 9.41421L14.4141 4.70711L9.70696 0Z" fill="#898989" />
                                    </svg>
                                    <svg class="ml-2 relative lg:hidden block" xmlns="http://www.w3.org/2000/svg" width="12"
                                        height="8" viewBox="0 0 12 8" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.08128 0L6.90393 1.20177L8.81279 3.15022H0.832512C0.372728 3.15022 0 3.53068 0 4C0 4.46932 0.372728 4.84978 0.832512 4.84978H8.81279L6.90393 6.79823L8.08128 8L12 4L8.08128 0Z" fill="#898989" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    <p class="lg:text-22 text-lg dm-bold lg:mt-10 mt-30p uppercase font-bold text-center leading-29p text-gray-12">{{__('Related Posts')}}</p>
                    <div class="flex space-x-5 md:space-x-3 overflow-auto md:mt-15p mt-2 mb-30p">
                        @foreach ($relatedPosts as $relatedPost)
                            <div class="relative w-full md:w-1/3 sm:mb-0 mb-6">
                                <div class="w-245p md:w-full">
                                    <img alt="content" class="rounded h-141p w-275p" src="{{ $relatedPost->fileUrl() }}">
                                    <div class="absolute left-2.5 top-2.5 bg-opacity rounded-sm px-2 pt-0 pb-2p">
                                        <p class="text-center text-15 font-bold dm-bold  md:mt-0">{{ date('d', strtotime($blog->created_at)) }}</p>
                                        <p class="text-center text-xss font-normal -mt-1.5 dm-regular">{{ date('M', strtotime($blog->created_at)) }}</p>
                                    </div>
                                </div>
                                <p class="text-xs leading-15p dm-sans pt-11p text-gray-10 font-medium">
                                    {{ optional($relatedPost->user)->name }}
                                </p>
                                <a href="{{ route('blog.details', $relatedPost->slug) }}"
                                    class="text-base dm-sans mt-1p title-text-decoration break-all cursor-pointer leading-22p text-gray-12 font-medium"title="{{ $relatedPost->title }}"> {{ trimWords($relatedPost->title, 65) }}</a>
                                <a href="{{ route('blog.details', $relatedPost->slug) }}"
                                    class="dm-sans font-medium text-sm w-152 text-gray-10 inline-flex hover:text-gray-12  checkOut process-hover relative text-left"> Read Now
                                    <svg class="fill-current absolute items-right mt-2 mr-1 "
                                        xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7"  fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.8527 0.00012207L6.80238 1.05045L8.50529 2.75336H1.386C0.975825 2.75336 0.64331 3.08588 0.64331 3.49605C0.64331 3.90623 0.975825 4.23875 1.386 4.23875H8.50529L6.80238 5.94166L7.8527 6.99198L11.3486 3.49605L7.8527 0.00012207Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- right sidebar  --}}
                @include('site.layouts.section.blog.sidebar')
            </div>
        </main>
    </div>
@endsection
