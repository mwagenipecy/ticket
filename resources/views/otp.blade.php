<x-authentication-layout>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">
        <livewire:verify-otp/>
        </div>

    <x-jet-validation-errors class="mt-4" />
    <!-- Footer -->


</x-authentication-layout>

