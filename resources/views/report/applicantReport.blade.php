<x-app-layout>
    <x-slot name="title">
        <h1>Scheme Selection</h1>
    </x-slot>
    <x-slot name="content">
        <div class="container my-2">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-block">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong> {{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <livewire:ReportFilter />

        </div> {{-- container --}}
    </x-slot>
</x-app-layout>
