<header class="sticky top-0 bg-white border-b border-slate-200 z-10">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 -mb-px">

            <!-- Header: Left side -->
            <div class="flex">
                <!-- Hamburger button -->
                <button
                    class="text-slate-500 hover:text-slate-600 lg:hidden"
                      @click.stop="sidebarOpen = !sidebarOpen"
                      aria-controls="sidebar"
                      :aria-expanded="sidebarOpen">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="5" width="16" height="2" />
                        <rect x="4" y="11" width="16" height="2" />
                        <rect x="4" y="17" width="16" height="2" />
                    </svg>
                </button>

                <h2 class="text-xl md:text-xl text-black-800 font-bold leading-tight tracking-tight ">SACCOS MANAGEMENT SYSTEM</h2>


            </div>

            <!-- Header: Right side -->
            <div class="flex items-center space-x-3">



                <div>
                    <div class="relative inline-block text-left flex gap-2">

                        <div class="inline-flex justify-center items-center ">
                            <img class="w-8 h-8 rounded-full" src="{{ asset('images/avatar.png')  }}" width="32" height="32" alt="{{ Auth::user()->name }}" />
                            <div class="flex items-center truncate mr-4">
                                <span class="truncate ml-2 text-sm font-medium group-hover:text-slate-800">{{ Auth::user()->name }}</span>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" x-data >
                                @csrf

                                <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center "
                                   href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();"
                                   @focus="open = true"
                                   @focusout="open = false"
                                >
                                    <button type="button" class="text-white bg-red-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full
                                    text-sm p-1.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                        <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9"></path>
                                        </svg>

                                    </button>
                                </a>
                            </form>


                        </div>





                    </div>

                </div>


            </div>

        </div>
    </div>
</header>
