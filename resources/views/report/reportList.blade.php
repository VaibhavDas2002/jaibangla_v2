<x-app-layout>
    <x-slot name="title">
        <h1>Scheme Selection</h1>
    </x-slot>
    <x-slot name="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card my-5">
                        <div class="card-header bg-secondary text-white">
                            {{ __('Select Report - Scheme Wise') }}
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="GET"
                                action="{{ route('generate_report') }}">
                                {{ csrf_field() }}


                                <div class="form-group row{{ $errors->has('scheme') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <livewire:scheme-selection />

                                        {{--
                                        <h5 class="mt-3">Select Display Type:</h5>
                                        <div class="form-group">
                                            <input type="radio" name="display_type" value="list" checked> List<br>
                                            <input type="radio" name="display_type" value="count"> Count<br>
                                        </div> --}}
                                        {{--    <p class="m-2">Select Scheme</p>
                                         <x-common.scheme-list :schemes="$schemes" class="me-2" /> - -}}
                                        <div>
                                            <x-form.select name="schemeId" id="schemeId" required>
                                                <option value="">--Select--</option>
                                                @foreach ($schemes as $arr)
                                                        <option value="{{ $arr->id }}">
                                                            {{ $arr->display_name }}
                                                        </option>

                                                @endforeach
                                            </x-form.select>
                                        </div>
                                        <p class="m-2">Select Report</p>
                                        <x-common.report-list :reports="$reports" class="me-2" /> --}}
                                        <div class="d-flex justify-content-center">
                                            <x-button.success type="submit" class="my-2 ml-5">
                                                Go To Report
                                            </x-button.success>
                                        </div>
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
