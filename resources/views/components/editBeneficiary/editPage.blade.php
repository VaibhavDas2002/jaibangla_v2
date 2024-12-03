<x-app-layout>
    <x-slot name="title">
        <h1>Beneficiary Edit Page</h1>
    </x-slot>
    <x-slot name="content">
        <style>
            h4 {
                padding-top: 15px;
                margin: 0px;
            }
        </style>
        <section class="content row">
            <!-- <h2>Edit Beneficiary</h2> -->

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('updateBeneficiary') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="token_id" value="{{ request('token_id') }}">
                <input type="hidden" name="beneficiary_id" value="{{ request('beneficiary_id') }}">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="">Selected Documents For Changes: </label>
                        <select name="selected_documents[]" id="selected_documents" class="form-select" multiple hidden>
                            @foreach($selectedDocuments as $document)
                            <option value="{{ $document }}" selected>{{ $document }}</option>
                            @endforeach
                        </select>

                        @foreach($selectedDocuments as $document)
                        <span value="{{ $document }}" class="badge bg-dark">{{ $document }}</span>
                        @endforeach

                    </div>
                </div>

                <div class="row">
                    @if(in_array("Aadhar Information", $selectedDocuments->toArray())) <!-- Convert Collection to Array -->
                    <!-- @php $doc = $documentDetails->get("Aadhar Information");  @endphp -->
                    <h4>Aadhar Information:</h4>
                    <div class="form-group col-md-6">
                        <label class="required-field required">Aadhar Number</label>
                        <input type="text" name="aadhar_number" id="aadhar_number" class="form-control is-required"
                            placeholder="Aadhar Number" value="{{ $beneficiary->aadhar_no }}" maxlength="12" />
                        <span id="error_aadhar_number" class="text-danger d-none">Aadhar Number is Required</span>
                    </div>
                    <div class="form-group col-md-6">
                        <!--<label class="required-field required">Attach File</label>
                         <input type="file" name="aadhar_information" id="aadhar_information" class="form-control is-required" />
                        <span id="error_aadhar_information" class="text-danger d-none">Aadhar Information is Required</span> -->
                        <!-- asda -->
                        @foreach ($documentDetails as $docKey => $docDetails)
                        @if($docKey == 'Aadhar Information')

                        <label class="required-field required">{{ $docDetails->doc_name }}</label>
                        <input type="file"
                            name="aadhar_information"
                            id="aadhar_information"
                            class="form-control is-required"
                            accept="{{ $docDetails->doc_mime_type }}"
                            data-max-size="{{ $docDetails->doc_size_kb  }}" required />
                        <span id="error_aadhar_information"
                            class="text-danger d-none">
                            Please upload a valid {{ $docDetails->doc_name }} (Max: {{ $docDetails->doc_size_kb }} KB).
                        </span>

                        @endif
                        @endforeach
                        <!-- // -->
                    </div>
                    @endif
                </div>

                <div class="row">
                    @if(in_array("Ration Card Information", $selectedDocuments->toArray())) <!-- Check if "Ration Card Information" is selected -->
                    <h4>Ration Card Information:</h4>

                    <div class="form-group col-md-4">
                        <label class="required-field required">Ration Card Category</label>
                        <select name="ration_card_cat" id="ration_card_cat" class="form-control">
                            @foreach(config('constants.ration_cat') as $key => $value)
                            <option value="{{ $key }}" {{ $beneficiary->ration_card_cat == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required-field required">Ration Card Number</label>
                        <input type="text" name="ration_card_no" id="ration_card_no" class="form-control"
                            placeholder="Ration Card Number" value="{{ $beneficiary->ration_card_no }}" />
                        <span id="error_ration_card_no" class="text-danger d-none">Ration Card Number is Required</span>
                    </div>
                    <div class="form-group col-md-4">
                        <!-- <label class="required-field required">Attach File</label>
                        <input type="file" name="ration_card_information" id="ration_card_information" class="form-control is-required" />
                        <span id="error_ration_card_information" class="text-danger d-none">File is Required</span> -->
                        @foreach ($documentDetails as $docKey => $docDetails)
                        @if($docKey == 'Ration Card Information')

                        <label class="required-field required">{{ $docDetails->doc_name }}</label>
                        <input type="file"
                            name="ration_card_information"
                            id="ration_card_information"
                            class="form-control is-required"
                            accept="{{ $docDetails->doc_mime_type }}"
                            data-max-size="{{ $docDetails->doc_size_kb  }}" required />
                        <span id="error_ration_card_information"
                            class="text-danger d-none">
                            Please upload a valid {{ $docDetails->doc_name }} (Max: {{ $docDetails->doc_size_kb }} KB).
                        </span>

                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="row">
                    @if(in_array("Caste Certificate Information", $selectedDocuments->toArray()))
                    <h4>Caste Certificate Information: </h4>
                    <div class="form-group col-md-4">
                        <label class="required-field required">Caste</label>
                        <select name="caste" id="caste" class="form-control">
                            @foreach(config('constants.caste_lb') as $key => $value)
                            <option value="{{ $key }}" {{ trim($beneficiary->caste) == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required-field required">Caste Certificate Number</label>
                        <input type="text" name="caste_certificate_no" id="caste_certificate_no" class="form-control"
                            placeholder="Caste Certificate Number" value="{{ $beneficiary->caste_certificate_no }}" />
                    </div>
                    <div class="form-group col-md-4">
                        <!-- <label class="required-field required">Attach File</label>
                        <input type="file" name="caste_certificate_information" id="caste_certificate_information" class="form-control is-required" />
                        <span id="error_caste_certificate_information" class="text-danger d-none">File is Required</span> -->
                        @foreach ($documentDetails as $docKey => $docDetails)
                        @if($docKey == 'Caste Certificate Information')

                        <label class="required-field required">{{ $docDetails->doc_name }}</label>
                        <input type="file"
                            name="caste_certificate_information"
                            id="caste_certificate_information"
                            class="form-control is-required"
                            accept="{{ $docDetails->doc_mime_type }}"
                            data-max-size="{{ $docDetails->doc_size_kb  }}" required />
                        <span id="error_caste_certificate_information"
                            class="text-danger d-none">
                            Please upload a valid {{ $docDetails->doc_name }} (Max: {{ $docDetails->doc_size_kb }} KB).
                        </span>

                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="row">
                    @if(in_array("Mobile No.", $selectedDocuments->toArray())) <!-- Convert Collection to Array -->
                    <h4>Contact Information:</h4>
                    <div class="form-group col-md-6">
                        <label class="required-field required">Mobile Number</label>
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control is-required"
                            placeholder="Mobile Number" value="{{ $beneficiary->mobile_no }}" maxlength="10" />
                        <span id="error_mobile_number" class="text-danger d-none">Mobile Number is Required</span>
                    </div>
                    @endif
                </div>

                <div class="row">
                    @if(in_array("Name", $selectedDocuments->toArray())) <!-- Convert Collection to Array -->
                    <h4>Name:</h4>
                    <div class="form-group col-md-4">
                        <label class="required-field required">First Name</label>
                        <input type="text" name="ben_fname" id="ben_fname" class="form-control is-required"
                            placeholder="First Name" value="{{ $beneficiary->ben_fname }}" />
                        <span id="error_ben_fname" class="text-danger d-none">First Name is Required</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="">Middle Name</label>
                        <input type="text" name="ben_mname" id="ben_mname" class="form-control"
                            placeholder="Middle Name" value="{{ $beneficiary->ben_mname }}" />
                        <span id="error_ben_mname" class="text-danger d-none">Middle Name is Required</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required-field required">Last Name</label>
                        <input type="text" name="ben_lname" id="ben_lname" class="form-control is-required"
                            placeholder="Last Name" value="{{ $beneficiary->ben_lname }}" />
                        <span id="error_ben_lname" class="text-danger d-none">Last Name is Required</span>
                    </div>
                    @endif
                </div>

                @if(in_array("Bank Information", $selectedDocuments->toArray())) <!-- Convert Collection to Array -->
                <h4>Bank Information:</h4>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required-field required">IFS Code</label>
                        <input type="text" name="bank_ifsc_code" id="bank_ifsc_code" class="form-control special-char is-required"
                            placeholder="IFSC Code" onkeyup="this.value = this.value.toUpperCase();"
                            value="{{ $beneficiary->bank_ifsc }}" maxlength="11" tabindex="1" />
                        <span id="error_bank_ifsc_code" class="text-danger d-none">IFS Code is Required</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="required-field required">Bank Name</label>
                        <input type="text" name="name_of_bank" id="name_of_bank" class="form-control special-char is-required"
                            placeholder="Bank Name" value="{{ $beneficiary->bank_name }}" maxlength="200" tabindex="1" />
                        <span id="error_name_of_bank" class="text-danger d-none">Bank Name is Required</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required-field required">Bank Branch Name</label>
                        <input type="text" name="bank_branch" id="bank_branch" class="form-control is-required" placeholder="Bank Branch Name"
                            value="{{ $beneficiary->branch_name }}" maxlength="300" tabindex="2" />
                    </div>

                    <div class="form-group col-md-6">
                        <label class="required-field required">Bank Account Number</label>
                        <input type="text" name="bank_account_number" id="bank_account_number" class="form-control NumOnly is-required"
                            placeholder="Bank Account No" value="{{ $beneficiary->bank_code }}" maxlength="16" tabindex="4" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <!-- <label class="required-field required">Attach File</label>
                        <input type="file" name="bank_information" id="bank_information" class="form-control is-required" />
                        <span id="error_bank_information" class="text-danger d-none">File is Required</span> -->
                        @foreach ($documentDetails as $docKey => $docDetails)
                        @if($docKey == 'Bank Information')

                        <label class="required-field required">{{ $docDetails->doc_name }}</label>
                        <input type="file"
                            name="bank_information"
                            id="bank_information"
                            class="form-control is-required"
                            accept="{{ $docDetails->doc_mime_type }}"
                            data-max-size="{{ $docDetails->doc_size_kb  }}" required />
                        <span id="error_bank_information"
                            class="text-danger d-none">
                            Please upload a valid {{ $docDetails->doc_name }} (Max: {{ $docDetails->doc_size_kb }} KB).
                        </span>

                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <button type="submit" class="btn btn-primary mt-3 mx-auto">Save Changes</button>
            </form>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function validateFileInput(event, docType) {
                var file = event.target.files[0];
                var maxSize = event.target.getAttribute('data-max-size');
                var rawAllowedTypes = event.target.getAttribute('accept');
                var allowedTypes = rawAllowedTypes.split(',').map(type => type.trim());

                // Validate file type
                if (!allowedTypes.includes(file.type)) {
                    $('#error_' + docType)
                        .text('Invalid file type. Allowed types: ' + allowedTypes.join(', '))
                        .removeClass('d-none');
                    $(event.target).val(''); // Clear the input
                    return;
                } else if (file && file.size > maxSize * 1024) { // Convert KB to bytes
                    $('#error_' + docType).text('File size is too large. Maximum size is ' + maxSize + ' KB.').removeClass('d-none');
                    $(event.target).val(''); // Clear the input
                    return;
                }
                $('#error_' + docType).addClass('d-none');
            }

            // // Attach event listeners for all file inputs
            $('#bank_information').on('change', function(event) {
                validateFileInput(event, 'bank_information');
            });

            $('#caste_certificate_information').on('change', function(event) {
                validateFileInput(event, 'caste_certificate_information');
            });

            $('#ration_card_information').on('change', function(event) {
                validateFileInput(event, 'ration_card_information');
            });

            $('#aadhar_information').on('change', function(event) {
                validateFileInput(event, 'aadhar_information');
            });
        </script>
    </x-slot>
</x-app-layout>