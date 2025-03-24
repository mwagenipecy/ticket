<div>
      <nav class="side-nav hidden w-[80px] overflow-x-hidden pb-16 pr-5 md:block xl:w-[230px]">
          <a class="flex items-center pt-4 pl-5 intro-x" href="">
             <img class="" style="height : 50px" src="{{ asset('assets/img/ux.png') }}" alt="" />
            <span class="hidden ml-3 text-lg text-white xl:block uppercase font-bold"> Umoja </span>
          </a>
          <div class="my-6 side-nav__divider"></div>
          <ul>
            <li class="cursor-pointer">
              <a wire:click="setMenu(1)" class="side-menu @if($this->page == 1) side-menu--active @endif">
                <div class="side-menu__icon">
                  <i data-tw-merge data-lucide="home" class="stroke-1.5 w-5 h-5"></i>
                </div>
                <div class="side-menu__title"> Dashboard </div>
              </a>
            </li>
            <li class="cursor-pointer">
              <a wire:click="setMenu(2)" class="side-menu @if($this->page == 2) side-menu--active @endif">
                <div class="side-menu__icon">
                  <i data-tw-merge data-lucide="inbox" class="stroke-1.5 w-5 h-5"></i>
                </div>
                <div class="side-menu__title"> Tickets </div>
              </a>
            </li>

              <li class="cursor-pointer">
                  <a wire:click="setMenu(3)" class=" side-menu @if($this->page == 3) side-menu--active @endif">
                      <div class="side-menu__icon">
                          <i data-tw-merge data-lucide="users" class="stroke-1.5 w-5 h-5"></i>
                      </div>
                      <div class="side-menu__title"> Users </div>
                  </a>
              </li>

              <li class="cursor-pointer">
                  <a wire:click="setMenu(4)" class=" cursor-pointer side-menu @if($this->page == 4) side-menu--active @endif">
                      <div class="side-menu__icon">
                      <i data-tw-merge data-lucide="bar-chart-2" class="stroke-1.5 w-5 h-5"></i>
                      </div>
                      <div class="side-menu__title"> Levels </div>
                  </a>
              </li>
              
              <!-- <li>
              <a wire:click="setMenu(5)" class="side-menu @if($this->page == 5) side-menu--active @endif">
                <div class="side-menu__icon">
                  <i data-tw-merge data-lucide="hard-drive" class="stroke-1.5 w-5 h-5"></i>
                </div>
                <div class="side-menu__title"> File Manager </div>
              </a>
            </li> -->

          </ul>
          
          <!-- Account and Logout Section -->
          <div class="mt-auto">
            <div class="my-6 side-nav__divider"></div>
            <ul>
              <li class="cursor-pointer">
                <a wire:click="setMenu(5)" class="side-menu cursor-pointer ">
                  <div class="side-menu__icon">
                    <i data-tw-merge data-lucide="user" class="stroke-1.5 w-5 h-5"></i>
                  </div>
                  <div class="side-menu__title"> Account </div>
                </a>
              </li>
              <li class="cursor-pointer">
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="side-menu">
                  <div class="side-menu__icon">
                    <i data-tw-merge data-lucide="log-out" class="stroke-1.5 w-5 h-5"></i>
                  </div>
                  <div class="side-menu__title"> Logout </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                  @csrf
                </form>
              </li>
            </ul>
          </div>
        </nav>
</div>