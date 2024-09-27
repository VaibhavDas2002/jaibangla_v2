@props(['scheme_id', 'confirm_submit'])
<div class="tab-pane fade" id="decl_details">
<input type="hidden" name="scheme_id" id="scheme_id_dec" value="{{$scheme_id}}" />
    <div class="card">
        <div class="card-header">
            <h4><b>Self Declaration</b></h4>
        </div>
        <div class="card-body">
            <!-- First Row: Beneficiary Question -->
            <div class="row mb-3">
                <div class="col-12">
                    <label>
                        I
                        <select name="ssp_y_n" id="ssp_y_n" class="form-select">
                            <option value="1">am</option>
                            <option value="0">am not</option>
                        </select>
                        <span id="value_ssp_y_n" class="fw-medium d-none"></span>
                        a beneficiary of any other Social Security pension scheme or a recipient of Government pension
                        or pension from any other organization.
                    </label>
                </div>
            </div>

            <!-- Second Row: Pucca House Question -->
            <div class="row mb-3">
                <div class="col-12">
                    <label>
                        I
                        <select name="pucca_house_y_n" id="pucca_house_y_n" class="form-select">
                            <option value="1">do</option>
                            <option value="0">do not</option>
                        </select>
                        <span id="value_pucca_house_y_n" class="fw-medium d-none"></span>
                        have a Pucca dwelling house.
                    </label>
                </div>
            </div>

            <!-- Third Row: Nomination -->
            <div class="row mb-3">
                <div class="col-12">
                    <label>In the event of my death, I hereby nominate (Please mention Name, Address &amp;
                        Relationship)</label>
                </div>
            </div>

            <!-- Nomination Fields -->
            <div class="row mb-3">
                <div class="col-md-4 col-sm-12">
                    <label for="nominate_name">Name</label>
                    <input type="text" name="nominate_name" id="nominate_name" class="form-control txtOnly"
                        placeholder="Name" maxlength="200">
                    <span id="error_nominate_name" class="text-danger"></span>
                    <span id="value_nominate_name" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="nominate_address">Address</label>
                    <input type="text" name="nominate_address" id="nominate_address" class="form-control special-char"
                        placeholder="Address" maxlength="200">
                    <span id="error_nominate_address" class="text-danger"></span>
                    <span id="value_nominate_address" class="fw-medium d-none"></span>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="nominate_relationship">Relationship</label>
                    <input type="text" name="nominate_relationship" id="nominate_relationship"
                        class="form-control txtOnly" placeholder="Relationship" maxlength="200">
                    <span id="error_nominate_relationship" class="text-danger"></span>
                    <span id="value_nominate_relationship" class="fw-medium d-none"></span>
                </div>
            </div>

            <!-- Fourth Row: Aadhaar Consent -->
            <div class="row mb-3">
                <div class="col-12">
                    <label>
                        I
                        <select name="av_status" id="av_status" class="form-select">
                            <option value="1">give</option>
                            <option value="0">do not give</option>
                        </select>
                        <span id="value_av_status" class="fw-medium d-none"></span>
                        consent to the use of the Aadhaar No. for authenticating my identity for social security pension
                        (In case Aadhaar no. provided by the applicant).
                    </label>
                </div>
            </div>

            <!-- Fifth Row: Pension Sources -->
            <div class="row mb-3">
                <div class="col-12">
                    <label>Presently, I am receiving the following pension(s) from</label>
                    <br />
                    @foreach(Config::get('constants.pension_body') as $key => $desc)
                        <label>
                            <input type="checkbox" class="form-check-input receive-pension" id="receive_pension[]" name="receive_pension[]"
                                value="{{$key}}" checked> {{$desc}}
                        </label>
                        <br />
                    @endforeach
                    <label>In case the applicant is receiving pension from other sources</label>
                    <br />
                    <label>1.</label>
                    <input type="text" name="receiving_pension_other_source_1" id="receiving_pension_other_source_1"
                        class="form-control" maxlength="300">
                    <span id="value_receiving_pension_other_source_1" class="fw-medium d-none"></span>
                    <label>2.</label>
                    <input type="text" name="receiving_pension_other_source_2" id="receiving_pension_other_source_2"
                        class="form-control" maxlength="300">
                    <span id="value_receiving_pension_other_source_2" class="fw-medium d-none"></span>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <button type="button" name="previous_btn_decl_details" id="previous_btn_decl_details"
                        class="btn btn-info btn-lg">Previous</button>
                    <input type="button" class="btn btn-success btn-lg" name="btn_submit_preview"
                        id="btn_submit_preview" value="Preview and Submit" data-bs-toggle="modal"
                        data-bs-target="#confirm-submit" >
                        <span wire:loading>Saving...</span> 
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    document.addEventListener('DOMContentLoaded', function () {
        var schemeId = document.getElementById('scheme_id_dec').value;
        // console.log(schemeId);
        document.getElementById('previous_btn_decl_details').addEventListener('click', function () {
            let listDeclDetails = document.getElementById('list_decl_details');
            let declDetails = document.getElementById('decl_details');
            let listExperienceDetails = document.getElementById('list_experience_details');
            let experienceDetails = document.getElementById('experience_details');
            let listAddDetails = document.getElementById('list_additional_details');
            let addDetails = document.getElementById('additional_details');
            // Common steps for both conditions
            listDeclDetails.classList.remove('active', 'active_tab1');
            listDeclDetails.removeAttribute('href');
            listDeclDetails.removeAttribute('data-toggle');
            declDetails.classList.remove('active', 'in');
            listDeclDetails.classList.add('inactive_tab1');

            const fields = {
                'ssp_y_n': 'value_ssp_y_n',
                'pucca_house_y_n': 'value_pucca_house_y_n',
                'nominate_name': 'value_nominate_name',
                'nominate_address': 'value_nominate_address',
                'nominate_relationship': 'value_nominate_relationship',
                'av_status': 'value_av_status',
                'receiving_pension_other_source_1': 'value_receiving_pension_other_source_1',
                'receiving_pension_other_source_2': 'value_receiving_pension_other_source_2',
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

            if (schemeId === '17') {
                // Self Declaration -> Additional Details (if schemeId is 17)
                listAddDetails.classList.remove('inactive_tab1');
                listAddDetails.classList.add('active_tab1', 'active');
                listAddDetails.setAttribute('href', '#additional_details');
                listAddDetails.setAttribute('data-toggle', 'tab');
                addDetails.classList.add('active', 'in');
                experienceDetails.classList.remove('active');
            } else {
                // Self Declaration -> Experience Details (for other schemes)
                listExperienceDetails.classList.remove('inactive_tab1');
                listExperienceDetails.classList.add('active_tab1', 'active');
                listExperienceDetails.setAttribute('href', '#experience_details');
                listExperienceDetails.setAttribute('data-toggle', 'tab');
                experienceDetails.classList.add('active', 'in');

            }
        });
    });
</script>