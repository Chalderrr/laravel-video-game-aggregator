<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video Game Aggregator</title>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 text-white">
    <header class="border-b border-gray-800">
        <nav class="container mx-auto flex items-center justify-between px-4 py-6">
            <div class="flex items-center">
                <a href="/">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-32 flex-none">
                </a>

                <ul class="flex ml-16 space-x-8">
                    <li><a href="#" class="hover:text-gray-400">Games</a></li>
                    <li><a href="#" class="hover:text-gray-400">Review</a></li>
                    <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
                </ul>
            </div>
            <div class="flex items-center">
                <div class="relative">

                </div>
                <div class="ml-6">
                    <a href="#"><img src="{{ asset('avatar.jpg') }}" alt="" class="rounded-full w-8"></a>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
