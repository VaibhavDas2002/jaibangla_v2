@props(['scheme_id', 'confirm_submit'])
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
            <p>{{$confirm_submit}}</p>
            <div class="mb-3">
                <label class="form-label required-field"><b>Application Type: </b></label>
                <select class="form-select" name="entry_type" id="entry_type" onchange="durareSarkarForm()">
                    <option value="1">Normal Form</option>
                    <option value="2">Form through Duare Sarkar camp</option>
                </select>
                <span id="error_entry_type error" class="text-danger d-none">Enter the application Type</span>
                <span id="value_entry_type" class="fw-medium d-none"></span>
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
                        value="{{ old('ds_registration_no') }}" />
                    <span id="error_ds_registration_no" class="text-danger d-none">Enter the registration no </span>
                    <span id="value_ds_registration_no" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Duare Sarkar Date</label>
                    <input type="date" name="ds_date" id="ds_date" class="form-control"
                        max="<?php echo date('Y-m-d'); ?>" value="{{ old('ds_date') }}" />
                    <span id="error_ds_date" class="text-danger d-none"> Enter the Date</span>
                    <span id="value_ds_date" class="fw-medium d-none"></span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Beneficiary Name</label>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control is-required txtOnly"
                        placeholder="First Name" maxlength="200" value="{{ old('first_name') }}" />
                    <span id="error_first_name" class="text-danger d-none">First Name is required</span>
                    <span id="value_first_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label ">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('middle_name') }}" />
                    <span id="error_middle_name" class="text-danger"></span>
                    <span id="value_middle_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control is-required txtOnly"
                        placeholder="Last Name" maxlength="200" value="{{ old('last_name') }}" />
                    <span id="error_last_name" class="text-danger d-none">Last Name is Required</span>
                    <span id="value_last_name" class="fw-medium d-none"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Gender</label>
                    <select class="form-select is-required" name="gender" id="gender">
                        <option value="">--Select--</option>
                        @foreach(Config::get('constants.gender') as $key => $val)
                            <option value="{{ $key }}" @if(old('gender') == $key) selected @endif>{{ $val }}</option>
                        @endforeach
                    </select>
                    <span id="error_gender" class="text-danger d-none">Gender is required</span>
                    <span id="value_gender" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control is-required" value="{{ old('dob') }}" />
                    <span id="error_dob" class="text-danger d-none">Date of Birth is required</span>
                    <span id="error_dob_year" class="text-danger d-none">Appropriate Year is Required</span>
                    <span id="value_dob" class="fw-medium d-none"></span>
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
                        value="{{ old('father_first_name') }}" />
                    <span id="error_father_first_name" class="text-danger d-none">Father First Name is Required</span>
                    <span id="value_father_first_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="father_middle_name" id="father_middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('father_middle_name') }}" />
                    <span id="error_father_middle_name" class="text-danger"></span>
                    <span id="value_father_middle_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Last Name</label>
                    <input type="text" name="father_last_name" id="father_last_name"
                        class="form-control is-required txtOnly" placeholder="Last Name" maxlength="200"
                        value="{{ old('father_last_name') }}" />
                    <span id="error_father_last_name" class="text-danger d-none">Father Last Name is required</span>
                    <span id="value_father_last_name" class="fw-medium d-none"></span>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mother's Name</label>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field">First Name</label>
                    <input type="text" name="mother_first_name" id="mother_first_name" class="form-control txtOnly"
                        placeholder="First Name" maxlength="200" value="{{ old('mother_first_name') }}" />
                    <span id="error_mother_first_name" class="text-danger"></span>
                    <span id="value_mother_first_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="mother_middle_name" id="mother_middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('mother_middle_name') }}" />
                    <span id="error_mother_middle_name" class="text-danger"></span>
                    <span id="value_mother_middle_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field">Last Name</label>
                    <input type="text" name="mother_last_name" id="mother_last_name" class="form-control txtOnly"
                        placeholder="Last Name" maxlength="200" value="{{ old('mother_last_name') }}" />
                    <span id="error_mother_last_name" class="text-danger"></span>
                    <span id="value_mother_last_name" class="fw-medium d-none"></span>
                </div>
            </div>
            @if ($scheme_id == 1 || $schemeId == 3)

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-field required">Caste</label>
                        <select class="form-select is-required" name="caste_category" id="caste_category" readonly>
                            @foreach($casteOptions as $key => $val)
                                <option value="{{ $key }}" selected>{{ $val }}</option>
                            @endforeach
                        </select>
                        <span id="error_caste_category" class="text-danger d-none">Caste is Required</span>
                        <span id="value_caste_category" class="fw-medium d-none"></span>
                    </div>

                    <div class="col-md-4 mb-3" id="caste_certificate_no_section">
                        <label class="form-label required-field required">Caste Certificate No.</label>
                        <input type="text" name="caste_certificate_no" id="caste_certificate_no"
                            class="form-control is-required" placeholder="Caste Certificate No." maxlength="200"
                            value="{{ old('caste_certificate_no') }}" />
                        <span id="error_caste_certificate_no" class="text-danger d-none">Caste Certificate is
                            Required</span>
                        <span id="value_caste_certificate_no" class="fw-medium d-none"></span>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field required">Marital Status</label>
                    <select class="form-select is-required" name="marital_status" id="marital_status"
                        onchange="spouseDetails()">
                        <option value="">--Select--</option>
                        @foreach(Config::get('constants.marital_status') as $key => $val)
                            <option value="{{ $key }}" @if(old('marital_status') == $key) selected @endif>{{ $val }}</option>
                        @endforeach
                    </select>
                    <span id="error_marital_status" class="text-danger d-none">Maritial Status is Required</span>
                    <span id="value_marital_status" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required-field">Monthly Family Income (In Rs)</label>
                    <input type="text" name="monthly_income" id="monthly_income" class="form-control NumOnly"
                        placeholder="Monthly Family Income (Rs.)" maxlength="9" value="{{ old('monthly_income') }}" />
                    <span id="error_monthly_income" class="text-danger"></span>
                    <span id="value_monthly_income" class="fw-medium d-none"></span>
                </div>
            </div>
            <div class="row maratial d-none" id="spouse_section">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Spouse Name (if applicable)</label>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">First Name</label>
                    <input type="text" name="spouse_first_name" id="spouse_first_name" class="form-control txtOnly"
                        placeholder="First Name" maxlength="200" value="{{ old('spouse_first_name') }}" />
                    <span id="error_spouse_first_name" class="text-danger d-none">Spouse First Name Required</span>
                    <span id="value_spouse_first_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="spouse_middle_name" id="spouse_middle_name" class="form-control txtOnly"
                        placeholder="Middle Name" maxlength="100" value="{{ old('spouse_middle_name') }}" />
                    <span id="error_spouse_middle_name" class="text-danger"></span>
                    <span id="value_spouse_middle_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Last Name</label>
                    <input type="text" name="spouse_last_name" id="spouse_last_name" class="form-control txtOnly"
                        placeholder="Last Name" maxlength="200" value="{{ old('spouse_last_name') }}" />
                    <span id="error_spouse_last_name" class="text-danger d-none">Spouse Last Name Required</span>
                    <span id="value_spouse_last_name" class="fw-medium d-none"></span>
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
            // const personalDetailsDiv = document.getElementById('personal_details');
            // if (!personalDetailsDiv) return;
            // const requiredElements = personalDetailsDiv.querySelectorAll('.is-required');
            // let hasError = false;
            // const dobValue = document.getElementById('dob').value;
            // const errorDobYear = document.getElementById('error_dob_year');
            // requiredElements.forEach(function (element) {
            //     const value = element.value.trim();
            //     const errorSpanId = 'error_' + element.getAttribute('id');
            //     const errorSpan = document.getElementById(errorSpanId);
            //     if (value.length === 0) {
            //         hasError = true;
            //         errorSpan.classList.remove('d-none');
            //         errorSpan.classList.add('d-flex');
            //     } else {
            //         if (errorSpan) {
            //             errorSpan.classList.remove('d-flex');
            //             errorSpan.classList.add('d-none');
            //         }
            //         if (dobValue) {
            //             const dobDate = new Date(dobValue);
            //             const year = dobDate.getFullYear();
            //             if (year < 1900 || year > 2000) {
            //                 hasError = true;
            //                 errorDobYear.classList.remove('d-none');
            //                 errorDobYear.classList.add('d-flex');
            //             } else {
            //                 hasError = false;
            //                 errorDobYear.classList.remove('d-flex');
            //                 errorDobYear.classList.add('d-none');
            //             }
            //         }
            //     }
            // });
            // if (!hasError) {
            // Mapping of input/select IDs to span IDs

            // if (confirm_submit_code === 0) {
            const fields = {
                'entry_type': 'value_entry_type',
                'ds_registration_no': 'value_ds_registration_no',
                'ds_date': 'value_ds_date',
                'first_name': 'value_first_name',
                'middle_name': 'value_middle_name',
                'last_name': 'value_last_name',
                'gender': 'value_gender',
                'dob': 'value_dob',
                'father_first_name': 'value_father_first_name',
                'father_middle_name': 'value_father_middle_name',
                'father_last_name': 'value_father_last_name',
                'mother_first_name': 'value_mother_first_name',
                'mother_middle_name': 'value_mother_middle_name',
                'mother_last_name': 'value_mother_last_name',
                'caste_category': 'value_caste_category',
                'caste_certificate_no': 'value_caste_certificate_no',
                'marital_status': 'value_marital_status',
                'monthly_income': 'value_monthly_income',
                'spouse_first_name': 'value_spouse_first_name',
                'spouse_middle_name': 'value_spouse_middle_name',
                'spouse_last_name': 'value_spouse_last_name'
            };

            // Function to update span text content
            function updateSpan(id, value) {
                const span = document.getElementById(id);
                if (span) {
                    span.textContent = value;
                }
            }

            // Function to get value from <select> or <input> element
            function getValue(element) {
                if (!element) return '';
                if (element.tagName === 'SELECT') {
                    const selectedOption = element.options[element.selectedIndex];
                    return selectedOption ? selectedOption.textContent : '';
                }
                return element.value;
            }

            // Update spans based on input/select values
            for (const [inputId, spanId] of Object.entries(fields)) {
                const input = document.getElementById(inputId);
                const value = getValue(input);
                updateSpan(spanId, value);
                // }
            }


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


            // }
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

        if (entryType === '2') {
            duareSarkarSection.classList.remove('d-none');
            duareSarkarSection.classList.add('d-flex');

            dsRegistrationNo.classList.add('is-required');
            dsDate.classList.add('is-required');
        } else {
            duareSarkarSection.classList.remove('d-flex');
            duareSarkarSection.classList.add('d-none');
            dsRegistrationNo.classList.remove('is-required');
            dsDate.classList.remove('is-required');
        }
    }
</script>