@props(['scheme_id', 'confirm_submit'])
<div class="tab-pane fade" id="additional_details">
    <div class="card">
        <div class="card-header">
            <h4><b>Additional Details</b></h4>
        </div>
        <div class="card-body">
            <input type="hidden" class="form-control" value="{{ $scheme_id }}">
            <div class="row">
                @if($scheme_id == 17)
                    <div class="col-md-6 mb-3">
                        <label for="app_phase" class="required-field required">Select Application Phase</label>
                        <select class="form-control is-required" name="app_phase" id="app_phase">
                            <option value="">--Select--</option>
                            @foreach(Config::get('constants.purohit_phase') as $key => $val)
                                <option value="{{$key}}" @if(old('app_phase') == $key) selected @endif>
                                    {{$val}}
                                </option>
                            @endforeach
                        </select>
                        <span id="error_app_phase" class="text-danger d-none">Application Phase is required</span>
                        <span id="value_app_phase" class="fw-medium d-none"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="temple_type" class="required-field required">Temple Type</label>
                        <select class="form-control is-required" name="temple_type" id="temple_type">
                            <option value="">--Select--</option>
                            <option value='Temple Purohit' @if(old('temple_type') == 'Temple Purohit') selected @endif>
                                Temple Purohit
                            </option>
                            <option value='Tribal Religious Place Purohit' @if(old('temple_type') == 'Tribal Religious Place Purohit') selected @endif>
                                Tribal Religious Place Purohit
                            </option>
                            <option value='Community Purohit' @if(old('temple_type') == 'Community Purohit') selected @endif>
                                Community Purohit
                            </option>
                        </select>
                        <span id="error_temple_type" class="text-danger d-none">Tample Type is Required</span>
                        <span id="value_temple_type" class="fw-medium d-none"></span>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-between">
                    <button type="button" name="previous_btn_id_details" id="previous_btn_add_details"
                        class="btn btn-info btn-lg">Previous</button>
                    <button type="button" name="btn_id_details" id="btn_add_details"
                        class="btn btn-success btn-lg">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('btn_add_details').addEventListener('click', function () {
            // const landDetails = document.getElementById('additional_details');
            // const requiredElements = landDetails.querySelectorAll('.is-required');
            // let hasError = false;
            // requiredElements.forEach(function (element) {
            //   const value = element.value.trim();
            //   const errorSpanId = 'error_' + element.getAttribute('id');
            //   const errorSpan = document.getElementById(errorSpanId);


            //   if (value.length === 0) {
            //     if (errorSpan) {
            //       hasError = true;
            //       errorSpan.classList.remove('d-none');
            //       errorSpan.classList.add('d-flex');
            //     }
            //   } else {
            //     if (errorSpan) {
            //       errorSpan.classList.remove('d-flex');
            //       errorSpan.classList.add('d-none');
            //     }
            //   }
            // });

            // // Proceed to the next tab if no errors are found
            // if (!hasError) {

            const fields = {
                'app_phase': 'value_app_phase',
                'temple_type': 'value_temple_type',
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

            let listAddDetails = document.getElementById('list_additional_details');
            let addDetails = document.getElementById('additional_details');
            let listDeclDetails = document.getElementById('list_decl_details');
            let declDetails = document.getElementById('decl_details');

            listAddDetails.classList.remove('active', 'active_tab1');
            listAddDetails.removeAttribute('href');
            listAddDetails.removeAttribute('data-toggle');
            addDetails.classList.remove('active');
            listAddDetails.classList.add('inactive_tab1');
            listDeclDetails.classList.remove('inactive_tab1');
            listDeclDetails.classList.add('active_tab1', 'active');
            listDeclDetails.setAttribute('href', '#decl_details');
            listDeclDetails.setAttribute('data-toggle', 'tab');
            declDetails.classList.remove('fade');
            declDetails.classList.add('active', 'in');
            // }
        });


    });
    // Additional -> Experience Details (Previous)
    document.getElementById('previous_btn_add_details').addEventListener('click', function () {
        let listAddDetails = document.getElementById('list_additional_details');
        let addDetails = document.getElementById('additional_details');
        let listExperienceDetails = document.getElementById('list_experience_details');
        let experienceDetails = document.getElementById('experience_details');

        listAddDetails.classList.remove('active', 'active_tab1');
        listAddDetails.removeAttribute('href');
        listAddDetails.removeAttribute('data-toggle');
        addDetails.classList.remove('active', 'in');
        listAddDetails.classList.add('inactive_tab1');
        listExperienceDetails.classList.remove('inactive_tab1');
        listExperienceDetails.classList.add('active_tab1', 'active');
        listExperienceDetails.setAttribute('href', '#experience_details');
        listExperienceDetails.setAttribute('data-toggle', 'tab');
        experienceDetails.classList.add('active', 'in');
    });
</script>