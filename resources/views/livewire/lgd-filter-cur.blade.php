<div class="row" id="cur_address">
    <div class="mb-3 col-md-4">
        <label for="state_cur" class="form-label required">State</label>
        <input type="text" id="state_cur" name="state_cur" class="form-control is-required" placeholder=""
            value="WEST BENGAL" readonly tabindex="13">
        <div id="error_state_cur" class="text-danger d-none">State is required</div>
        <span id="value_state_cur" class="fw-medium d-none"></span>
    </div>
    <div class="mb-3 col-md-4">
        <label for="district_cur" class="form-label required">District</label>
        <select name="district_cur" id="district_cur" class="form-select is-required" tabindex="14"
            wire:model.live="selectedDistrictcur">
            <option value="">--Select --</option>
            @foreach ($districts as $district)
                <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
            @endforeach
        </select>
        <div id="error_district_cur" class="text-danger d-none">District is required</div>
        <span id="value_district_cur" class="fw-medium d-none"></span>
    </div>
    <div class="mb-3 col-md-4">
        <label for="asmb_cons_cur" class="form-label required">Assembly Constituency</label>
        <select name="asmb_cons_cur" id="asmb_cons_cur" class="form-select is-required" tabindex="15"
            wire:model.live="selectedAssemblycur">
            <option value="">--Select--</option>
            @foreach ($assemblys as $assembly)
                <option value="{{ $assembly->ac_no }}">{{ $assembly->ac_name }}</option>
            @endforeach
        </select>
        <div id="error_asmb_cons_cur" class="text-danger d-none">Assembly Constituency is required</div>
        <span id="value_asmb_cons_cur" class="fw-medium d-none"></span>
    </div>
    <div class="mb-3 col-md-4" id="divUrbanCode">
        <label for="urban_code_cur" class="form-label required">Rural/ Urban</label>
        <select name="urban_code_cur" id="urban_code_cur" class="form-select is-required" tabindex="16"
            wire:model.live="selectedRuralurbancur">
            <option value="">--Select --</option>
            @foreach(Config::get('constants.rural_urban') as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>
        <div id="error_urban_code_cur" class="text-danger d-none">Rural/Urban is required</div>
        <span id="value_urban_code_cur" class="fw-medium d-none"></span>
    </div>
    <div class="mb-3 col-md-4" id="divBodyCode">
        <label for="block_cur" class="form-label required">Block/Municipality/Corp.</label>
        <select name="block_cur" id="block_cur" class="form-select is-required" tabindex="17"
            wire:model.live="selectedBlockurbancur">
            <option value="">--Select --</option>
            @if ($selectedRuralurbancur == 2)
                @foreach ($blocks as $block)
                    <option value="{{ $block->block_code }}">{{ $block->block_name }}</option>
                @endforeach
            @elseif ($selectedRuralurbancur == 1)
                @foreach ($urbanbodys as $urbanbody)
                    <option value="{{ $urbanbody->m_urban_body_code }}">{{ $urbanbody->m_urban_body_name }}</option>
                @endforeach
            @endif
        </select>
        <div id="error_block_cur" class="text-danger d-none">Block / Municipality is req</div>
        <span id="value_block_cur" class="fw-medium d-none"></span>
    </div>
    <div class="mb-3 col-md-4">
        <label for="gp_ward_cur" class="form-label required">GP/Ward No</label>
        <select name="gp_ward_cur" id="gp_ward_cur" class="form-select is-required" tabindex="18"
            wire:model.live="selectedGpWardcur">
            <option value="">--Select --</option>
            @foreach ($gps as $gp)
                <option value="{{ $gp->gram_panchayat_code }}">{{ $gp->gram_panchayat_name }}</option>
            @endforeach
            @foreach ($wards as $ward)
                <option value="{{ $ward->urban_body_ward_code }}">{{ $ward->urban_body_ward_name }}</option>
            @endforeach
        </select>
        <div id="error_gp_ward_cur" class="text-danger d-none">Gram Panchayat / Ward is required </div>
        <span id="value_gp_ward_cur" class="fw-medium d-none"></span>
    </div>
</div>