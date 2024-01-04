@php
$data = getComponentProperties($component);
@endphp

@if (is_array(builderGetValue($data, 'disp_categories')))


    <section class="mx-4 lg:mx-4 xl:mx-32 2xl:mx-64 3xl:mx-92 mt-12">
        <P class="text-center font-bold text-22 text-gray-12 uppercase dm-bold">{{ builderGetValue($data, 'title') }}
        </P>
        <div id="{{ \Modules\CMS\Utility\CMSUtility::randomStr() }}" class="p_tabs c-tabs mt-4">

            <div class="flex justify-center dm-sans">
                <div class="c-tabs-nav">
                    @foreach (builderGetValue($data, 'disp_categories') as $type)
                        <a href="#"
                            class="c-tabs-nav__link {{ $loop->iteration == 1 ? 'is-active' : '' }}">{{ $homeService->getCategoryTitle($type) }}</a>
                    @endforeach
                    <div class="c-tab-nav-marker"></div>
                </div>
            </div>

            @foreach (builderGetValue($data, 'disp_categories') as $type)
                <div class="c-tab {{ $loop->iteration == 1 ? 'is-active' : '' }} mt-5">
                    <div class="c-tab__content">
                        <div class="grid grid-cols-5 gap-8">
                            @foreach ($homeService->getProducts($type, $data['max']) as $item)
                                @include('site.layouts.section.card-one')
                            @endforeach

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endif
