<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title", "Doctor Mouse")</title>
    
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.6/dist/htmx.min.js" integrity="sha384-Akqfrbj/HpNVo8k11SXBb6TlBWmXXlYQrCSqEWmyKJe+hDm3Z/B2WVG4smwBkRVm" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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