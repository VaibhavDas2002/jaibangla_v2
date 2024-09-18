<div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="required-field required">IFS Code</label>
            <input type="text" name="bank_ifsc_code" id="bank_ifsc_code" class="form-control special-char is-required"
                placeholder="IFSC Code" onkeyup="this.value = this.value.toUpperCase();"
                value="" maxlength="11" tabindex="1" wire:model.live="bankIfsc" />
            <span id="error_bank_ifsc_code" class="text-danger d-none">IFS Code is Required</span>
            <span id="value_bank_ifsc_code" class="fw-medium d-none"></span>
        </div>

        <div class="form-group col-md-6">
            <label class="required-field required">Bank Name</label>
            <input type="text" name="name_of_bank" id="name_of_bank" class="form-control special-char is-required"
                placeholder="Bank Name" value="{{ $bankName }}" maxlength="200" tabindex="1" readonly />
            <span id="error_name_of_bank" class="text-danger d-none">Bank Name is Required</span>
            <span class="text-danger">{{ $errorMessage }}</span>
            <span id="value_name_of_bank" class="fw-medium d-none"></span>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label class="required-field required">Bank Branch Name</label>
            <input type="text" name="bank_branch" id="bank_branch" class="form-control is-required" placeholder="Bank Branch Name"
                value="{{ $bankBranch }}" maxlength="300" tabindex="2" readonly />
            <span id="error_bank_branch" class="text-danger d-none">Bank Branch Name is Required</span>
            <span class="text-danger">{{ $errorMessage }}</span>
            <span id="value_bank_branch" class="fw-medium d-none"></span>
        </div>

        <div class="form-group col-md-6">
            <label class="required-field required">Bank Account Number</label>
            <input type="text" name="bank_account_number" id="bank_account_number" class="form-control NumOnly is-required"
                placeholder="Bank Account No" value="" maxlength="16" tabindex="4" />
            <span id="error_bank_account_number" class="text-danger d-none">Bank Account Name is Required</span>
            <span class="text-danger">{{ $errorMessage }}</span>
            <span id="value_bank_account_number" class="fw-medium d-none"></span>
        </div>
    </div>
</div>
