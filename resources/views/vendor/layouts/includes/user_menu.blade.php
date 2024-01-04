    <ul class="nav nav-pills" role="tablist">
        <li class="nav-item">
            <a class="nav-link h-lightblue  {{ isset($profile) ? $profile : '' }}" href="{{ route('users.edit', ['id' => $user->id]) }}" role="tab" aria-controls="mcap-default" aria-selected="true">{{ __('Profile') }}</a>
        </li>
    </ul>