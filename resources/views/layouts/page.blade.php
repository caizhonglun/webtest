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

    <title>桃園市政府教育局</title>
    @yield('style')
    <!-- Styles -->
    <link href="{{ mix('css/index.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            @include('partials.header')
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-2 hidden-sm hidden-xs hidden-sm">
                    @yield('sidebar')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    <ol class="breadcrumb">
                    @foreach($position as $item)
                        @isset($item['url'])
                        <li><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                        @else
                        <li>{{ $item['name'] }}</li>
                        @endisset
                    @endforeach
                    </ol>
                    @yield('content')
                </div>
            </div>
        </div>

        <section class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('partials.marquee')
                </div>
            </div>
        </section>

        <footer>
            @include('partials.footer')
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/bootstrap.js') }}"></script>
    <script src="{{ mix('js/index.js') }}"></script>

    @yield('script')

</body>
</html>
