<x-app-layout>
    <x-slot name="title">
        <h1>Scheme Selection</h1>
    </x-slot>
    <x-slot name="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            {{ __('Select Scheme') }}
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="GET" action="{{ route('workflowFrom') }}">
                                {{ csrf_field() }}
                                <div class="form-group row{{ $errors->has('scheme') ? ' has-error' : '' }}">
                                    <div class="col-md-8 d-flex align-items-center justify-content-center">
                                        <x-common.scheme-list :schemes="$schemes" class="me-2" />
                                        <x-button.success type="submit">
                                            Go
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