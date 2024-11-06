<x-app-layout>
    <x-slot name="title">
        <h1>Generated Report</h1>
    </x-slot>

    <x-slot name="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card my-5">
                        <div class="card-header bg-primary text-white">
                            <h5>Generated Report for {{ $scheme->scheme_name }} - {{ $report->name }}</h5>

                        </div>
                        <div class="card-body">
                            <!-- Call the Livewire component with schemeId and reportId -->
                            {{-- @livewire('report-view', ['schemeId' => $scheme->id, 'reportId' => $report->id]) --}}
                            @livewire('report-view', ['schemeId' => $scheme->id, 'reportId' => $report->id])


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
