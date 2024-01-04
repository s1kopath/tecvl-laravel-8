<div id="report">
    <h3 class="tab-content-title">
     {{ $reportName }}
    </h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        @foreach($header as $key => $value)
                            @if(request()->type == $key)
                                @foreach($value as $data)
                                <th>{{ $data }}</th>
                                @endforeach()
                            @endif
                        @endforeach()
                    </tr>
                </thead>
                <tbody>
                 @foreach($report as $key => $value)
                    <tr> 
                        @foreach($value as $k => $data)
                        <td>{{ $data }}</td>
                        @endforeach()
                    </tr>
                @endforeach()
                </tbody>
                
            </table>
            @if(sizeof($report) == 0)
           <h4 class="text-center">{{ __('No Data Found') }}</h4>
           @endif
            <div class="pull-right"></div>
        </div>
</div>