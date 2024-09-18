@props(['confirm_submit'])
<div class="tab-pane fade" id="land_details">
  <div class="card">
    <div class="card-header">
      <h4><b>Land Details (In case of Dwelling House)</b></h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="form-group col-md-4">
          <label class="{{  'required-field'  }} required">Name of the Mouza</label>
          <input type="text" name="mouza_name" id="mouza_name" class="form-control special-char is-required"
            placeholder="Mouza Name" value="{{ old('mouza_name') }}" maxlength="200" tabindex="1" />
          <span id="error_mouza_name" class="text-danger d-none">Mouza name is required</span>
          <span id="value_mouza_name" class="fw-medium d-none"></span>
        </div>
        <div class="form-group col-md-4">
          <label class="{{ 'required-field' }} required">J.L.No.</label>
          <input type="text" name="land_jlno" id="land_jlno" class="form-control special-char is-required"
            placeholder="J.L.No." value="{{ old('land_jlno') }}" maxlength="200" tabindex="1" />
          <span id="error_land_jlno" class="text-danger d-none">J.L.No. is required</span>
          <span id="value_land_jlno" class="fw-medium d-none"></span>
        </div>
        <div class="form-group col-md-4">
          <label class="{{ 'required-field' }} required">Khatian No.</label>
          <input type="text" name="khatian_no" id="khatian_no" class="form-control special-char is-required"
            placeholder="Khatian No" value="{{ old('khatian_no') }}" maxlength="200" tabindex="1" />
          <span id="error_khatian_no" class="text-danger d-none">Khatan No. is required</span>
          <span id="value_khatian_no" class="fw-medium d-none"></span>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          <label class="{{ 'required-field' }} required">Plot No.</label>
          <input type="text" name="plot_no" id="plot_no" class="form-control special-char is-required"
            placeholder="Plot No" value="{{ old('plot_no') }}" maxlength="200" tabindex="1" />
          <span id="error_plot_no" class="text-danger d-none">Plot No. is required</span>
          <span id="value_plot_no" class="fw-medium d-none"></span>
        </div>
        <div class="form-group col-md-4">
          <label class="{{ 'required-field' }} required">Area</label>
          <input type="text" name="land_area" id="land_area" class="form-control special-char is-required"
            placeholder="Area" value="{{ old('land_area') }}" maxlength="200" tabindex="2" />
          <span id="error_land_area" class="text-danger d-none">Area is required</span>
          <span id="value_land_area" class="fw-medium d-none"></span>
        </div>
        <div class="form-group col-md-4">
          <label class="{{ 'required-field' }} required">In the Name of</label>
          <input type="text" name="land_holdername" id="land_holdername" class="form-control special-char is-required"
            placeholder="Name" value="{{ old('land_holdername') }}" maxlength="200" tabindex="4" />
          <span id="error_land_holdername" class="text-danger d-none">Land-Holder Name is required</span>
          <span id="value_land_holdername" class="fw-medium d-none"></span>
        </div>
      </div>
      <br />
      <div class="d-flex flex-column justify-content-end">
        <div class="d-flex justify-content-between">
          <button type="button" name="previous_btn_land_details" id="previous_btn_land_details"
            class="btn btn-info btn-lg">Previous</button>
          <button type="button" name="btn_land_details" id="btn_land_details"
            class="btn btn-success btn-lg">Next</button>
        </div>
      </div>
      <br />
    </div>
  </div>
</div>

<script src="{{asset('js/scripts/keyRestrict.js')}}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
   
    document.getElementById('btn_land_details').addEventListener('click', function () {
      // const landDetails = document.getElementById('land_details');
      // const requiredElements = landDetails.querySelectorAll('.is-required');

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

      // // Proceed to the next tab if no errors are found
      // if (!hasError) {
   
        const fields = {
          'mouza_name': 'value_mouza_name',
          'land_jlno': 'value_land_jlno',
          'khatian_no': 'value_khatian_no',
          'plot_no': 'value_plot_no',
          'land_area': 'value_land_area',
          'land_holdername': 'value_land_holdername',

        };

        // Function to update span text content
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
 
      let listLandDetails = document.getElementById('list_land_details');
      let landDetails = document.getElementById('land_details');
      let listBankDetails = document.getElementById('list_bank_details');
      let bankDetails = document.getElementById('bank_details');

      listLandDetails.classList.remove('active', 'active_tab1');
      listLandDetails.removeAttribute('href');
      listLandDetails.removeAttribute('data-toggle');
      landDetails.classList.remove('active', 'in');
      listLandDetails.classList.add('inactive_tab1');
      listBankDetails.classList.remove('inactive_tab1');
      listBankDetails.classList.add('active_tab1', 'active');
      listBankDetails.setAttribute('href', '#bank_details');
      listBankDetails.setAttribute('data-toggle', 'tab');
      bankDetails.classList.add('active', 'in');
      bankDetails.classList.remove('fade');
      landDetails.classList.add('fade');
      // }
    });


    //  Land Details -> Contact Details (Previous)
    document.getElementById('previous_btn_land_details').addEventListener('click', function () {
      let listLandDetails = document.getElementById('list_land_details');
      let landDetails = document.getElementById('land_details');
      let listContactDetails = document.getElementById('list_contact_details');
      let contactDetails = document.getElementById('contact_details');

      listLandDetails.classList.remove('active', 'active_tab1');
      listLandDetails.removeAttribute('href');
      listLandDetails.removeAttribute('data-toggle');
      landDetails.classList.remove('active', 'in');
      listLandDetails.classList.add('inactive_tab1');
      listContactDetails.classList.remove('inactive_tab1');
      listContactDetails.classList.add('active_tab1', 'active');
      listContactDetails.setAttribute('href', '#contact_details');
      listContactDetails.setAttribute('data-toggle', 'tab');
      contactDetails.classList.add('active', 'in');
    });

  });
</script>