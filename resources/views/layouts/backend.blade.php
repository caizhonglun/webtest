<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>桃園市教育局-局網管理</title>

    <!-- Styles -->
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            @include('partials.navbar')
        </header>

        <section class="container">
            @isset($position)
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                    @foreach($position as $item)
                        @isset($item['url'])
                        <li><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                        @else
                        <li>{{ $item['name'] }}</li>
                        @endisset
                    @endforeach
                    </ol>
                </div>
            </div>
            @endisset

            @yield('content')
        </section>

        <footer class="container">
            <hr>
            <p class="text-muted">&copy; 2017 桃園市教育局版權所有。</p>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/bootstrap.js') }}"></script>
    <script src="/js/ckeditor/ckeditor.js"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    @yield('script')
</body>
</html>
