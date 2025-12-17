@props(['system'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if (env('APP_DEPLOY') == true)
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/app2.css') }}">
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dotLottie.js'])
    @endif
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="h-screen w-full md:p-20 flex items-center justify-center relative bg-auth">
        @if (count($errors) > 0)
            <div class="fixed bottom-5 right-5 z-40">
                @foreach ($errors->all() as $error)
                    <div id="toast-error-{{ $loop->index }}"
                        class="flex items-center gap-2 w-min p-4 text-gray-500 bg-white rounded-lg shadow border border-red-500"
                        role="alert">
                        <div
                            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-red-300 rounded-lg">
                            <svg class="w-4 h-4 fill-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                viewBox="-3.5 0 19 19">

                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z">
                                    </path>
                                </g>
                            </svg>
                            <span class="sr-only">Fire icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal whitespace-nowrap">{{ $error }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                            data-dismiss-target="#toast-error-{{ $loop->index }}" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="flex w-full">
            <div class="hidden md:flex items-center w-full max-w-[60%]">
                <canvas id="animationLogin" class="w-full h-full object-contain"></canvas>
            </div>
            <div class="w-full md:max-w-[40%] px-3 md:px-0 flex items-center">
                <div
                    class="rounded-3xl overflow-hidden md:max-w-lg max-w-sm w-full shadow-lg border border-white z-10 max-h-[500px] mx-auto">
                    <div
                        class="bg-white/40 backdrop-blur-sm overflow-hidden px-5 py-5 flex items-center md:h-full rounded-xl">
                        <div class="w-full">
                            <div class="flex-col flex justify-center items-center pb-2 border-b border-blue-200">
                                <p class="text-blue-900 font-extrabold text-center md:text-xl text-lg leading-none">
                                    SMPPRJ
                                </p>
                                <p class="text-blue-500 font-medium text-center text-xs leading-5">
                                    Sistem Manajemen Pendaftaran Pasien Rawat Jalan.
                                </p>
                            </div>
                            <div class="py-3">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (env('APP_DEPLOY') == true)
        <script src="{{ asset('build/assets/app.js') }}"></script>
        <script src="{{ asset('build/assets/dotLottie.js') }}"></script>
    @endif


</body>

</html>
