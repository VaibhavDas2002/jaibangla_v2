<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm">
                    <div class="p-3 mb-4">
                        <h4 class="mb-0">{{ __('User Management') }}</h4>
                    </div>
                    <div class="bg-light p-4 border rounded">
                        <livewire:edit-user :userId="$id" />
                        {{-- Remove this line since you're already passing userId above --}}
                        {{-- @livewire('edit-user') --}}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
