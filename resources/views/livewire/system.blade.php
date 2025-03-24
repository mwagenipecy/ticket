<div class="w-full">
@if($this->page == 1)
 <livewire:pages.dashboard />
@endif
 @if($this->page == 2)
 <livewire:pages.tickets />
@endif
    @if($this->page == 3)
        <livewire:pages.users />
    @endif
    @if($this->page == 4)
        <livewire:pages.settings />
    @endif

    @if($this->page == 5)
        <livewire:pages.profile />
    @endif



</div>
