@props(['scheme_id', 'confirm_submit', 'ds_phases'])
@php
    $schemeId = $scheme_id ?? null;
    $casteOptions = [];

    if ($schemeId == 10 || $schemeId == 17) {
        $casteOptions = ['General' => 'General'];
    } elseif ($schemeId == 3) {
        $casteOptions = ['SC' => 'SC'];
    } elseif ($schemeId == 1) {
        $casteOptions = ['ST' => 'ST'];
    }

@endphp
<div class="tab-pane active" id="personal_details">
    <div class="card">
        <div class="card-header">
            <h4><b>Personal Details</b></h4>
        </div>
        <div class="card-body">
            <input type="hidden" id="scheme_id" name="scheme_id" value="{{$scheme_id}}" wire:model="scheme_id" />
            @error('scheme_id') <span class="error">{{ $message }}</span> @enderror
            <div class="mb-3">
                <label class="form-label required"><b>Application Type: </b></label>
                <select class="form-select" name="entry_type" id="entry_type" onchange="durareSarkarForm()"
                    wire:model="entry_type">
                    <option value="1">Normal Form</option>
                    <option value="2">Form through Duare Sarkar camp</option>
                </select>
                <span id="error_entry_type error" class="text-danger d-none">Enter the application Type</span>
                @error('entry_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <h5 class="h5">For <b>Duare Sarkar</b> entry please select from the dropdown
                    <i><b>"Form through Duare Sarkar camp"</b></i>
                </h5>
            </div>
            <div class="row duareSarkar d-none" id="duareSarkar_section">
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Duare Sarkar Registration No.</label>
                    <input type="text" name="ds_registration_no" id="ds_registration_no" class="form-control"
                        placeholder="Duare Sarkar Registration No." maxlength="25"
                        value="{{ old('ds_registration_no') }}" wire:model="ds_registration_no" />
                    <span id="error_ds_registration_no" class="text-danger d-none">Enter the registration no </span>
                    @error('ds_registration_no') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Duare Sarkar Date</label>
                    <input type="date" name="ds_date" id="ds_date" class="form-control"
                        max="<?php echo date('Y-m-d'); ?>" value="{{ old('ds_date') }}" wire:model="ds_date" />
                    <span id="error_ds_date" class="text-danger d-none"> Enter the Date</span>
                    @error('ds_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Duare Sarkar Phase</label>
                    <select class="form-select" name="ds_phase" id="ds_phase">
                        <option value="">Select Phase</option>
                        @foreach ($ds_phases as $ds_phase)
                            <option value="{{$ds_phase->phase_code}}">{{$ds_phase->phase_des}}</option>
                        @endforeach
                    </select>
                    <span id="error_ds_phase" class="text-danger d-none">Select the Phase </span>
                    @error('ds_phase') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Beneficiary Name</label>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control is-required txtOnly"
                        placeholder="First Name" maxlength="200" value="{{ old('first_name') }}"
                        wire:model="first_name" />
                    <span id="error_first_name" class="text-danger d-none">First Name is required</span>
                    @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label ">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('middle_name') }}"
                        wire:model="middle_name" />
                    <span id="error_middle_name" class="text-danger"></span>
                    @error('middle_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control is-required txtOnly"
                        placeholder="Last Name" maxlength="200" value="{{ old('last_name') }}" wire:model="last_name" />
                    <span id="error_last_name" class="text-danger d-none">Last Name is Required</span>
                    @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Gender</label>
                    <select class="form-select is-required" name="gender" id="gender" wire:model="gender">
                        <option value="">--Select--</option>
                        @foreach(Config::get('constants.gender') as $key => $val)
                            <option value="{{ $key }}" @if(old('gender') == $key) selected @endif>{{ $val }}</option>
                        @endforeach
                    </select>
                    <span id="error_gender" class="text-danger d-none">Gender is required</span>
                    @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control is-required" value="{{ old('dob') }}"
                        wire:model="dob" />
                    <span id="error_dob" class="text-danger d-none">Date of Birth is required</span>
                    <span id="error_dob_year" class="text-danger d-none">Appropriate Year is Required</span>
                    @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Age as on <span id="current_date"></span></label>
                    <!-- <span class="form-control"></span> -->
                    <span class="age-box p-2 border rounded bg-light text-dark text-center" id="txt_age"></span>

                </div>


            </div>
            <div class="mb-3">
                <label class="form-label">Father's Name</label>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">First Name</label>
                    <input type="text" name="father_first_name" id="father_first_name"
                        class="form-control is-required txtOnly" placeholder="First Name" maxlength="200"
                        value="{{ old('father_first_name') }}" wire:model="father_first_name" />
                    <span id="error_father_first_name" class="text-danger d-none">Father First Name is Required</span>
                    @error('father_first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="father_middle_name" id="father_middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('father_middle_name') }}"
                        wire:model="father_middle_name" />
                    <span id="error_father_middle_name" class="text-danger"></span>
                    @error('father_middle_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Last Name</label>
                    <input type="text" name="father_last_name" id="father_last_name"
                        class="form-control is-required txtOnly" placeholder="Last Name" maxlength="200"
                        value="{{ old('father_last_name') }}" wire:model="father_last_name" />
                    <span id="error_father_last_name" class="text-danger d-none">Father Last Name is required</span>
                    @error('father_last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mother's Name</label>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="mother_first_name" id="mother_first_name" class="form-control txtOnly"
                        placeholder="First Name" maxlength="200" value="{{ old('mother_first_name') }}"
                        wire:model="mother_first_name" />
                    <span id="error_mother_first_name" class="text-danger"></span>
                    @error('mother_first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="mother_middle_name" id="mother_middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('mother_middle_name') }}"
                        wire:model="mother_middle_name" />
                    <span id="error_mother_middle_name" class="text-danger"></span>
                    @error('mother_middle_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="mother_last_name" id="mother_last_name" class="form-control txtOnly"
                        placeholder="Last Name" maxlength="200" value="{{ old('mother_last_name') }}"
                        wire:model="mother_last_name" />
                    <span id="error_mother_last_name" class="text-danger"></span>
                    @error('mother_last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Caste</label>
                    <select class="form-select is-required" name="caste_category" id="caste_category" wire:model="caste_category">
                        @foreach($casteOptions as $key => $val)
                            <option value="{{ $key }}" selected>{{ $val }}</option>
                        @endforeach
                    </select>
                    <span id="error_caste_category" class="text-danger d-none">Caste is Required</span>
                    @error('caste_cat') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if ($scheme_id == 1 || $schemeId == 3)
                    <div class="col-md-4 mb-3" id="caste_certificate_no_section">
                        <label class="form-label required-field required">Caste Certificate No.</label>
                        <input type="text" name="caste_certificate_no" id="caste_certificate_no"
                            class="form-control is-required" placeholder="Caste Certificate No." maxlength="200"
                            value="{{ old('caste_certificate_no') }}" wire:model="caste_certificate_no" />
                        <span id="error_caste_certificate_no" class="text-danger d-none">Caste Certificate is
                            Required</span>
                        @error('caste_certificate_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Marital Status</label>
                    <select class="form-select is-required" name="marital_status" id="marital_status"
                        onchange="spouseDetails()" wire:model="maratial_status">
                        <option value="">--Select--</option>
                        @foreach(Config::get('constants.marital_status') as $key => $val)
                            <option value="{{ $key }}" @if(old('marital_status') == $key) selected @endif>{{ $val }}</option>
                        @endforeach
                    </select>
                    <span id="error_marital_status" class="text-danger d-none">Maritial Status is Required</span>
                    @error('maraital_status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Monthly Family Income (In Rs)</label>
                    <input type="text" name="monthly_income" id="monthly_income"
                        class="form-control is-required NumOnly" placeholder="Monthly Family Income (Rs.)" maxlength="9"
                        value="{{ old('monthly_income') }}" wire:model="monthly_income" />
                    <span id="error_monthly_income" class="text-danger d-none">Monthly Income is Required</span>
                    @error('monthly_income') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row maratial d-none" id="spouse_section">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Spouse Name (if applicable)</label>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">First Name</label>
                    <input type="text" name="spouse_first_name" id="spouse_first_name" class="form-control txtOnly"
                        placeholder="First Name" maxlength="200" value="{{ old('spouse_first_name') }}"
                        wire:model="spouse_first_name" />
                    <span id="error_spouse_first_name" class="text-danger d-none">Spouse First Name Required</span>
                    @error('spouse_first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="spouse_middle_name" id="spouse_middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('spouse_middle_name') }}"
                        wire:model="spouse_middle_name" />
                    <span id="error_spouse_middle_name" class="text-danger"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Last Name</label>
                    <input type="text" name="spouse_last_name" id="spouse_last_name" class="form-control txtOnly"
                        placeholder="Last Name" maxlength="200" value="{{ old('spouse_last_name') }}"
                        wire:model="spouse_last_name" />
                    <span id="error_spouse_last_name" class="text-danger d-none">Spouse Last Name Required</span>
                    @error('spouse_last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="residency_period" class="form-label">Number of years Dwelling in WB</label>
                    <input type="text" id="residency_period" name="residency_period" class="form-control" maxlength="3"
                        placeholder="Number of years Dwelling in WB" value="{{ old('residency_period') }}"
                        tabindex="24">
                    <div id="error_residency_period" class="text-danger"></div>
                    <span id="value_residency_period" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="mobile_no" class="form-label required">Mobile Number</label>
                    <input type="text" id="mobile_no" name="mobile_no" class="form-control is-required"
                        placeholder="Mobile No" maxlength="10" value="{{ old('mobile_no') }}" tabindex="25">
                    <div id="error_mobile_no" class="text-danger d-none">Mobile Number is required</div>
                    <span id="value_mobile_no" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="email" class="form-label">Email Id</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email Id."
                        maxlength="200" value="{{ old('email') }}" tabindex="26">
                    <div id="error_email" class="text-danger"></div>
                    <span id="value_email" class="fw-medium d-none"></span>
                </div>
            </div>

            <div class="text-center">
                <button type="button" name="btn_personal_details" id="btn_personal_details"
                    class="btn btn-success btn-lg">Next</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/scripts/keyRestrict.js')}}"></script>
<script>


    document.addEventListener('DOMContentLoaded', function () {

        function validatePersonalDetails() {
            const personalDetailsDiv = document.getElementById('personal_details');
            if (!personalDetailsDiv) return;
            const requiredElements = personalDetailsDiv.querySelectorAll('.is-required');
            let hasError = false;
            const dobValue = document.getElementById('dob').value;
            const errorDobYear = document.getElementById('error_dob_year');
            requiredElements.forEach(function (element) {
                const value = element.value.trim();
                const errorSpanId = 'error_' + element.getAttribute('id');
                const errorSpan = document.getElementById(errorSpanId);
                if (value.length === 0) {
                    hasError = true;
                    errorSpan.classList.remove('d-none');
                    errorSpan.classList.add('d-flex');
                } else {
                    if (errorSpan) {
                        errorSpan.classList.remove('d-flex');
                        errorSpan.classList.add('d-none');
                    }
                    if (dobValue) {
                        const dobDate = new Date(dobValue);
                        const year = dobDate.getFullYear();
                        if (year < 1900 || year > 2000) {
                            hasError = true;
                            errorDobYear.classList.remove('d-none');
                            errorDobYear.classList.add('d-flex');
                        } else {
                            hasError = false;
                            errorDobYear.classList.remove('d-flex');
                            errorDobYear.classList.add('d-none');
                        }
                    }
                }
            });
            console.log('Before:', hasError);
            if (!hasError) {
                // Mapping of input/select IDs to span IDs
                console.log('After:', hasError);
                let listPersonalDetails = document.getElementById('list_personal_details');
                let personalDetails = document.getElementById('personal_details');
                let listIdDetails = document.getElementById('list_id_details');
                let idDetails = document.getElementById('id_details');

                if (listPersonalDetails && personalDetails && listIdDetails && idDetails) {
                    listPersonalDetails.classList.remove('active', 'active_tab1');
                    listPersonalDetails.removeAttribute('href');
                    listPersonalDetails.removeAttribute('data-toggle');
                    personalDetails.classList.remove('active');
                    listPersonalDetails.classList.add('inactive_tab1');
                    listIdDetails.classList.remove('inactive_tab1');
                    listIdDetails.classList.add('active_tab1', 'active');
                    listIdDetails.setAttribute('href', '#id_details');
                    listIdDetails.setAttribute('data-toggle', 'tab');
                    idDetails.classList.add('active', 'in');
                    idDetails.classList.remove('fade');
                    personalDetails.classList.add('fade');
                }


            }
        }
        document.getElementById('btn_personal_details').addEventListener('click', validatePersonalDetails);
    });





    document.addEventListener('DOMContentLoaded', function () {
        const dobInput = document.getElementById('dob');
        const ageSpan = document.getElementById('txt_age');
        const currentDateSpan = document.getElementById('current_date');
        const today = new Date();

        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const year = today.getFullYear();
        const formattedDate = `${day}/${month}/${year}`;
        currentDateSpan.textContent = formattedDate;

        const calculateAge = (dob) => {
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            const dayDiff = today.getDate() - dob.getDate();

            if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                age--;
            }

            return age > 0 ? age : 0;
        };

        dobInput.addEventListener('input', function () {
            const dob = new Date(this.value);
            ageSpan.textContent = !isNaN(dob) ? calculateAge(dob) : '';
        });
    });

    function spouseDetails() {
        const maritalStatus = document.getElementById('marital_status').value;
        const spouseSection = document.getElementById('spouse_section');
        const spouseFirstName = document.getElementById('spouse_first_name');
        const spouseLastName = document.getElementById('spouse_last_name');

        if (maritalStatus === 'Married') {
            spouseSection.classList.remove('d-none');
            spouseSection.classList.add('d-flex');

            spouseFirstName.classList.add('is-required');
            spouseLastName.classList.add('is-required');
        } else {
            spouseSection.classList.remove('d-flex');
            spouseSection.classList.add('d-none');
            spouseFirstName.classList.remove('is-required');
            spouseLastName.classList.remove('is-required');
        }
    }

    function durareSarkarForm() {
        const entryType = document.getElementById('entry_type').value;
        const duareSarkarSection = document.getElementById('duareSarkar_section');
        const dsRegistrationNo = document.getElementById('ds_registration_no');
        const dsDate = document.getElementById('ds_date');
        const dsPhase = document.getElementById('ds_phase');

        if (entryType === '2') {
            duareSarkarSection.classList.remove('d-none');
            duareSarkarSection.classList.add('d-flex');

            dsRegistrationNo.classList.add('is-required');
            dsDate.classList.add('is-required');
            dsPhase.classList.add('is-required');
        } else {
            duareSarkarSection.classList.remove('d-flex');
            duareSarkarSection.classList.add('d-none');

            dsRegistrationNo.classList.remove('is-required');
            dsDate.classList.remove('is-required');
            dsPhase.classList.remove('is-required');
        }
    }
</script>