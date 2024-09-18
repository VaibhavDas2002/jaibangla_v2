@props(['document_msg', 'doc_list_man', 'doc_list_opt', 'profile_img', 'scheme_id'])
<div class="tab-pane fade" id="experience_details">
    <div class="card">
        <div class="card-header">
            <h4><b>Enclosure List (Self Attested)</b></h4>
        </div>
        <div class="card-body">
            @if(isset($scheme_id))
            <input type="hidden" name="scheme_id" id="scheme_id_enc" value="{{$scheme_id}}" />
            @endif
            @if(!empty($doc_list_man))
                @foreach ($doc_list_man as $key1 => $doc_man)
                    <div class="form-group col-md-12 mb-4">
                        <label class="form-label required-field required">{{ $doc_man['doc_name'] }}</label>
                        <input type="file" name="doc_{{ $doc_man['id'] }}" id="doc_{{ $doc_man['id'] }}" class="form-control"
                            tabindex="{{ $key1 }}" />
                        <div class="form-text">
                            (Image type must be {{ $doc_man['doc_type'] }} and image size max {{ $doc_man['doc_size_kb'] }}KB)
                        </div>
                        <span id="error_doc_{{ $doc_man['id'] }}" class="text-danger"></span>
                    </div>
                @endforeach
            @endif

            @if(!empty($doc_list_opt))
                @foreach ($doc_list_opt as $key => $doc_opt)
                    <div class="form-group col-md-12 mb-4">
                        <label class="form-label">{{ $doc_opt['doc_name'] }}</label>
                        <input type="file" name="doc_{{ $doc_opt['id'] }}" id="doc_{{ $doc_opt['id'] }}" class="form-control"
                            tabindex="{{ $key }}" />
                        <div class="form-text">
                            (Image type must be {{ $doc_opt['doc_type'] }} and image size max {{ $doc_opt['doc_size_kb'] }}KB)
                        </div>
                        <span id="error_doc_{{ $doc_opt['id'] }}" class="text-danger"></span>
                    </div>
                @endforeach
            @endif


            <div class="d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-between">
                    <button type="button" name="previous_btn_experience_details" id="previous_btn_experience_details"
                        class="btn btn-info btn-lg">Previous</button>
                    <button type="button" name="btn_experience_details" id="btn_experience_details"
                        class="btn btn-success btn-lg">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var schemeElement = document.getElementById('scheme_id_enc');
        var schemeId = schemeElement ? schemeElement.value : null;

        function handleExperienceClick(nextListId, nextDetailsId) {
            let listExperienceDetails = document.getElementById('list_experience_details');
            let experienceDetails = document.getElementById('experience_details');
            let nextListDetails = document.getElementById(nextListId);
            let nextDetails = document.getElementById(nextDetailsId);

            if (listExperienceDetails && experienceDetails && nextListDetails && nextDetails) {
                listExperienceDetails.classList.remove('active', 'active_tab1');
                listExperienceDetails.removeAttribute('href');
                listExperienceDetails.removeAttribute('data-toggle');
                experienceDetails.classList.remove('active');
                listExperienceDetails.classList.add('inactive_tab1');
                nextListDetails.classList.remove('inactive_tab1');
                nextListDetails.classList.add('active_tab1', 'active');
                nextListDetails.setAttribute('href', '#' + nextDetailsId);
                nextListDetails.setAttribute('data-toggle', 'tab');
                nextDetails.classList.remove('fade');
                nextDetails.classList.add('active', 'in');
            }
        }

        document.getElementById('btn_experience_details').addEventListener('click', function () {
            if (schemeId === '17') {
                // Experience Details -> Additional Details (if schemeId is 17)
                handleExperienceClick('list_additional_details', 'additional_details');
            } else {
                // Experience Details -> Self Declaration (for other schemeIds)
                handleExperienceClick('list_decl_details', 'decl_details');
            }
        });
    });



    // Experience Details -> Bank Details (Previous)
    document.getElementById('previous_btn_experience_details').addEventListener('click', function () {
        let listExperienceDetails = document.getElementById('list_experience_details');
        let experienceDetails = document.getElementById('experience_details');
        let listBankDetails = document.getElementById('list_bank_details');
        let bankDetails = document.getElementById('bank_details');

        listExperienceDetails.classList.remove('active', 'active_tab1');
        listExperienceDetails.removeAttribute('href');
        listExperienceDetails.removeAttribute('data-toggle');
        experienceDetails.classList.remove('active', 'in');
        listExperienceDetails.classList.add('inactive_tab1');
        listBankDetails.classList.remove('inactive_tab1');
        listBankDetails.classList.add('active_tab1', 'active');
        listBankDetails.setAttribute('href', '#bank_details');
        listBankDetails.setAttribute('data-toggle', 'tab');
        bankDetails.classList.add('active', 'in');
    });
</script>