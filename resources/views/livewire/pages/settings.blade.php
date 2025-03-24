<div class=" min-h-screen w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] md:px-[22px]">

<livewire:navbar.navbar />


    <h2 class="intro-y mt-10 text-lg font-medium">Settings Page</h2>


    @if($this->addUser)
        <div class="box mt-6">
            <form wire:submit.prevent="createTicketLevel">
                <div class="border-b border-slate-200/60 p-5 dark:border-darkmode-400 lg:flex-row">

                    <!-- Name Input -->
                    <label for="level_name" class="inline-block mb-2 mt-2">Level Name</label>
                    <input id="level_name" type="text" wire:model="level_name" placeholder="Enter name"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />
                    @error('level_name') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>

                    <!-- Email Input -->
                    <label for="excallation_email" class="inline-block mb-2 mt-2">Excallation Email</label>
                    <input id="excallation_email" type="text" wire:model="excallation_email" placeholder="Enter Excallation Email"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />
                    @error('excallation_email') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>

                    <!-- Level Select -->
                    <label for="response_time" class="mt-2 inline-block mb-2">Response Time</label>
                    <input id="response_time" type="number" wire:model="response_time" placeholder="Enter Response Time"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />

                    @error('level') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>

                    <!-- Level Select -->
                    <label for="Resolution Time" class="mt-2 inline-block mb-2">Resolution Time</label>
                    <input id="resolution_time" type="number" wire:model="resolution_time" placeholder="Enter Resolution Time"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />

                    @error('resolution_time') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>

                    <!-- Submit Button with Spinner -->
                    <button type="submit"
                            class="bg-primary text-white mt-5 py-2 px-3 rounded-md shadow-sm hover:bg-opacity-90 flex gap-2"
                            wire:loading.attr="disabled" wire:target="createTicketLevel">

                        <!-- Spinner (Visible While Loading) -->
                        <div wire:loading wire:target="createTicketLevel">
                            <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                        </div>

                        Register Level
                    </button>



                </div>
            </form>

            @if(session()->has('success'))
                <div class="text-green-500 mt-4">{{ session('success') }}</div>
            @endif
        </div>
    @else


        <div class="mt-5 w-full ">

            <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
                <button
                    wire:click="showForm"
                    wire:loading.attr="disabled" wire:target="showForm"
                    data-tw-merge
                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md mr-2 shadow-md"
                >
                    <!-- Spinner (Visible While Loading) -->
                    <div wire:loading wire:target="showForm">
                        <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </div>
                    Add New Level
                </button>




            </div>


            <div class="intro-y grid grid-cols-4 gap-6 w-full mt-4 mb-4">
                @foreach($users as $user)
                    <div class="box w-full " >
                        <div class="flex flex-col items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400 lg:flex-row w-full ">


                            <div class="image-fit h-24 w-24 lg:mr-1 lg:h-12 lg:w-12">
                                <img
                                    class="rounded-full"
                                    src="{{ asset('assets/img/avatar.png') }}"
                                    alt=""
                                />
                            </div>

                            <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left w-full flex">

                                <div class="w-1/2">
                                    <a
                                        class="font-medium"
                                        href=""
                                    >
                                        Level Name : {{$user->level_name}}
                                    </a>
                                    <div class="mt-0.5 text-xs text-slate-500">
                                        Excalation Email : {{$user->excallation_email}}
                                    </div>
                                </div>

                                <div class="w-1/2">
                                    <a
                                        class="text-xs text-slate-500"
                                        href=""
                                    >
                                        Expected Response Time : {{$user->response_time}} Hours
                                    </a>
                                    <div class="mt-0.5 text-xs text-slate-500">
                                        Expected Resolution Time : {{$user->resolution_time}} Hours
                                    </div>
                                </div>


                            </div>


                        </div>




                        <div class="p-5 flex justify-between items-center">
                            {{--                        <select wire:model="level" class="rounded-md border-primary text-white bg-primary px-2 py-1">--}}
                            {{--                            <option value="">Update Level</option>--}}
                            {{--                            <option value="1">Level 1</option>--}}
                            {{--                            <option value="2">Level 2</option>--}}
                            {{--                            <option value="3">Level 3</option>--}}
                            {{--                        </select>--}}

                            <button wire:click="edit({{ $user->id }})" class="text-slate-500 border px-2 py-1 rounded">Edit</button>
                        </div>
                    </div>
                @endforeach




            </div>



            <!-- END: Users Layout -->

        </div>

    @endif

    @if($selectedUserId)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                @if(session()->has('success'))
                    <div class="text-green-500">{{ session('success') }}</div>
                @endif

                    <!-- Name Input -->
                    <label for="level_name" class="inline-block mb-2 mt-2">Level Name</label>
                    <input id="level_name" type="text" wire:model="level_name" placeholder="Enter name"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />
                    @error('level_name') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>

                    <!-- Email Input -->
                    <label for="excallation_email" class="inline-block mb-2 mt-2">Excallation Email</label>
                    <input id="excallation_email" type="text" wire:model="excallation_email" placeholder="Enter Excallation Email"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />
                    @error('excallation_email') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>

                    <!-- Level Select -->
                    <label for="response_time" class="mt-2 inline-block mb-2">Response Time</label>
                    <input id="response_time" type="number" wire:model="response_time" placeholder="Enter Response Time"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />

                    @error('level') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>

                    <!-- Level Select -->
                    <label for="Resolution Time" class="mt-2 inline-block mb-2">Resolution Time</label>
                    <input id="resolution_time" type="number" wire:model="resolution_time" placeholder="Enter Resolution Time"
                           class="w-full text-sm border-slate-200 shadow-sm rounded-md text-xs mt-2 inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right
                    disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50
                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40
                    dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-lg py-1.5 pl-4 pr-8 sm:mr-2 sm:mt-2 sm:mr-2 sm:mt-2" />

                    @error('resolution_time') <span class="text-red-500">{{ $message }}</span> @enderror
                    <div></div>


                    <div class="mt-4 flex justify-between">


                    <button
                        class="bg-dark text-white mt-5 py-2 px-3 rounded-md shadow-sm hover:bg-opacity-90 flex gap-2"
                        wire:loading.attr="disabled" wire:target="selectedUserId" wire:click="$set('selectedUserId', null)">

                        <!-- Spinner (Visible While Loading) -->
                        <div wire:loading wire:target="selectedUserId">
                            <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                        </div>

                        Cancel
                    </button>

                    <button
                        class="bg-primary text-white mt-5 py-2 px-3 rounded-md shadow-sm hover:bg-opacity-90 flex gap-2"
                        wire:click="updateLevel" wire:loading.attr="disabled" wire:target="updateLevel">

                        <!-- Spinner (Visible While Loading) -->
                        <div wire:loading wire:target="updateLevel">
                            <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                        </div>

                        Update
                    </button>

                </div>
            </div>
        </div>
    @endif

</div>
