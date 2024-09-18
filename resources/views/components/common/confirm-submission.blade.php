@props(['scheme_id', 'districts', 'confirm_submit'])
<div class="modal modal-xl fade" id="confirm-submit" tabindex="-1" aria-labelledby="confirmSubmitLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSubmitLabel">Confirm Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                <x-common.personal-details :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
            </div>
            <div class="modal-footer text-center">
                <button type="button" id="submit-btn" class="btn btn-success btn-lg modal-submit" >Submit</button>
            </div>
        </div>
    </div>
</div>