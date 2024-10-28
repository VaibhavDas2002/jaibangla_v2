<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm">
                    <div class="p-3 mb-4">
                        <h4 class="mb-0">{{ __('Select Workflow') }}</h4>
                    </div>
                    <div class="bg-light p-4 border rounded">
                        @livewire('working-flow', ['designations' => $designations, 'stepsData' => $steps, 'scheme_id' => $scheme_id])
                    </div>
                </div>
            </div>
        </div>
        
    </x-slot>
</x-app-layout>
