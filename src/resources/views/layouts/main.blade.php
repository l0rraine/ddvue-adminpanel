@php
    $config = [
        'dashboard_name' => config('ddvue.adminpanel.dashboard_name'),
        'dashboard_url_prefix'=> config('ddvue.adminpanel.url_prefix'),
    ];

    $polyfills = [
        'Promise',
        'Object.assign',
        'Object.values',
        'Array.prototype.find',
        'Array.prototype.findIndex',
        'Array.prototype.includes',
        'String.prototype.includes',
        'String.prototype.startsWith',
        'String.prototype.endsWith',
    ];
@endphp

<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('ddvue.adminpanel.dashboard_name') }}</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    {{--<link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<script>window.config = @json($config);</script>
<div id="app">
    <ddv-app>
        <div slot="content">
            @yield('content')
        </div>
    </ddv-app>
</div>


{{-- Polyfill JS features via polyfill.io --}}
{{--<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features={{ implode(',', $polyfills) }}"></script>--}}


<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    function autoSetLayoutMainHeight() {
        const layoutMainEl = document.getElementById('app');

        // 初始化 mainHeight，避免出现 mainHeight 附上 clientHeight 的值就一直保持不变
        layoutMainEl.style.height = 'auto';

        // 计算 mainHeight 新高度
        const clientHeight = document.body.clientHeight;
        const layoutMainHeight = layoutMainEl.offsetHeight;

        if (layoutMainHeight < clientHeight) {
            layoutMainEl.style.height = `${clientHeight}px`;
        }
    }

    window.addEventListener('resize', autoSetLayoutMainHeight);
</script>
</body>
</html>
