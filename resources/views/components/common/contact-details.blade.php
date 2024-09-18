@props(['scheme_id', 'confirm_submit'])
<div class="tab-pane fade" id="contact_details">
    <div class="card">
        <div class="card-header">
            <h4><b>Contact Details</b></h4>
        </div>
        <div class="card-body">
            <div class="form-group col-12 ajax_loader" style="display:none;">
                <img src="{{ asset('images/ZKZg.gif') }}" />
            </div>
            @if (isset($scheme_id))
                <input type="hidden" id="scheme_id_perD" value="{{$scheme_id}}">
            @endif
            <div class="form-group col-12">
                <label>Permanent Address</label>
            </div>
            <br />
            <div class="row" id="per_address">
                @livewire('lgd-filter')
                <div class="mb-3 col-md-4">
                    <label for="village" class="form-label required">Village/Town/City</label>
                    <input type="text" id="village" name="village" class="form-control is-required"
                        placeholder="Village/Town/City" maxlength="300" value="{{ old('village') }}" tabindex="7">
                    <div id="error_village" class="text-danger d-none">Village/Town/City is Required</div>
                    <span id="value_village" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="house" class="form-label ">House/Premise Number</label>
                    <input type="text" id="house" name="house" class="form-control" placeholder="House/Premise No."
                        maxlength="300" value="{{ old('house') }}" tabindex="8">
                    <div id="error_house" class="text-danger"></div>
                    <span id="value_house" class="fw-medium d-none"></span>

                </div>
                <div class="mb-3 col-md-4">
                    <label for="post_office" class="form-label required">Post Office</label>
                    <input type="text" id="post_office" name="post_office" class="form-control is-required"
                        placeholder="Post Office" maxlength="300" value="{{ old('post_office') }}" tabindex="9">
                    <div id="error_post_office" class="text-danger d-none">Post Office is required</div>
                    <span id="value_post_office" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="pin_code" class="form-label required">Pin Code</label>
                    <input type="text" id="pin_code" name="pin_code" class="form-control is-required"
                        placeholder="Pin Code" maxlength="6" value="{{ old('pin_code') }}" tabindex="10">
                    <div id="error_pin_code" class="text-danger d-none">Pin Code is required</div>
                    <span id="value_pin_code" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="police_station" class="form-label required">Police Station</label>
                    <input type="text" id="police_station" name="police_station" class="form-control is-required"
                        placeholder="Police Station" maxlength="200" value="{{ old('police_station') }}" tabindex="11">
                    <div id="error_police_station" class="text-danger d-none">Police Station is Required</div>
                    <span id="value_police_station" class="fw-medium d-none"></span>
                </div>
            </div>
            <br />
            <div class="form-group col-12">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="cur_per_same" id="cur_per_same" value="1"
                        tabindex="12" @if(old('cur_per_same') == 1) checked @endif> Same as Permanent Address
                </label>


            </div>
            <br />
            <div class="row" id="cur_address">
                @livewire('lgd-filter-cur')
                <div class="mb-3 col-md-4">
                    <label for="village_cur" class="form-label required">Village/Town/City</label>
                    <input type="text" id="village_cur" name="village_cur" class="form-control is-required"
                        placeholder="Village/Town/City" maxlength="300" value="{{ old('village_cur') }}" tabindex="19">
                    <div id="error_village_cur" class="text-danger d-none">Village/Town/City is required</div>
                    <span id="value_village_cur" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="house_cur" class="form-label">House/Premise Number</label>
                    <input type="text" id="house_cur" name="house_cur" class="form-control"
                        placeholder="House/Premise No." maxlength="300" value="{{ old('house_cur') }}" tabindex="20">
                    <div id="error_house_cur" class="text-danger"></div>
                    <span id="value_house_cur" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="post_office_cur" class="form-label required">Post Office</label>
                    <input type="text" id="post_office_cur" name="post_office_cur" class="form-control is-required"
                        placeholder="Post Office" maxlength="300" value="{{ old('post_office_cur') }}" tabindex="21">
                    <div id="error_post_office_cur" class="text-danger d-none">Post office is required</div>
                    <span id="value_post_office_cur" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="pin_code_cur" class="form-label required">Pin Code</label>
                    <input type="text" id="pin_code_cur" name="pin_code_cur" class="form-control is-required"
                        placeholder="Pin Code" maxlength="6" value="{{ old('pin_code_cur') }}" tabindex="22">
                    <div id="error_pin_code_cur" class="text-danger d-none">PIN Code is Required</div>
                    <span id="value_pin_code_curr" class="fw-medium d-none"></span>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="police_station_cur" class="form-label required">Police Station</label>
                    <input type="text" id="police_station_cur" name="police_station_cur" class="form-control"
                        placeholder="Police Station" maxlength="200" value="{{ old('police_station_cur') }}"
                        tabindex="23">
                    <div id="error_police_station_cur" class="text-danger d-none">Police Station is required</div>
                    <span id="value_police_station_cur" class="fw-medium d-none"></span>
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
            <div class="d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-between">
                    <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details"
                        class="btn btn-info btn-lg">Previous</button>
                    <button type="button" name="btn_contact_details" id="btn_contact_details"
                        class="btn btn-success btn-lg ms-3">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {


        document.getElementById('btn_contact_details').addEventListener('click', function () {
            var schemeElement = document.getElementById('scheme_id_perD');
            var schemeId = schemeElement ? schemeElement.value : null;
            function handleExperienceClick(nextListId, nextDetailsId) {

                const fields = {
                    'state': 'value_state',
                    'district': 'value_district',
                    'asmb_cons': 'value_asmb_cons',
                    'urban_code': 'value_urban_code',
                    'block_urbanBody': 'value_block_urbanBody',
                    'gp_ward': 'value_gp_ward',
                    'village': 'value_village',
                    'house': 'value_house',
                    'post_office': 'value_post_office',
                    'pin_code': 'value_pin_code',
                    'police_station': 'value_police_station',
                    'state_cur': 'value_state_cur',
                    'district_cur': 'value_district_cur',
                    'asmb_cons_cur': 'value_asmb_cons_cur',
                    'urban_code_cur': 'value_urban_code_cur',
                    'block_cur': 'value_block_cur',
                    'gp_ward_cur': 'value_gp_ward_cur',
                    'village_cur': 'value_village_cur',
                    'house_cur': 'value_house_cur',
                    'post_office_cur': 'value_post_office_cur',
                    'pin_code_cur': 'value_pin_code_cur',
                    'police_station_cur': 'value_police_station_cur',
                    'residency_period': 'value_residency_period',
                    'mobile_no': 'value_mobile_no',
                    'email': 'value_email',
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
                }

                let listContactDetails = document.getElementById('list_contact_details');
                let contactDetails = document.getElementById('contact_details');
                let nextListDetails = document.getElementById(nextListId);
                let nextDetails = document.getElementById(nextDetailsId);
                if (listContactDetails && contactDetails && nextListDetails && nextDetails) {
                    listContactDetails.classList.remove('active', 'active_tab1');
                    listContactDetails.removeAttribute('href');
                    listContactDetails.removeAttribute('data-toggle');
                    contactDetails.classList.remove('active');
                    listContactDetails.classList.add('inactive_tab1');
                    nextListDetails.classList.remove('inactive_tab1');
                    nextListDetails.classList.add('active_tab1', 'active');
                    nextListDetails.setAttribute('href', '#' + nextDetailsId);
                    nextListDetails.setAttribute('data-toggle', 'tab');
                    nextDetails.classList.remove('fade');
                    nextDetails.classList.add('active', 'in');
                }
            }
            const contactDetails = document.getElementById('contact_details');
            const requiredElements = contactDetails.querySelectorAll('.is-required');
            // let hasError = false;
            // requiredElements.forEach(function (element) {
            //     const value = element.value.trim();
            //     const errorSpanId = 'error_' + element.getAttribute('id');
            //     const errorSpan = document.getElementById(errorSpanId);

            //     if (value.length === 0) {
            //         if (errorSpan) {
            //             hasError = true;
            //             errorSpan.classList.remove('d-none');
            //             errorSpan.classList.add('d-flex');
            //         }
            //     } else {
            //         if (errorSpan) {
            //             errorSpan.classList.remove('d-flex');
            //             errorSpan.classList.add('d-none');
            //         }
            //     }
            // });
            // // // Proceed to the next tab if no errors are found
            // if (!hasError) {
            if (schemeId === '17') {
                // Experience Details -> Additional Details (if schemeId is 17)
                handleExperienceClick('list_land_details', 'land_details');
            } else {
                // Experience Details -> Self Declaration (for other schemeIds)
                handleExperienceClick('list_bank_details', 'bank_details');
            }
            // }
        });



    });

    document.addEventListener('DOMContentLoaded', function () {
        var curPerSame = document.getElementById('cur_per_same');
        var districtCur = document.getElementById('district_cur');
        var asmbConsCur = document.getElementById('asmb_cons_cur');
        var urbanCodeCur = document.getElementById('urban_code_cur');
        var blockCur = document.getElementById('block_cur');
        var gpWardCur = document.getElementById('gp_ward_cur');
        var villageCur = document.getElementById('village_cur');
        var houseCur = document.getElementById('house_cur');
        var postOfficeCur = document.getElementById('post_office_cur');
        var pinCodeCur = document.getElementById('pin_code_cur');
        var policeStationCur = document.getElementById('police_station_cur');

        var district = document.getElementById('district');
        var asmbCons = document.getElementById('asmb_cons');
        var urbanCode = document.getElementById('urban_code');
        var block = document.getElementById('block_urbanBody');
        var gpWard = document.getElementById('gp_ward');
        var village = document.getElementById('village');
        var house = document.getElementById('house');
        var postOffice = document.getElementById('post_office');
        var pinCode = document.getElementById('pin_code');
        var policeStation = document.getElementById('police_station');

        function updateFields() {
            var isChecked = curPerSame.checked;
            if (isChecked) {
                districtCur.disabled = true;
                asmbConsCur.disabled = true;
                urbanCodeCur.disabled = true;
                blockCur.disabled = true;
                gpWardCur.disabled = true;
                villageCur.readOnly = true;
                houseCur.readOnly = true;
                postOfficeCur.readOnly = true;
                pinCodeCur.readOnly = true;
                policeStationCur.readOnly = true;

                districtCur.value = district.value;
                asmbConsCur.innerHTML = '';
                Array.from(asmbCons.options).forEach(function (option) {
                    var newOption = document.createElement('option');
                    newOption.value = option.value;
                    newOption.textContent = option.textContent;
                    asmbConsCur.appendChild(newOption);
                });
                asmbConsCur.value = asmbCons.value;
                urbanCodeCur.value = urbanCode.value;

                blockCur.innerHTML = '';
                Array.from(block.options).forEach(function (option) {
                    var newOption = document.createElement('option');
                    newOption.value = option.value;
                    newOption.textContent = option.textContent;
                    blockCur.appendChild(newOption);
                });
                blockCur.value = block.value;

                gpWardCur.innerHTML = '';
                Array.from(gpWard.options).forEach(function (option) {
                    var newOption = document.createElement('option');
                    newOption.value = option.value;
                    newOption.textContent = option.textContent;
                    gpWardCur.appendChild(newOption);
                });
                gpWardCur.value = gpWard.value;

                villageCur.value = village.value;
                houseCur.value = house.value;
                postOfficeCur.value = postOffice.value;
                pinCodeCur.value = pinCode.value;
                policeStationCur.value = policeStation.value;
            } else {
                districtCur.disabled = false;
                asmbConsCur.disabled = false;
                urbanCodeCur.disabled = false;
                blockCur.disabled = false;
                gpWardCur.disabled = false;
                villageCur.readOnly = false;
                houseCur.readOnly = false;
                postOfficeCur.readOnly = false;
                pinCodeCur.readOnly = false;
                policeStationCur.readOnly = false;

                districtCur.value = '';
                asmbConsCur.value = '';
                urbanCodeCur.value = '';
                blockCur.value = '';
                gpWardCur.value = '';
                villageCur.value = '';
                houseCur.value = '';
                postOfficeCur.value = '';
                pinCodeCur.value = '';
                policeStationCur.value = '';
            }
        }
        updateFields();
        curPerSame.addEventListener('change', updateFields);
    });





    // // Contact Details -> ID Details (Previous)
    document.getElementById('previous_btn_contact_details').addEventListener('click', function () {

        let listContactDetails = document.getElementById('list_contact_details');
        let contactDetails = document.getElementById('contact_details');
        let listIdDetails = document.getElementById('list_id_details');
        let idDetails = document.getElementById('id_details');

        listContactDetails.classList.remove('active', 'active_tab1');
        listContactDetails.removeAttribute('href');
        listContactDetails.removeAttribute('data-toggle');
        contactDetails.classList.remove('active', 'in');
        listContactDetails.classList.add('inactive_tab1');
        listIdDetails.classList.remove('inactive_tab1');
        listIdDetails.classList.add('active_tab1', 'active');
        listIdDetails.setAttribute('href', '#id_details');
        listIdDetails.setAttribute('data-toggle', 'tab');
        idDetails.classList.add('active', 'in');
    });
</script>