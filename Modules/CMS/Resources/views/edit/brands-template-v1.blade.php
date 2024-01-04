    @php
        $collapse__id = 'collapse_' . \Modules\CMS\Utility\CMSUtility::randomStr();
        $data = getComponentProperties($component ?? null);
    @endphp
    <div class="card dd-content {{ $editorClosed ?? 'card-hide' }}">
        <div class="card-body">
            <form action="{{ route('builder.update', ['id' => '__id']) }}" data-type="component" method="post"
                class="component_form form-parent" novalidate>
                @csrf
                @include('cms::hidden_fields')
                <div class="form-group row">
                    <label class="col-sm-3 control-label require">{{ __('Title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control crequired" required name="title" id="title"
                            value="{{ componentValue($component ?? null, 'title') ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label require">{{ __('Brands Type') }}</label>
                    <div class="col-sm-8">
                        <select type="text" class="form-control crequired select3" required name="brand_type"
                            id="brand_type">
                            @foreach (\Modules\CMS\Utility\CMSUtility::brandsOptions() as $key => $value)
                                <Option
                                    {{ componentValue($component ?? null, 'brand_type') == $key ? 'selected' : '' }}
                                    value="{{ $key }}">{{ $value }}</Option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @include('cms::pieces.submit-btn')
            </form>
        </div>
    </div>
