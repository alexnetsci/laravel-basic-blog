<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="Alex">
    <title>{{ config('app.name', 'Blue') }}</title>
    <script src="https://kit.fontawesome.com/63de53cca7.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('/storage/img/Laravel.png') }}" type="image/x-icon"/>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
</head>
<body>

    <div id="app" class="flex-center d-flex flex-column h-100 position-ref full-height">
        @include('inc.navbar')
        <main role="main" class="py-4 flex-shrink-0">
            @yield('content')
        </main>
        @include('inc.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        // Toastr
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>

    <script>
        // Select2
        $('.select2-multi').select2();
    </script>

    <script>
        // Input
        $('#validatedCustomFile').on('change',function(){
            var fileName = $(this).val();
                $(this).next('.custom-file-label').html(fileName);
        })
    </script>

    <script>
        // Input #show_article_img
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                $('#show_article_img').attr('src', e.target.result);
                $('#hide_article_img').hide();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#validatedCustomFile").change(function() {
            readURL(this);
        });
    </script>
</body>
</html>
