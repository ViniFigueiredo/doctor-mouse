<head>
    <title>@yield("title", "Doctor Mouse")</title>
    
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.6/dist/htmx.min.js" integrity="sha384-Akqfrbj/HpNVo8k11SXBb6TlBWmXXlYQrCSqEWmyKJe+hDm3Z/B2WVG4smwBkRVm" crossorigin="anonymous"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield("head")
</head>

<body>
    <div class="min-h-screen flex flex-col">
        <div class="flex-1 pb-[8vh]">
            @if (isset($slot))
                {{ $slot }}
            @endif
            @yield("contents")
        </div>
        <div class="fixed left-0 bottom-0 w-full h-[8vh] flex justify-center items-center bg-primary text-white z-50">
            <span>© 2025 Doctor Mouse. Feito com amor para gamers.</span>
        </div>
    </div>
</body>