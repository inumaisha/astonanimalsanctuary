<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{ asset('ckeditor/ckeditor.js') }}" defer></script>
        <title>{{config('app.name', 'AAS')}}</title>

    </head>
    <body>
        @include('inc.navbar')
        <div class= "container">
            @include('inc.messages')
        @yield('content')
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.ckeditor').ckeditor();
            });
        </script>
    </body>
</html>
