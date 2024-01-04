@php
$collapse__id = 'collapse_' . \Modules\CMS\Utility\CMSUtility::randomStr();
$data = getComponentProperties($component ?? null);
@endphp

<div class="card dd-content {{ $editorClosed ?? 'card-hide' }}" id="{{ $collapse__id }}">
    <div class="card-body">
        <form action="{{ route('builder.update', ['id' => '__id']) }}" novalidate data-type="component" method="post"
            class="component_form form-parent" class="form-horizontal">
            @csrf
            @include('cms::hidden_fields')
            <div class="form-group row">
                <label class="col-sm-3 control-label require">{{ __('Title') }}</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control crequired" name="title" id="title" required
                        value="{{ componentValue($component ?? null, 'title') ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label require">{{ __('Blog Type') }}</label>
                <div class="col-sm-8">
                    <select type="text" required class="form-control crequired select3" name="brand_type"
                        id="blog_type">
                        @foreach (\Modules\CMS\Utility\CMSUtility::blogsOptions() as $key => $value)
                            <Option {{ componentValue($component ?? null, 'blog_type') == $key ? 'selected' : '' }}
                                value="{{ $key }}">{{ $value }}</Option>
                        @endforeach
                    </select>
                </div>
            </div>
            @include('cms::pieces.submit-btn')
        </form>
    </div>
</div>
