    @php
        $collapse__id = 'collapse_' . \Modules\CMS\Utility\CMSUtility::randomStr();
        $allCategories = \Modules\CMS\Utility\CMSUtility::getCategoryList()->pluck('name', 'id');
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
                    <label class="col-sm-3 control-label require">{{ __('Category Type') }}</label>
                    <div class="col-sm-8">
                        <select type="text" class="col-sm-12 form-control crequired category_type select3" required name="category_type">
                            @foreach (\Modules\CMS\Utility\CMSUtility::categoryOptions() as $key => $value)
                                <Option
                                    {{ componentValue($component ?? null, 'category_type') == $key ? 'selected' : '' }}
                                    value="{{ $key }}">{{ $value }}</Option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div
                    class="form-group row cats {{ componentValue($component ?? null, 'category_type') != 'selectedCategories' ? 'd-none' : '' }}">
                    <label class="col-sm-3 control-label require">{{ __('Categories') }}</label>
                    <div class="col-sm-8">
                        <select type="text" class="form-control select2 crequired" {{ componentValue($component ?? null, 'category_type') != 'selectedCategories' ? '' : 'required' }} name="categories[]" multiple>
                            @foreach (componentValue($component ?? null, 'categories', []) as $selected)
                                @if (isset($allCategories[$selected]))
                                    <Option selected value="{{ $selected }}">{{ $allCategories[$selected] }}
                                    </Option>
                                    @php
                                        unset($allCategories[$selected]);
                                    @endphp
                                @endif
                            @endforeach
                            @foreach ($allCategories as $key => $value)
                                <Option value="{{ $key }}">{{ $value }}</Option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @include('cms::pieces.submit-btn')
            </form>
        </div>
    </div>
