<img class="card-img-top" src="{{ $item->fileUrl() }}" alt="Card image cap">
<div class="card-body">
    <h5 class="card-title">{{ $item->name }}</h5>
    <p class="card-text">
    <table>
        <tr>
            <th>{{ __('Price') }}:</th>
            <td>{{ formatNumber($item->price) }}</td>
        </tr>
        <tr>
            <th>{{ __('Details') }}</th>
            <td>{{ $item->details }}</td>
        </tr>
    </table>
    </p>
</div>
