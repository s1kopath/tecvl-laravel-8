<div class="card code-table h-360">
    <div class="card-header">
        <h5>{{ __('Most SOLD BRANDS') }}</h5>
    </div>
    <div class="card-block pb-0">
        <div class="">
            <table class="table table-hover" id="most-sold-brands">
                <thead class="bg-inherit">
                    <tr>
                        <th>{{ __('Brand') }}</th>
                        <th class="text-right">{{ __('Total orders') }}</th>
                    </tr>
                </thead>

                <tbody class="original-data">
                    @foreach ($topSoldBrands as $brand)
                        <tr>
                            <td class="unread">
                                <h6>{{ $brand['name'] }}</h6>
                            </td>
                            <td class="text-right">
                                {{ $brand['total'] }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>

                <tbody class="placeholder-data d-none">
                    <tr>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                        <td>
                            <div class="placeholder wave p-0" style="height: 16px">
                                <div class="square"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
