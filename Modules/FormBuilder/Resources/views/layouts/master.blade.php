<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Module FormBuilder') }}</title>



    <link rel="stylesheet" type="text/css"
        href="{{ asset('Modules\FormBuilder\Resources\assets\js\footable\css\footable.standalone.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Modules\FormBuilder\Resources\assets\css\styles.min.css') }}{{ \Modules\FormBuilder\Services\Helper::bustCache() }}">
    <link rel="stylesheet" href="{{ asset('public/bootstrap/css/font-awesome.min.css') }}">
    @yield('css')

</head>

<body>
    <h1>{{ __('Form Builder') }}</h1>
    @yield('content')

    <script src="{{ asset('public/dist/js/jquery.min.js') }}"></script>

    <script type="text/javascript">
        window.FormBuilder = {
            csrfToken: '{{ csrf_token() }}',
        }
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\sweetalert.min.js') }}" defer></script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\jquery-formbuilder/form-builder.min.js') }}" defer>
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\jquery-formbuilder/form-render.min.js') }}" defer>
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\parsleyjs/parsley.min.js') }}" defer></script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\clipboard/clipboard.min.js') }}?b=ck24" defer>
    </script>
    <script src="{{ asset('Modules\FormBuilder\Resources\assets\js\moment.js') }}"></script>
    <script
        src="{{ asset('Modules\FormBuilder\Resources\assets\js\script.min.js') }}{{ \Modules\FormBuilder\Services\Helper::bustCache() }}"
        defer></script>
    @yield('script')
</body>

</html>
