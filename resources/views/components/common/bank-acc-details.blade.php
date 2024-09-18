@props(['scheme_id', 'confirm_submit'])
<div class="tab-pane fade" id="bank_details">
  <div class="card">
    <div class="card-header">
      <h4><b>Bank Account Details</b></h4>
    </div>
    <div class="card-body">
      @if(isset($scheme_id))
      <input type="hidden" name="scheme_id" id="scheme_id_bank" value="{{$scheme_id}}" />
    @endif
      @livewire('bank-detailss')
      <br />
      <div class="d-flex flex-column justify-content-end">
        <div class="d-flex justify-content-between">
          <button type="button" name="previous_btn_bank_details" id="previous_btn_bank_details"
            class="btn btn-info btn-lg">Previous</button>
          <button type="button" name="btn_bank_details" id="btn_bank_details"
            class="btn btn-success btn-lg">Next</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  document.getElementById('bank_ifsc_code').addEventListener('input', function () {
    var ifscData = document.getElementById('bank_ifsc_code').value.trim();
    var ifscRGEX = /^[a-z]{4}0[a-z0-9]{6}$/i;
    var baseURL = "{{ url('/') }}";

    if (ifscRGEX.test(ifscData)) {

      document.getElementById('bank_ifsc_code').classList.remove('has-error');
      document.getElementById('error_bank_ifsc_code').textContent = '';

      // Display loading GIFs while fetching the bank details
      document.getElementById('error_name_of_bank').innerHTML = '<img src="/images/ZKZg.gif" width="50px" height="50px"/>';
      document.getElementById('error_bank_branch').innerHTML = '<img src="/images/ZKZg.gif" width="50px" height="50px"/>';

    } else {
      // Show error message if IFSC format is invalid
      document.getElementById('error_bank_ifsc_code').textContent = 'IFSC format invalid, please check the code';
      document.getElementById('bank_ifsc_code').classList.add('has-error');
    }
  });
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btn_bank_details').addEventListener('click', function () {
      // const landDetails = document.getElementById('bank_details');
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
        'bank_ifsc_code': 'value_bank_ifsc_code',
        'name_of_bank': 'value_name_of_bank',
        'bank_branch': 'value_bank_branch',
        'bank_account_number': 'value_bank_account_number',
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

      let listBankDetails = document.getElementById('list_bank_details');
      let bankDetails = document.getElementById('bank_details');
      let listExperienceDetails = document.getElementById('list_experience_details');
      let experienceDetails = document.getElementById('experience_details');

      listBankDetails.classList.remove('active', 'active_tab1');
      listBankDetails.removeAttribute('href');
      listBankDetails.removeAttribute('data-toggle');
      bankDetails.classList.remove('active');
      listBankDetails.classList.add('inactive_tab1');
      listExperienceDetails.classList.remove('inactive_tab1');
      listExperienceDetails.classList.add('active_tab1', 'active');
      listExperienceDetails.setAttribute('href', '#experience_details');
      listExperienceDetails.setAttribute('data-toggle', 'tab');
      experienceDetails.classList.remove('fade');
      experienceDetails.classList.add('active', 'in');
      // }
    });

  });


  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('previous_btn_bank_details').addEventListener('click', function () {
      var schemeId = document.getElementById('scheme_id_bank').value;

      // console.log(schemeId);

      let listBankDetails = document.getElementById('list_bank_details');
      let bankDetails = document.getElementById('bank_details');
      let listLandDetails = document.getElementById('list_land_details');
      let landDetails = document.getElementById('land_details');
      let listContactDetails = document.getElementById('list_contact_details');
      let contactDetails = document.getElementById('contact_details');
      listBankDetails.classList.remove('active', 'active_tab1');
      listBankDetails.removeAttribute('href');
      listBankDetails.removeAttribute('data-toggle');
      bankDetails.classList.remove('active', 'in');
      listBankDetails.classList.add('inactive_tab1');
      if (schemeId === '17') {
        listLandDetails.classList.remove('inactive_tab1');
        listLandDetails.classList.add('active_tab1', 'active');
        listLandDetails.setAttribute('href', '#land_details');
        listLandDetails.setAttribute('data-toggle', 'tab');
        landDetails.classList.add('active', 'in');
        landDetails.classList.remove('fade');
      } else {
        listContactDetails.classList.remove('inactive_tab1');
        listContactDetails.classList.add('active_tab1', 'active');
        listContactDetails.setAttribute('href', '#contact_details');
        listContactDetails.setAttribute('data-toggle', 'tab');
        contactDetails.classList.add('active', 'in');

      }
    });

  });

</script>