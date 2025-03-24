
        <div class="md:max-w-auto min-h-screen min-w-0 max-w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] md:px-[22px]">


            @php
                use Illuminate\Support\Facades\DB;
                                    use Illuminate\Support\Str;
            @endphp

<livewire:navbar.navbar />


            <!-- END: Top Bar -->
            <script>
              function callLivewireFunction() {
                Livewire.dispatch('logoutCall');
              }
            </script>

          <div class="mt-8 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-3 2xl:col-span-2">
              <h2 class="intro-y mr-auto mt-2 text-lg font-medium">Inbox</h2>
              <!-- BEGIN: Inbox Menu -->
              <div class="intro-y box mt-6 bg-primary p-5">

                  @php
                    //  $statuses = DB::table('ticket_statuses')->get();

                      $statuses = DB::table('ticket_statuses')->get();
                    foreach ($statuses as $status) {
                        $status->totalNumber = DB::table('emails')
                            ->where('status', $status->status_name)
                            ->whereIn('level', $this->userLevelId)
                            ->count();   
                          }


                  @endphp


                  <div class="mt-6 border-t border-white/10 pt-6 text-white">
                      <a class="flex items-center rounded-md px-3 py-2 @if ($this->activeStatus == 0) bg-white/10 px-3 py-2 font-medium @else cursor-pointer @endif"
                         wire:click="setView('0')">
                          <i data-lucide="mail" class="stroke-1.5 w-5 h-5 mr-2"></i> All
                      </a>

                      @foreach ($statuses as $status)
                          <a class="mt-2 flex items-center rounded-md px-3 py-2  @if ($this->activeStatus == $status->id) bg-white/10 px-3 py-2 font-medium @else cursor-pointer @endif"
                             href="#"
                             wire:click="setView('{{ $status->id }}')">
                              {{ $status->icon }}
                              {{ $status->status_name }}
                              <span class="ml-auto inline-flex items-center justify-center rounded-full bg-indigo-600 px-2 py-1 text-xs font-medium text-white">
            {{ $status->totalNumber }}
        </span>
                          </a>
                      @endforeach
                  </div>

                  <div class="mt-4 border-t border-white/10 pt-4 text-white">

                      @php
                          $levels = DB::table('levels')->get();
                      @endphp

                      @foreach ($levels as $level)

                          <a class="mt-2 flex items-center truncate rounded-md px-3 py-2 @if ($this->activeStatus == $level->id.'a') bg-white/10 px-3 py-2 font-medium @else cursor-pointer @endif"
                             wire:click="setView('{{ $level->id.'a' }}')">
                              <div class="mr-3 h-2 w-2 rounded-full bg-success"></div> {{ $level->level_name }}
                          </a>
                      @endforeach


                </div>
              </div>
              <!-- END: Inbox Menu -->
            </div>
            <div class="col-span-12 lg:col-span-9 2xl:col-span-10">
              <!-- BEGIN: Inbox Filter -->
              <div class="intro-y flex flex-col-reverse items-center sm:flex-row">
                <div class="relative mr-auto mt-3 w-full sm:mt-0 sm:w-auto">
                  <i data-tw-merge data-lucide="search" class="stroke-1.5 w-5 h-5 absolute inset-y-0 left-0 z-10 my-auto ml-3 h-4 w-4 text-slate-500 absolute inset-y-0 left-0 z-10 my-auto ml-3 h-4 w-4 text-slate-500"></i>
                  <input data-tw-merge type="text" placeholder="Search mail" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box w-full px-10 sm:w-64 !box w-full px-10 sm:w-64" />
                  <div data-tw-merge data-tw-placement="bottom-start" class="dropdown relative absolute inset-y-0 right-0 mr-3 flex items-center">
                    <a data-tw-toggle="dropdown" aria-expanded="false" href="javascript:;" class="cursor-pointer block h-4 w-4" role="button">
                      <i data-tw-merge data-lucide="chevron-down" class="stroke-1.5 w-5 h-5 h-4 w-4 cursor-pointer text-slate-500 h-4 w-4 cursor-pointer text-slate-500"></i>
                    </a>
                    <div data-transition data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                      <div data-tw-merge class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] !-ml-[228px] mt-2.5 w-[478px] pt-2">
                        <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">
                          <div class="col-span-6">
                            <label data-tw-merge for="input-filter-1" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs"> From </label>
                            <input data-tw-merge id="input-filter-1" type="text" placeholder="example@gmail.com" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1 flex-1" />
                          </div>
                          <div class="col-span-6">
                            <label data-tw-merge for="input-filter-2" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs"> To </label>
                            <input data-tw-merge id="input-filter-2" type="text" placeholder="example@gmail.com" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1 flex-1" />
                          </div>
                          <div class="col-span-6">
                            <label data-tw-merge for="input-filter-3" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs"> Subject </label>
                            <input data-tw-merge id="input-filter-3" type="text" placeholder="Important Meeting" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1 flex-1" />
                          </div>
                          <div class="col-span-6">
                            <label data-tw-merge for="input-filter-4" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs"> Has the Words </label>
                            <input data-tw-merge id="input-filter-4" type="text" placeholder="Job, Work, Documentation" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1 flex-1" />
                          </div>
                          <div class="col-span-6">
                            <label data-tw-merge for="input-filter-5" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs"> Doesn't Have </label>
                            <input data-tw-merge id="input-filter-5" type="text" placeholder="Job, Work, Documentation" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1 flex-1" />
                          </div>
                          <div class="col-span-6">
                            <label data-tw-merge for="input-filter-6" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs"> Size </label>
                            <select data-tw-merge id="input-filter-6" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 flex-1 flex-1">
                              <option>10</option>
                              <option>25</option>
                              <option>35</option>
                              <option>50</option>
                            </select>
                          </div>
                          <div class="col-span-12 mt-3 flex items-center">
                            <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 [&amp;:hover:not(:disabled)]:bg-slate-100 [&amp;:hover:not(:disabled)]:border-slate-100 [&amp;:hover:not(:disabled)]:dark:border-darkmode-300/80 [&amp;:hover:not(:disabled)]:dark:bg-darkmode-300/80 ml-auto w-32 ml-auto w-32">Create Filter</button>
                            <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white ml-2 w-32 ml-2 w-32">Search</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flex w-full sm:w-auto">
                  <div data-tw-merge data-tw-placement="bottom-end" class="dropdown relative">
                    <button data-tw-merge data-tw-toggle="dropdown" aria-expanded="false" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer box px-2 cursor-pointer box px-2">
                      <span class="flex h-5 w-5 items-center justify-center">
                        <i data-tw-merge data-lucide="plus" class="stroke-1.5 w-5 h-5 h-4 w-4 h-4 w-4"></i>
                      </span>
                    </button>
                    <div data-transition data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                      <div data-tw-merge class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] w-40">
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">
                          <i data-tw-merge data-lucide="user" class="stroke-1.5 w-5 h-5 mr-2 h-4 w-4 mr-2 h-4 w-4"></i> Contacts </a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">
                          <i data-tw-merge data-lucide="settings" class="stroke-1.5 w-5 h-5 mr-2 h-4 w-4 mr-2 h-4 w-4"></i> Settings </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Inbox Filter -->


              <!-- BEGIN: Inbox Content -->
              <div class="intro-y box mt-5">
                @if($this->selectedEmail)
                <div class="flex flex-col-reverse border-b border-slate-200/60 p-5 text-slate-500 sm:flex-row">
                  <div class="-mx-5 mt-3 flex items-center border-t border-slate-200/60 px-5 pt-5 sm:mx-0 sm:mt-0 sm:border-0 sm:px-0 sm:pt-0">
                    <button data-tw-merge wire:click="goback()" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 [&amp;:hover:not(:disabled)]:bg-slate-100 [&amp;:hover:not(:disabled)]:border-slate-100 [&amp;:hover:not(:disabled)]:dark:border-darkmode-300/80 [&amp;:hover:not(:disabled)]:dark:bg-darkmode-300/80 ml-2 w-20 ml-2 w-20">Back</button>
                  </div>
                </div>
                @endif

                @if($this->selectedEmail)


                @else
                <div id="div4" class="flex flex-col-reverse border-b border-slate-200/60 p-5 text-slate-500 sm:flex-row">
                  <div class="-mx-5 mt-3 flex items-center border-t border-slate-200/60 px-5 pt-5 sm:mx-0 sm:mt-0 sm:border-0 sm:px-0 sm:pt-0">
                    <input data-tw-merge type="checkbox" class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 [&amp;[type=&#039;radio&#039;]]:checked:bg-primary [&amp;[type=&#039;radio&#039;]]:checked:border-primary [&amp;[type=&#039;radio&#039;]]:checked:border-opacity-10 [&amp;[type=&#039;checkbox&#039;]]:checked:bg-primary [&amp;[type=&#039;checkbox&#039;]]:checked:border-primary [&amp;[type=&#039;checkbox&#039;]]:checked:border-opacity-10 [&amp;:disabled:not(:checked)]:bg-slate-100 [&amp;:disabled:not(:checked)]:cursor-not-allowed [&amp;:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&amp;:disabled:checked]:opacity-70 [&amp;:disabled:checked]:cursor-not-allowed [&amp;:disabled:checked]:dark:bg-darkmode-800/50 border-slate-400 checked:border-primary border-slate-400 checked:border-primary" />
                    <div data-tw-merge data-tw-placement="bottom-start" class="dropdown relative ml-1">
                      <button data-tw-toggle="dropdown" aria-expanded="false" class="cursor-pointer block h-5 w-5">
                        <i data-tw-merge data-lucide="chevron-down" class="stroke-1.5 w-5 h-5 h-5 w-5 h-5 w-5"></i>
                      </button>
                      <div data-transition data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                        <div data-tw-merge class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] w-32 text-slate-800">
                          <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">All</a>
                          <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">None</a>
                          <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">Read</a>
                          <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">Unread</a>
                          <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">Starred</a>
                          <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dropdown-item">Unstarred</a>
                        </div>
                      </div>
                    </div>
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" href="#">
                      <i data-tw-merge data-lucide="refresh-cw" class="stroke-1.5 w-5 h-5 h-4 w-4 h-4 w-4"></i>
                    </a>
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" href="#">
                      <i data-tw-merge data-lucide="more-horizontal" class="stroke-1.5 w-5 h-5 h-4 w-4 h-4 w-4"></i>
                    </a>
                  </div>
                  <div class="flex items-center sm:ml-auto">
                    <div class="">1 - 50 of 5,238</div>
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" href="#">
                      <i data-tw-merge data-lucide="chevron-left" class="stroke-1.5 w-5 h-5 h-4 w-4 h-4 w-4"></i>
                    </a>
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" href="#">
                      <i data-tw-merge data-lucide="chevron-right" class="stroke-1.5 w-5 h-5 h-4 w-4 h-4 w-4"></i>
                    </a>
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" href="#">
                      <i data-tw-merge data-lucide="settings" class="stroke-1.5 w-5 h-5 h-4 w-4 h-4 w-4"></i>
                    </a>
                  </div>
                </div>
                @endif

                <div class="overflow-x-auto sm:overflow-x-visible">

                 @if($this->selectedEmail)
                  <div >
                    <div class="tab-content">
                      <div data-transition data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="content" role="tabpanel" aria-labelledby="content-tab" class="tab-pane active p-5">

                          <div class="mt-3 mb-4">
                              <div class="rounded-md border-2 border-dashed pt-4">
                                  <div class="flex flex-wrap px-4">
                                      <div class="leading-relaxed">  
                                          <!-- Display the selected email details -->
                                          <a class="text-lg font-medium" href="">{{ $selectedEmail['subject'] ?? 'No Subject' }}</a>
                                          <div class="mt-1 text-slate-500 sm:mt-0">{{ $selectedEmail['from_email'] ?? 'Unknown Sender' }}</div>
                                          <p class="mb-5">{{ $selectedEmail['body'] ?? 'No Content' }}</p>
                                      </div>
                                  </div>

                                  <!-- Check if replies exist and display them -->
                                  @if (!empty($replies))

                                      @foreach($replies as $reply)
                                          <div class="p-2 border-t border-slate-200/60">
                                              <div class="flex flex-col items-center pb-2 lg:flex-row">
                                                  <div class="flex flex-col items-center border-slate-200/60 pr-5 sm:flex-row ">
                                                      <!-- Avatar Image -->
                                                      <div class="sm:mr-5">
                                                          <div class="image-fit h-8 w-8">
                                                              <img class="rounded-full" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar" />
                                                          </div>
                                                      </div>

                                                      <!-- Reply Content -->
                                                      <div class="mr-auto mt-2 text-center sm:mt-0 sm:text-left">
                                                          <a class="text-xs font-medium" >From: {{ $reply->from_email ?? 'Unknown Sender' }}</a>

                                                          <div class="mt-4"></div>

                                                          <div class="flex w-full items-center justify-center border-b border-slate-200/60 pb-2 sm:w-auto sm:justify-start sm:border-b-0 sm:pb-0">
                                                              <div class="mr-3  text-xs ">
                                                                  {!! nl2br($reply->body ?? 'No Content') !!}
                                                              </div>
                                                          </div>
                                                          <span class="text-xs text-gray-500">{{ $reply->created_at ?? '' }}</span>

                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      @endforeach
                                  @endif
                              </div>
                          </div>




                          <div class="">
                          <div>
                            <div class="">
                                <div>
                                    <trix-toolbar id="my_toolbar"></trix-toolbar>
                                    <div class="more-stuff-inbetween"></div>

                                    <!-- Hidden input for Trix content -->
                                    <input id="my_input" type="hidden">

                                    <trix-editor toolbar="my_toolbar" input="my_input"></trix-editor>

                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

                @if($this->selectedEmail)
                @else
                        <div id="div1">
                            @php




                            @endphp

                            @foreach ($groupedEmails as $originalSubject => $emailGroup)
                                @php
                                    $originalEmail = $emailGroup->first(fn($email) => !str_starts_with(strtolower($email->subject), 're:'));
                                    $replies = $emailGroup->filter(fn($email) => str_starts_with(strtolower($email->subject), 're:'));
                                @endphp

                                @if ($originalEmail) <!-- Ensure $originalEmail is not null -->
                                <div class="intro-y" wire:click="handleViewEmail({{ $originalEmail->id }})">
                                    <div class="transition duration-200 ease-in-out transform cursor-pointer inline-block sm:block border-b border-slate-200/60 hover:scale-[1.02] hover:relative hover:z-20 hover:shadow-md hover:border-0 hover:rounded bg-white text-slate-800">
                                        <div class="flex px-5 py-3">
                                            <div class="mr-5 flex w-72 flex-none items-center">
                                                <input type="checkbox" checked class="border-slate-400 flex-none cursor-pointer rounded focus:ring-primary" />
                                                <a class="ml-4 flex h-5 w-5 items-center justify-center text-slate-400" href="#">
                                                    <i data-tw-merge data-lucide="star" class="w-5 h-5"></i>
                                                </a>
                                                <a class="ml-2 flex h-5 w-5 items-center justify-center text-slate-400" href="#">
                                                    <i data-tw-merge data-lucide="bookmark" class="w-5 h-5"></i>
                                                </a>
                                                <div class="image-fit relative ml-5 h-6 w-6 flex-none">
                                                    <img class="rounded-full" src="{{ asset('assets/img/avatar.png') }}" alt="User Avatar" />
                                                </div>
                                                <div class="ml-3 truncate font-medium">{{ $originalEmail->from_email }}</div>
                                            </div>

                                            <div class="w-64 truncate sm:w-auto">
                                                <div class="ml-3 truncate font-medium">{{ $originalSubject ?? 'No Subject' }}</div>
                                                <div class="ml-3 truncate text-gray-600">{{ Str::limit($originalEmail->body, 100, '...') }}</div>
                                            </div>

                                            <div class="pl-10 ml-auto whitespace-nowrap font-medium">
                                                {{ $replies->count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>

                    @endif

                </div>

                @if($this->selectedEmail)
                <div class="p-5 text-center ">

                  <div class="mt-2 sm:ml-auto sm:mt-0 ">
                      <div class="flex justify-between w-full">

                          <!-- Left Button Group with Dropdown -->
                          <div class="flex items-center w-2/3" >


                              <div class="relative">
                                  <select
                                      wire:model="ticket_status"
                                      class="transition duration-200 border shadow-sm py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 hover:bg-slate-100 hover:border-slate-100 dark:hover:border-darkmode-300/80 dark:hover:bg-darkmode-300/80 w-40"
                                  >
                                      <option value="">Progress Status</option>

                                      @foreach(DB::table('ticket_statuses')->whereNotIn('id', [1, 2, 3, 5, 9, 13])->get() as $status)
                                          <option value="{{ $status->status_name }}">{{ $status->status_name }}</option>
                                      @endforeach

                                  </select>
                              </div>

                              <!-- Assign Task Button -->
                              <button
                                  wire:click="set()" wire:loading.attr="disabled" wire:target="set()"
                                  class="ml-2 transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md
                              font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700
                              bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 hover:bg-slate-100 hover:border-slate-100 dark:hover:border-darkmode-300/80
                              dark:hover:bg-darkmode-300/80">

                                  <div wire:loading wire:target="set()">
                                      <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                          <circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="4"></circle>
                                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                      </svg>
                                  </div>

                                  Set Progress Status
                              </button>

                              <!-- Dropdown for Select User -->


                              <div class="relative ml-4">
                                  <select
                                      wire:model="userAssigned"
                                      class="transition duration-200 border shadow-sm py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 hover:bg-slate-100 hover:border-slate-100 dark:hover:border-darkmode-300/80 dark:hover:bg-darkmode-300/80 w-40"
                                  >
                                      <option value="">Select User</option>

                                      @foreach(\App\Models\User::all() as $user)
                                          <option value="{{ $user->id }}">L{{ $user->level }} : {{ $user->name }}</option>
                                      @endforeach

                                  </select>
                              </div>

                              <!-- Assign Task Button -->
                              <button
                                  wire:click="assign()" wire:loading.attr="disabled" wire:target="assign()"
                                  class="ml-2 transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md
                              font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700
                              bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 hover:bg-slate-100 hover:border-slate-100 dark:hover:border-darkmode-300/80
                              dark:hover:bg-darkmode-300/80">

                                  <div wire:loading wire:target="assign()">
                                      <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                          <circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="4"></circle>
                                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                      </svg>
                                  </div>

                                  Assign Task
                              </button>

                          </div>

                          <!-- Right Button Group -->
                          <div class="flex items-center w-1/3 justify-end">

                              <!-- Send Button -->
                              <button onclick="submitContent()"
                                      wire:loading.attr="disabled" wire:target="saveTrixContent()"
                                      class="ml-2 transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary
                                      focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 hover:bg-slate-100
                                      hover:border-slate-100 dark:hover:border-darkmode-300/80 dark:hover:bg-darkmode-300/80 w-20">
                                  <div wire:loading wire:target="saveTrixContent()">
                                      <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                          <circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="4"></circle>
                                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                      </svg>
                                  </div>
                                  Send
                              </button>
                          </div>

                      </div>

                  </div>
                </div>
                @endif








                    <div class="p-6 bg-white shadow-lg rounded-lg">

                        <div class="relative border-l border-gray-300 ml-4">
                            @foreach ($progress as $task)
                                <div class="mb-8 ml-6">
                                    <div class="absolute w-4 h-4 bg-{{ $task->which_is_current == 'current' ? 'blue' : 'green' }}-500 rounded-full -left-2"></div>

                                    <div class="p-4 bg-gray-100 rounded-lg shadow-sm">
                                        <p class="font-semibold text-gray-700">{{ $task->status }} (Level: {{ $task->level }})</p>
                                        <p class="text-sm text-gray-500">Assigned To: {{ DB::table('users')->where('id',$task->assigned_to_id)->value('name') }}</p>
                                        <p class="text-sm text-gray-500">Assigned By: {{ DB::table('users')->where('id',$task->assigned_by_id)->value('name') }}</p>
                                        <p class="text-sm text-gray-500">Stayed for: {{ $task->duration }} days</p>
                                        <p class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($task->created_at)->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 text-right">
                            <p class="font-bold text-gray-800">Total Time in Circulation: {{ $totalDays }} days</p>
                        </div>
                    </div>




              </div>
              <!-- END: Inbox Content -->
            </div>
          </div>

          <script>
            window.submitContent = function () {

                let content = document.getElementById('my_input').value;
                @this.saveTrixContent(content);


                //alert(content);
            };
        </script>
        </div>
