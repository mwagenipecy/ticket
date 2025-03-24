<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Saccos Management System</title>

    <livewire:styles />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/flowbite.min.css') }}" type="text/css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .waves {
            position: relative;
            width: 100%;
            height: 15vh;
            margin-bottom: -7px;
            min-height: 100px;
            max-height: 150px;
        }

        .parallax > use {
            animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
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
                transform: translate3d(-90px, 0, 0);
            }
            100% {
                transform: translate3d(85px, 0, 0);
            }
        }

        @media (max-width: 768px) {
            .waves {
                height: 40px;
                min-height: 40px;
            }
            h1 {
                font-size: 24px;
            }
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #E66032;
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>




</head>
<body class="font-sans antialiased ">
<div class="bg-white text-black/50 ">
    <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="{{ asset('images/bg.svg') }}" alt="Background Image" />
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <main>
                <div class="relative flex justify-top">
                    <div class="w-full md:w-1/2">
                        <div class="flex flex-col after:flex-1 justify-end">
                            <div class="flex-1 justify-start items-start flex mt-0">
                                <div class="flex items-start justify-between h-25 px-4 sm:px-6 lg:px-8">
                                    <a class="block mt-2 flex items-center">
                                        <img class="mt-1" src="{{ asset('/images/nbc.png') }}" height="200" width="200" alt="NBC Logo" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @php

                    // $id = isset($_GET['id']) ? $_GET['id'] : 1;

                    //  // Select the dynamically set connection
                    //  DB::connection('admin')->reconnect();

                    //  // Set default connection to the institution
                    //  DB::setDefaultConnection('admin');

                    try {


                    // $user = DB::connection('admin')->table('users')->where('id', $id)->first();


                    // if ($user) {
                      //  $email = $user->email;
                      $email="andrew.s.mashamba@gmail.com";

                        Session::put('email', $email);
                        // $institutionId = $user->institution_id;
                        //$institution = DB::connection('templates')->table('users')->where('id', 1)->first();
                        //$institution_name = $institution->institution_name ?: 000;
                        Session::put('institution_name', 'institution_name');
                        //$institution_licence_number = $institution->institution_licence_number ?:000;
                        Session::put('institution_licence_number', 'institution_licence_number');
                        //$region = $institution->region ?:0000;
                        Session::put('region', 'region');
                        //dd($institution);

                    // } else {
                    //     $error = 'Email not found for user ID: ' . $user;

                    // }
                } catch (\Exception $e) {
                     $error = 'Email not found for user ID: ' . $e;
                     dd($error.'__');
                }

                // DB::reconnect();

                     // Reset default connection to the main database
              //  config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
                @endphp


                @php
                                           // Session::put('email','andrew.s.mashamba@gmail.com');

                @endphp



                <div class="pb-14 bg-right bg-cover">
                    <div class="container pt-14 md:pt-28 px-6 mx-auto mt-8">
                        <div class="flex justify-between w-full">
                            <div class="overflow-y-hidden w-full">
                                <h1 class="text-4xl font-bold leading-tight text-gray-800 ">
                                    WAZALENDO SACCOS LIMITED
                                    {{--                                    {{ Session::get('institution_name') }}--}}
                                </h1>
                                <p class="leading-normal text-2xl mb-8 text-gray-500 ">
                                    A better way of saving, is together!
                                    {{--                                    {{ Session::get('institution_licence_number') }}<br>{{ Session::get('region') }}--}}
                                </p>

                            </div>
                            <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
                                <div class="mx-auto w-96">


                                    {{ $slot }}

                                </div>
                            </div>
                        </div>
                        <div class="w-full pt-4 pb-6 text-sm mt-2">
                            <p class="font-bold text-red-600  pb-8 lg:pb-6">Powered by:</p>
                            <div class="flex flex-wrap pb-24 lg:pb-0">
                                <ul class="max-w-md space-y-1 text-gray-500 list-inside ">
                                    <li class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-2 text-red-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                        </svg>
                                        National Bank of Commerce (NBC) Limited Tanzania.
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-2 text-red-600  flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                        </svg>
                                        Tanzania Instant Payment System (TIPS)
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-2 text-red-600  flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                        </svg>
                                        Credit Info Ltd
                                    </li>
                                </ul>
                            </div>
                            <a class="text-gray-500 no-underline hover:no-underline" href="#">&copy; App 2024</a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center rounded-lg">
                    <div class="fixed left-0 right-0 bottom-0">
                        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                            <defs>
                                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                            </defs>
                            <g class="parallax">
                                <use xlink:href="#gentle-wave" x="48" y="3" fill="#2D3D88" />
                                <use xlink:href="#gentle-wave" x="48" y="5" fill="#2D3D88" />
                                <use xlink:href="#gentle-wave" x="48" y="7" fill="#2D3D88" />
                                <use xlink:href="#gentle-wave" x="48" y="9" fill="rgba(255, 0, 0, 0.2)" />
                            </g>
                        </svg>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<livewire:scripts />
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
