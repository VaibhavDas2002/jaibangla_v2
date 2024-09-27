<link href="{{ asset('css/styles/addForm.css') }}" rel="stylesheet" type="text/css" />
<x-app-layout>
    <x-slot name="title">
        <h1> Jai Bangla Form</h1>
    </x-slot>
    <x-slot name="content">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Error message -->
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Government of West Bengal Jai Bangla Pension Scheme</b></h3>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="list_personal_details" style="border:1px solid #ccc">
                                    <b>Personal Details</b>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inactive_tab1" id="list_id_details" style="border:1px solid #ccc">
                                    <b>Personal Identification Number(S)</b>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inactive_tab1" id="list_contact_details"
                                    style="border:1px solid #ccc">
                                    <b>Contact Details</b>
                                </a>
                            </li>
                            @if ($scheme_id == 17)
                                <li class="nav-item">
                                    <a class="nav-link inactive_tab1" id="list_land_details"
                                        style="border:1px solid #ccc"><b>Land Details (In case of Dwelling
                                            House)</b></a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link inactive_tab1" id="list_bank_details" style="border:1px solid #ccc">
                                    <b>Bank Account Details</b>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inactive_tab1" id="list_experience_details"
                                    style="border:1px solid #ccc">
                                    <b>Enclosure List (Self Attested)</b>
                                </a>
                            </li>
                            @if ($scheme_id == 17)
                                <li class="nav-item">
                                    <a class="nav-link inactive_tab1" id="list_additional_details"
                                        style="border:1px solid #ccc"><b>Additional Details</b></a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link inactive_tab1" id="list_decl_details" style="border:1px solid #ccc">
                                    <b>Self Declaration</b>
                                </a>
                            </li>
                        </ul>


                        @livewire('generic-form', ['scheme_id' => $scheme_id])
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('js/scripts/genericForm.js') }}"></script>
    </x-slot>

</x-app-layout>