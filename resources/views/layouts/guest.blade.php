<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Saccos Management System</title>

        <livewire:styles />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/flowbite.min.css') }}" type="text/css">

        <style>

            @import url(//fonts.googleapis.com/css?family=Lato:300:400);

            body {
                margin:0;
            }


            p {
                font-family: 'Lato', sans-serif;
                letter-spacing: 1px;
                font-size:14px;
                color: #333333;
            }

            .header {
                position:relative;
                text-align:center;
                background: linear-gradient(60deg, rgba(84,58,183,1) 0%, rgba(0,172,193,1) 100%);
                color:white;
            }
            .logo {
                width:50px;
                fill:white;
                padding-right:15px;
                display:inline-block;
                vertical-align: middle;
            }

            .inner-header {
                height:65vh;
                width:100%;
                margin: 0;
                padding: 0;
            }

            .flex { /*Flexbox for containers*/
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .waves {
                position:relative;
                width: 100%;
                height:15vh;
                margin-bottom:-7px; /*Fix for safari gap*/
                min-height:100px;
                max-height:150px;
            }

            .content {
                position:relative;
                height:20vh;
                text-align:center;
                background-color: white;
            }

            /* Animation */

            .parallax > use {
                animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
            }
            .parallax > use:nth-child(1) {
                animation-delay: -2s;
                animation-duration: 7s;
            }
            .parallax > use:nth-child(2) {
                animation-delay: -3s;
                animation-duration: 10s;
            }
            .parallax > use:nth-child(3) {
                animation-delay: -4s;
                animation-duration: 13s;
            }
            .parallax > use:nth-child(4) {
                animation-delay: -5s;
                animation-duration: 20s;
            }
            @keyframes move-forever {
                0% {
                    transform: translate3d(-90px,0,0);
                }
                100% {
                    transform: translate3d(85px,0,0);
                }
            }
            /*Shrinking for mobile*/
            @media (max-width: 768px) {
                .waves {
                    height:40px;
                    min-height:40px;
                }
                .content {
                    height:30vh;
                }
                h1 {
                    font-size:24px;
                }
            }
        </style>

    </head>
    <body class="antialiased bg-slate-100 text-slate-600">

    <main class="bg-white">

            <!-- Content -->
            <div class="w-full">

                <div class="min-h-screen h-full">

                    <!-- Header -->
                    <div>
                        <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">



                            <!-- Logo -->
                            <a class="block" href="{{ route('System') }}">
                                <svg width="32" height="32" viewBox="0 0 32 32">
                                    <defs>
                                        <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%" id="logo-a">
                                            <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%" />
                                            <stop stop-color="#A5B4FC" offset="100%" />
                                        </linearGradient>
                                        <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%" id="logo-b">
                                            <stop stop-color="#38BDF8" stop-opacity="0" offset="0%" />
                                            <stop stop-color="#38BDF8" offset="100%" />
                                        </linearGradient>
                                    </defs>
                                    <rect fill="#6366F1" width="32" height="32" rx="16" />
                                    <path d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z" fill="#4F46E5" />
                                    <path d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z" fill="url(#logo-a)" />
                                    <path d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z" fill="url(#logo-b)" />
                                </svg>
                            </a>
                        </div>
                    </div>



                </div>

            </div>

            </div>

        </main>

    <livewire:scripts />
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
