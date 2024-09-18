<style type="text/css">
    .bg_blue {
        background-color: #003399;
        border-radius: 12px;
    }

    .bg_blue h2 {
        color: #fff;
        font-weight: 600;
        margin: 0px;
        font-size: 3vh;
    }
</style>
<div class="modal modal-xl fade" wire:ignore.self id="confirm-submit" tabindex="-1" aria-labelledby="confirmSubmitLabel" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSubmitLabel">Confirm Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div>
                            <img src="{{ url('/') }}/bower_components/Emblem_of_West_Bengal.png" width="180px"
                                height="200px" alt="Emblem of West Bengal">
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div>
                            <h2>Government of West Bengal</h2>
                            <h2>Jai Bangla Pension Scheme</h2>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div class="bg_blue text-white text-center p-3 ">
                            <h2 class="badge text-wrap">জয় বাংলা</h2>
                        </div>
                    </div>
                </div>

                <input type="text" id="confirm_submit" name="confirm_submit" value="{{$confirm_submit}}">
                <x-common.personal-details :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
                <x-common.personal-id-number :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
                <x-common.contact-details :scheme_id="$scheme_id" :districts="$districts"
                    :confirm_submit="$confirm_submit" />
                @if ($scheme_id == 17)
                    <x-common.land-details :confirm_submit="$confirm_submit" />
                @endif
                <x-common.bank-acc-details :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
                @if ($scheme_id == 17)
                    <x-common.additional-details :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
                @endif
                <x-common.self-decleration :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
            </div>
            <div class="modal-footer text-center">
            <button class="badge text-bg-danger rounded-pill">Reset</button>
                <button type="button" id="submit-btn" class="btn btn-success btn-lg modal-submit"
                    data-bs-dismiss="modal" aria-label="Close">Submit</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const confirm_submit = document.getElementById('confirm_submit').value;
        if (confirm_submit === '1') {


            const formSelectElements = document.querySelectorAll("#confirm-submit .form-select");
            const formControlElements = document.querySelectorAll("#confirm-submit .form-control");

            // Add 'd-none' class to all selected elements
            formSelectElements.forEach((element) => {
                element.classList.add("d-none");
            });

            formControlElements.forEach((element) => {
                element.classList.add("d-none");
            });


        }
        // Select elements inside the modal
        const detailSections = document.querySelectorAll(
            '#confirm-submit #personal_details, ' +
            '#confirm-submit #id_details, ' +
            '#confirm-submit #contact_details, ' +
            '#confirm-submit #land_details, ' +
            '#confirm-submit #bank_details, ' +
            '#confirm-submit #additional_details, ' + // Added missing comma
            '#confirm-submit #decl_details'
        );

        const buttonsToFade = document.querySelectorAll(
            '#confirm-submit #btn_personal_details, ' +
            '#confirm-submit #previous_btn_id_details, ' +
            '#confirm-submit #btn_id_details, ' +
            '#confirm-submit #previous_btn_contact_details, ' +
            '#confirm-submit #btn_contact_details, ' +
            '#confirm-submit #previous_btn_land_details, ' +
            '#confirm-submit #btn_land_details, ' +
            '#confirm-submit #previous_btn_bank_details, ' +
            '#confirm-submit #btn_bank_details, ' +
            '#confirm-submit #previous_btn_decl_details, ' +
            '#confirm-submit #btn_submit_preview, ' + // Added missing comma
            '#confirm-submit #btn_add_details, ' + // Added missing comma
            '#confirm-submit #previous_btn_add_details'
        );

        // Remove 'fade' class and add 'active in' class to detail sections
        detailSections.forEach(section => {
            section.classList.remove('fade');
            section.classList.add('active', 'in');
        });

        // Add 'fade' class to buttons
        buttonsToFade.forEach(button => {
            button.classList.add('fade');
        });
    });

</script>