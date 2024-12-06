@props(['confirm_submit'])
<div class="tab-pane fade" id="id_details">
    <div class="card">
        <div class="card-header">
            <h4><b>Personal Identification Number(S)</b></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label required-field" style="color:red">
                        Any one of Digital Ration Card Number, EPIC/Voter Id is mandatory
                    </label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label required-field required" id="rationCardLbl">Digital Ration Card
                        Number</label>
                    <div class="input-group">
                        <select class="form-select is-required" name="ration_card_cat" id="ration_card_cat" tabindex="1"
                            wire:model="ration_cat">
                            <option value="">Category</option>
                            @foreach(Config::get('constants.ration_cat') as $key => $val)
                                <option value="{{$key}}" @if(old('ration_card_cat') == $key) selected @endif>{{$val}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="ration_card_no" id="ration_card_no"
                            class="form-control NumOnly rationCardEpic is-required" placeholder="Card Number"
                            maxlength="10" value="{{ old('ration_card_no') }}" tabindex="2" wire:model="ration_no">
                    </div>
                    <span id="value_ration_card_cat" class="fw-medium d-none"></span>
                    <span id="value_ration_card_no" class="fw-medium d-none"></span>
                    <span id="error_ration_card_cat" class="text-danger d-none">Ration card Category is
                        required</span><br />
                    <span id="error_ration_card_no" class="text-danger d-none">Ration card Number is required</span>
                </div>
                <div class="col-md-4">
                    <label class="form-label required-field required">Aadhaar Number</label>
                    <input type="text" name="aadhar_no" id="aadhar_no" class="form-control NumOnly is-required"
                        placeholder="Aadhaar No." maxlength="12" value="{{ old('aadhar_no') }}" tabindex="4"
                        wire:model="aadhar_no" />
                    <span id="value_aadhar_no" class="fw-medium d-none"></span>
                    <span id="error_aadhar_no" class="text-danger d-none">Aadhar card number is required</span>
                    <span id="error_aadhar_no_valid" class="text-danger d-none">Valid Aadhar card number required</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label required-field required" id="voterCardLbl">EPIC/Voter Id number</label>
                    <input type="text" name="epic_voter_id" id="epic_voter_id"
                        class="form-control rationCardEpic is-required txtNum" placeholder="EPIC/Voter Id No."
                        maxlength="20" value="{{ old('epic_voter_id') }}" tabindex="5"
                        onkeyup="this.value = this.value.toUpperCase();" wire:model="epic_vot_id" />
                    <span id="error_epic_voter_id" class="text-danger d-none">EPIC/Voter Id no. number is
                        required</span>
                    <span id="value_epic_voter_id" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4">
                    <label class="form-label">PAN</label>
                    <input type="text" name="pan_no" id="pan_no" class="form-control special-char txtNum"
                        placeholder="PAN" maxlength="10" value="{{ old('pan_no') }}"
                        onkeyup="this.value = this.value.toUpperCase();" tabindex="6" wire:model="pan" />
                    <span id="error_pan_no" class="text-danger d-none"></span>
                    <span id="value_pan_no" class="fw-medium d-none"></span>
                </div>
            </div>
            <div class="d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-between">
                    <button type="button" name="previous_btn_id_details" id="previous_btn_id_details"
                        class="btn btn-info btn-lg">Previous</button>
                    <button type="button" name="btn_id_details" id="btn_id_details"
                        class="btn btn-success btn-lg">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{asset('js/scripts/keyRestrict.js')}}"></script>
<script src="{{asset('js/validateAdhar.js')}}"></script>
<script>


    document.getElementById('btn_id_details').addEventListener('click', function () {
        // Re-evaluate confirm_submit_code_id at the time of button click


        const personalDetailsId = document.getElementById('id_details');
        const requiredElements = personalDetailsId.querySelectorAll('.is-required');
        var aadhar_no = document.getElementById('aadhar_no').value.trim();
        let aadhar_valid_er = document.getElementById('error_aadhar_no_valid');
        let hasError = false;

        requiredElements.forEach(function (element) {
            const value = element.value.trim();
            const errorSpanId = 'error_' + element.getAttribute('id');
            const errorSpan = document.getElementById(errorSpanId);

            if (value.length === 0) {
                if (errorSpan) {
                    hasError = true;
                    errorSpan.classList.remove('d-none');
                    errorSpan.classList.add('d-flex');
                }
            } else {
                var aadhar_valid = validate_adhar(aadhar_no);
                if (!aadhar_valid) {
                    hasError = true;
                    aadhar_valid_er.classList.remove('d-none');
                    aadhar_valid_er.classList.add('d-flex');
                } else {
                    hasError = false;
                    if (errorSpan) {
                        errorSpan.classList.remove('d-flex');
                        errorSpan.classList.add('d-none');
                    }
                }
            }
        });

        if (!hasError) {
            // Only execute this part if confirm_submit_code_id is '0'

            const fields = {
                'ration_card_cat': 'value_ration_card_cat',
                'ration_card_no': 'value_ration_card_no',
                'aadhar_no': 'value_aadhar_no',
                'pan_no': 'value_pan_no',
                'epic_voter_id': 'value_epic_voter_id',
            };

            function updateSpan(id, value) {
                const span = document.getElementById(id);
                if (span) {
                    span.textContent = value;
                }
            }

            function getValue(element) {
                if (!element) return '';
                if (element.tagName === 'SELECT') {
                    const selectedOption = element.options[element.selectedIndex];
                    return selectedOption ? selectedOption.textContent : '';
                }
                return element.value;
            }

            for (const [inputId, spanId] of Object.entries(fields)) {
                const input = document.getElementById(inputId);
                const value = getValue(input);
                updateSpan(spanId, value);

            }

            // Logic to handle tab navigation
            let listIdDetails = document.getElementById('list_id_details');
            let idDetails = document.getElementById('id_details');
            let listContactDetails = document.getElementById('list_contact_details');
            let contactDetails = document.getElementById('contact_details');

            listIdDetails.classList.remove('active', 'active_tab1');
            listIdDetails.removeAttribute('href');
            listIdDetails.removeAttribute('data-toggle');
            idDetails.classList.remove('active', 'in');
            listIdDetails.classList.add('inactive_tab1');
            listContactDetails.classList.remove('inactive_tab1');
            listContactDetails.classList.add('active_tab1', 'active');
            listContactDetails.setAttribute('href', '#contact_details');
            listContactDetails.setAttribute('data-toggle', 'tab');
            contactDetails.classList.add('active', 'in');
            contactDetails.classList.remove('fade');
        }
    });


    // ID Details -> Personal Details (Previous Button)
    document.getElementById('previous_btn_id_details').addEventListener('click', function () {
        let listIdDetails = document.getElementById('list_id_details');
        let idDetails = document.getElementById('id_details');
        let listPersonalDetails = document.getElementById('list_personal_details');
        let personalDetails = document.getElementById('personal_details');

        listIdDetails.classList.remove('active', 'active_tab1');
        listIdDetails.removeAttribute('href');
        listIdDetails.removeAttribute('data-toggle');
        idDetails.classList.remove('active', 'in');
        listIdDetails.classList.add('inactive_tab1');
        listPersonalDetails.classList.remove('inactive_tab1');
        listPersonalDetails.classList.add('active_tab1', 'active');
        listPersonalDetails.setAttribute('href', '#personal_details');
        listPersonalDetails.setAttribute('data-toggle', 'tab');
        personalDetails.classList.add('active', 'in');
        personalDetails.classList.remove('fade');
    });


</script>