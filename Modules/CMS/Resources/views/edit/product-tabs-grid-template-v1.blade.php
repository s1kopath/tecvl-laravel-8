    @php
        $collapse__id = 'collapse_' . \Modules\CMS\Utility\CMSUtility::randomStr();
        $data = getComponentProperties($component ?? null);
        $select2class = \Modules\CMS\Utility\CMSUtil::randomStr();
        $productTypes = \Modules\CMS\Utility\CMSUtil::productTypes();
        $selectedTypes = componentValue($component ?? null, 'disp_categories');
    @endphp
    <div class="card dd-content {{ $editorClosed ?? 'card-hide' }}">
        <div class="card-body">
            <form action="{{ route('builder.update', ['id' => '__id']) }}" novalidate data-type="component"
                method="post" class="component_form form-parent">
                @csrf
                @include('cms::hidden_fields')
                <div class="form-group row">
                    <label class="col-sm-3 control-label require">{{ __('Title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control crequired" name="title" id="title"
                            value="{{ builderGetValue($data, 'title') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label require">{{ __('Categories') }}</label>
                    <div class="col-sm-8">
                        <select name="disp_categories[]" required multiple="multiple"
                            class="form-control crequired select2 dcat" required>
                            @if ($selectedTypes)
                                @foreach ($selectedTypes as $category)
                                    <option selected value="{{ $category }}">{{ $productTypes[$category] }}
                                    </option>
                                    @php
                                        unset($productTypes[$category]);
                                    @endphp
                                @endforeach
                            @endif
                            @foreach ($productTypes as $key => $category)
                                <option value="{{ $key }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label">{{ __('Options') }}</label>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label
                                        class="col-md-8 control-label require">{{ __('Item Per Category') }}</label>
                                    <div class="col-sm-5">
                                        <select name="max" class="form-control crequired select3" required>
                                            <option {{ builderGetValue($data, 'max') == 5 ? 'selected' : '' }}
                                                value="5">5</option>
                                            <option {{ builderGetValue($data, 'max') == 10 ? 'selected' : '' }}
                                                value="10">10</option>
                                            <option {{ builderGetValue($data, 'max') == 15 ? 'selected' : '' }}
                                                value="15">15</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('cms::pieces.submit-btn')
            </form>
        </div>
    </div>
