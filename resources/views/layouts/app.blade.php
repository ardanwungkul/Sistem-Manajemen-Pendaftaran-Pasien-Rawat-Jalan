<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

    <!-- Scripts -->
    @if (env('APP_DEPLOY') == true)
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/app2.css') }}">
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="flex w-full">
            <div>
                <x-sidebar />
            </div>
        </div>


        <!-- Page Content -->
        <main class="md:pl-64 pl-2">
            <div>
                <div class="px-5 py-2 bg-white shadow-lg h-[72.67px] -ml-2 ">
                    <div class="flex justify-between items-center h-full px-5">
                        @if (isset($header))
                            <p class="font-semibold lg:text-xl text-lg text-gray-800 leading-none">
                                {{ $header }}
                            </p>
                        @endif
                        <div class="flex items-center gap-3 flex-none">
                            <div class="text-end hidden md:block">
                                <p class="">Hii, {{ Auth::user()->name }}</p>
                                <p class="text-xs">
                                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('ddd, DD MMM YYYY') }}</p>
                            </div>
                            <div>
                                <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                                    data-dropdown-placement="bottom-end"
                                    class="flex items-center justify-center text-sm rounded-full md:me-0 focus:ring-2 w-8 h-8 border border-gray-300"
                                    type="button">
                                    <span class="sr-only">Open Menu</span>
                                    <i class="fa-user fa-regular "></i>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="dropdownAvatar"
                                    class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 border">
                                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        <p class="text-xs">{{ Auth::user()->name }}</p>
                                        <div class="font-medium truncate text-xs">
                                            {{ Auth::user()->email }}
                                        </div>
                                    </div>
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownUserAvatarButton">
                                        <li>
                                            <a href="{{ route('profile.edit') }}"
                                                class="block px-4 py-2 hover:bg-gray-100 text-xs">Profil</a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();"
                                                    class="block px-4 py-2 hover:bg-gray-100 text-xs">Logout</a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-5">
                @if (count($errors) > 0)
                    <div class="fixed bottom-5 right-5 z-50 flex flex-col gap-y-3 justify-end items-end">
                        @foreach ($errors->all() as $error)
                            <div id="toast-error-{{ $loop->index }}"
                                class="flex items-center gap-2 w-min p-4 text-gray-500 bg-white rounded-lg shadow border border-red-500"
                                role="alert">
                                <div
                                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-red-300 rounded-lg">
                                    <svg class="w-4 h-4 fill-red-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="-3.5 0 19 19">

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
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div class="fixed top-5 right-5 z-20">
                        <div id="toast-success"
                            class="flex items-center gap-2 w-min p-4 text-gray-500 bg-white rounded-lg shadow border border-green-500"
                            role="alert">
                            <div
                                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-green-300 rounded-lg">
                                <svg viewBox="0 0 24 24" class="w-4 h-4 stroke-green-500 fill-none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                <span class="sr-only">Fire icon</span>
                            </div>
                            <div class="ms-3 text-sm font-normal whitespace-nowrap">{{ session('success') }}
                            </div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
                                data-dismiss-target="#toast-success" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                <div>

                    {{ $slot }}
                </div>
            </div>
        </main>

    </div>
    @if (env('APP_DEPLOY') == true)
        <script src="{{ asset('build/assets/app.js') }}"></script>
    @endif
</body>

<script src="{{ asset('assets/js/font-awesome.min.js') }}"></script>


</html>
