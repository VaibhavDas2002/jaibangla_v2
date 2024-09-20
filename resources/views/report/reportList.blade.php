<x-app-layout>
    <x-slot name="title">
        <h1>Scheme Selection</h1>
        {{-- <p>Report page by Ss</p> --}}
    </x-slot>
    <x-slot name="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            {{ __('Select Report - Scheme Wise') }}
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('report_search') }}">
                                {{ csrf_field() }}
                                <div class="form-group row{{ $errors->has('scheme') ? ' has-error' : '' }}">
                                    <div class="col-md-12 ">
                                        <p class="m-2">Select Scheme</p>
                                        <x-common.scheme-list :schemes="$schemes" class="me-2" />
                                        <p class="m-2">Select Report</p>
                                        <x-common.report-list :reports="$reports" class="me-2" />
                                        <x-button.success type="submit" class="my-3 ">
                                            Submit
                                        </x-button.success>
                                    </div>

                                    @if ($errors->has('scheme'))
                                        <span class="text-danger d-block mt-2">
                                            {{ $errors->first('scheme') }}
                                        </span>
                                    @endif
                                    <span id="error_construction" class="text-danger d-block mt-2"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
