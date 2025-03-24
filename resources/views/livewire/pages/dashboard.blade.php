<div>
    <!-- BEGIN: Content -->
    <div
        class="md:max-w-auto min-h-screen min-w-0 max-w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] dark:bg-darkmode-700 md:px-[22px]">
       
    <livewire:navbar.navbar />



    <div wire:click="runJob"> run job </div>





        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 2xl:col-span-9">

                <div class="intro-y flex h-10 items-center mt-4 mb-4">
                    <h2 class="mr-5 truncate text-lg font-medium">General Report</h2>
                    <a
                        class="ml-auto flex items-center text-primary"
                        href=""
                    >
                        <i
                            data-tw-merge
                            data-lucide="refresh-ccw"
                            class="stroke-1.5 w-5 h-5 mr-3 h-4 w-4 mr-3 h-4 w-4"
                        ></i>


                        Reload Data
                    </a>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 justify-center items-center  ">
                    <!-- Card for Above 3 Days -->
                    <div class="bg-gradient-to-br from-blue-50 to-white shadow-lg rounded-2xl p-6 w-full text-center transition-transform transform hover:scale-105 hover:shadow-2xl">
                        <h3 class="text-xl font-semibold text-blue-600 mb-4">Above 3 Days</h3>
                        <p class="text-5xl font-bold text-gray-800 mb-4">
                            @php
                                use Illuminate\Support\Facades\DB;
                                $count = DB::table('emails')
                                    ->whereBetween('created_at', [now()->subDays(10), now()->subDays(3)])
                                    ->count();
                            @endphp
                            {{ $count }}
                        </p>
                        <p class="text-sm text-gray-500 mb-4">Tickets</p>
                        <div class="mt-4">
                            <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium shadow-sm">Urgent</span>
                        </div>
                    </div>

                    <!-- Card for Above 10 Days -->
                    <div class="bg-gradient-to-br from-yellow-50 to-white shadow-lg rounded-2xl p-6 w-full text-center transition-transform transform hover:scale-105 hover:shadow-2xl">
                        <h3 class="text-xl font-semibold text-yellow-600 mb-4">Above 10 Days</h3>
                        <p class="text-5xl font-bold text-gray-800 mb-4">
                            @php

                                $count = DB::table('emails')
                                    ->whereBetween('created_at', [now()->subDays(30), now()->subDays(10)])
                                    ->count();
                            @endphp
                            {{ $count }}
                        </p>
                        <p class="text-sm text-gray-500 mb-4">Tickets</p>
                        <div class="mt-4">
                            <span class="px-4 py-2 bg-yellow-100 text-yellow-600 rounded-full text-sm font-medium shadow-sm">High Priority</span>
                        </div>
                    </div>

                    <!-- Card for Above 30 Days -->
                    <div class="bg-gradient-to-br from-orange-50 to-white shadow-lg rounded-2xl p-6 w-full text-center transition-transform transform hover:scale-105 hover:shadow-2xl">
                        <h3 class="text-xl font-semibold text-orange-600 mb-4">Above 30 Days</h3>
                        <p class="text-5xl font-bold text-gray-800 mb-4">
                            @php

                                $count = DB::table('emails')
                                    ->whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])
                                    ->count();
                            @endphp
                            {{ $count }}
                        </p>
                        <p class="text-sm text-gray-500 mb-4">Tickets</p>
                        <div class="mt-4">
                            <span class="px-4 py-2 bg-orange-100 text-orange-600 rounded-full text-sm font-medium shadow-sm">Medium Priority</span>
                        </div>
                    </div>

                    <!-- Card for Above 60 Days -->
                    <div class="bg-gradient-to-br from-red-50 to-white shadow-lg rounded-2xl p-6 w-full text-center transition-transform transform hover:scale-105 hover:shadow-2xl">
                        <h3 class="text-xl font-semibold text-red-600 mb-4">Above 60 Days</h3>
                        <p class="text-5xl font-bold text-gray-800 mb-4">
                            @php

                                $count = DB::table('emails')
                                    ->whereBetween('created_at', [now()->subDays(90), now()->subDays(60)])
                                    ->count();
                            @endphp
                            {{ $count }}
                        </p>
                        <p class="text-sm text-gray-500 mb-4">Tickets</p>
                        <div class="mt-4">
                            <span class="px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm font-medium shadow-sm">Critical</span>
                        </div>
                    </div>

                    <!-- Card for Above 90 Days -->
                    <div class="bg-gradient-to-br from-purple-50 to-white shadow-lg rounded-2xl p-6 w-full text-center transition-transform transform hover:scale-105 hover:shadow-2xl">
                        <h3 class="text-xl font-semibold text-purple-600 mb-4">Above 90 Days</h3>
                        <p class="text-5xl font-bold text-gray-800 mb-4">
                            @php

                                $count = DB::table('emails')
                                    ->whereBetween('created_at', [now()->subDays(365), now()->subDays(90)])
                                    ->count();
                            @endphp
                            {{ $count }}
                        </p>
                        <p class="text-sm text-gray-500 mb-4">Tickets</p>
                        <div class="mt-4">
                            <span class="px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-medium shadow-sm">Overdue</span>
                        </div>
                    </div>
                </div>








                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium">General Report</h2>
                            <a
                                class="ml-auto flex items-center text-primary"
                                href=""
                            >
                                <i
                                    data-tw-merge
                                    data-lucide="refresh-ccw"
                                    class="stroke-1.5 w-5 h-5 mr-3 h-4 w-4 mr-3 h-4 w-4"
                                ></i>


                                Reload Data
                            </a>
                        </div>
                        <div class="mt-5 grid grid-cols-12 gap-6">
                            @php
                                $levels = DB::table('levels')->get();
                            @endphp

                            @foreach ($levels as $level)

                                <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                    <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <a
                                                    class="whitespace-nowrap font-medium"
                                                    href=""
                                                >
                                                    {{ $level->level_name }}
                                                </a>
                                                @php
                                                        $count_total = \Illuminate\Support\Facades\DB::table('emails')->count();
                                                        $count = \Illuminate\Support\Facades\DB::table('emails')->where('level',$level->id)->count();
                                                @endphp

                                                <div class="ml-auto">
                                                    <div
                                                        data-placement="top"
                                                        title="33% Higher than last month"
                                                        class="tooltip cursor-pointer flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white"
                                                    >{{($count/$count_total)*100}} %
                                                    </div>



                                                </div>
                                            </div>
                                            <div class="mt-6 text-3xl font-medium leading-8">


                                                {{$count}}
                                            </div>
                                            <div class="mt-1 text-base text-slate-500">{{ $level->level_name }} tickets</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach




                        </div>
                    </div>
                    <!-- END: General Report -->


                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium">General Report</h2>
                            <a
                                class="ml-auto flex items-center text-primary"
                                href=""
                            >
                                <i
                                    data-tw-merge
                                    data-lucide="refresh-ccw"
                                    class="stroke-1.5 w-5 h-5 mr-3 h-4 w-4 mr-3 h-4 w-4"
                                ></i>


                                Reload Data
                            </a>
                        </div>
                        <div class="mt-5 grid grid-cols-12 gap-6">
                            @php
                                $statuses = DB::table('ticket_statuses')->get();
                            @endphp


                        @foreach ($statuses as $status)

                                <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                                    <div class="relative zoom-in before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                                        <div class="box p-5">
                                            <div class="flex">
                                                {{ $status->icon }}
                                                <a
                                                    class="whitespace-nowrap font-medium"
                                                    href=""
                                                >
                                                    {{ $status->status_name }}
                                                </a>

                                                @php
                                                    $count_total = \Illuminate\Support\Facades\DB::table('emails')->count();
                                                    $count = \Illuminate\Support\Facades\DB::table('emails')->where('status',$status->status_name)->count();
                                                @endphp

                                                <div class="ml-auto">
                                                    <div
                                                        data-placement="top"
                                                        title="33% Higher than last month"
                                                        class="tooltip cursor-pointer flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white"
                                                    >{{ round(($count / $count_total) * 100) }} %
                                                    </div>



                                                </div>
                                            </div>
                                            <div class="mt-6 text-3xl font-medium leading-8">

                                                {{$count}}
                                            </div>
                                            <div class="mt-1 text-base text-slate-500"> {{ $status->description }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach




                        </div>
                    </div>
                    <!-- END: General Report -->


                </div>
            </div>




            <div class="col-span-12 2xl:col-span-3">
    <div class="pb-10">
        <div class="grid grid-cols-12 gap-x-6 gap-y-6">
            <!-- BEGIN: Latest Tickets -->
            <div class="col-span-12 md:col-span-6 mt-3">
                <div class="intro-x flex h-10 items-center">
                    <h2 class="mr-5 truncate text-lg font-medium">Latest Tickets</h2>
                </div>
                <div class="mt-5">
                    @foreach ($groupedEmails as $originalSubject => $emailGroup)
                        @php
                            $originalEmail = $emailGroup->first(fn($email) => !str_starts_with(strtolower($email->subject), 're:'));
                            $replies = $emailGroup->filter(fn($email) => str_starts_with(strtolower($email->subject), 're:'));
                        @endphp

                        @if ($originalEmail) <!-- Ensure $originalEmail is not null -->
                        <div class="intro-x">
                            <div class="box zoom-in mb-3 flex items-center px-5 py-3">
                                <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                                    <img class="rounded-full" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar" />
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">{{ $originalEmail->from_email }}</div>
                                    <div class="mt-0.5 text-xs text-slate-500">
                                        {{ $originalSubject ?? 'No Subject' }}
                                    </div>
                                </div>
                                <div class="text-success">
                                    New
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- END: Latest Tickets -->

            <!-- BEGIN: Recent Escalations -->
            <div class="col-span-12 md:col-span-6 mt-3">
                <div class="intro-x flex h-10 items-center">
                    <h2 class="mr-5 truncate text-lg font-medium">
                        Recent Escalations
                    </h2>
                </div>

                <div class="mt-5">
                    @foreach ($groupedEmails as $originalSubject => $emailGroup)
                        @php
                            $originalEmail = $emailGroup->first(fn($email) => !str_starts_with(strtolower($email->subject), 're:'));
                            $replies = $emailGroup->filter(fn($email) => str_starts_with(strtolower($email->subject), 're:'));
                        @endphp

                        @if ($originalEmail) <!-- Ensure $originalEmail is not null -->
                        <div class="intro-x">
                            <div class="box zoom-in mb-3 flex items-center px-5 py-3">
                                <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                                    <img class="rounded-full" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar" />
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">{{ $originalEmail->from_email }}</div>
                                    <div class="mt-0.5 text-xs text-slate-500">
                                        {{ $originalSubject ?? 'No Subject' }}
                                    </div>
                                </div>
                                <div class="text-red-500">
                                    Escalated
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- END: Recent Escalations -->
        </div>
    </div>
</div>





        </div>
    </div>
    <!-- END: Content -->
</div>
