<div class="row" id="per_address">
    <div class="mb-3 col-md-4">
        <label for="state" class="form-label required">State</label>
        <input type="text" id="state" name="state" class="form-control is-required" value="WEST BENGAL" readonly tabindex="1">
        <div id="error_state" class="text-danger d-none">State is required</div>
        <span id="value_state" class="fw-medium d-none"></span>
    </div>

    <div class="mb-3 col-md-4">
        <label for="district" class="form-label required">District</label>
        <select name="district" id="district" class="form-select is-required" wire:model.live="selectedDistrict" tabindex="2">
            <option value="">--Select--</option>
            @foreach ($districts as $district)
                <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
            @endforeach
        </select>
        <div id="error_district" class="text-danger d-none">District is required</div>
        <span id="value_district" class="fw-medium d-none"></span>
    </div>

    <div class="mb-3 col-md-4">
        <label for="asmb_cons" class="form-label required">Assembly Constituency</label>
        <select name="asmb_cons" id="asmb_cons" class="form-select is-required" wire:model.live="selectedAssembly" tabindex="3">
            <option value="">--Select--</option>
            @if ($selectedDistrict)
                @foreach ($assemblys as $assembly)
                    <option value="{{ $assembly->ac_no }}">{{ $assembly->ac_name }}</option>
                @endforeach
            @endif
        </select>
        <div id="error_asmb_cons" class="text-danger d-none">Assembly Constituency is required</div>
        <span id="value_asmb_cons" class="fw-medium d-none"></span>
    </div>

    <div class="mb-3 col-md-4" id="divUrbanCode">
        <label for="urban_code" class="form-label required">Rural/ Urban</label>
        <select name="urban_code" id="urban_code" class="form-select is-required" wire:model.live="selectedRuralurban" tabindex="4">
            <option value="">--Select--</option>
            @foreach(Config::get('constants.rural_urban') as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>
        <div id="error_urban_code" class="text-danger d-none">Rural/Urban is Required</div>
        <span id="value_urban_code" class="fw-medium d-none"></span>
    </div>

    <div class="mb-3 col-md-4" id="divBodyCode">
        <label for="block_urbanBody" id="blockLabel" class="form-label required">Block/Municipality/Corp.</label>
        <select name="block_urbanBody" id="block_urbanBody" class="form-select is-required" wire:model.live="selectedBlockurban" tabindex="5">
            <option value="">--Select--</option>
            @if ($selectedRuralurban == 2)
                @foreach ($blocks as $block)
                    <option value="{{ $block->block_code }}">{{ $block->block_name }}</option>
                @endforeach
            @elseif ($selectedRuralurban == 1)
                @foreach ($urbanbodys as $urbanbody)
                    <option value="{{ $urbanbody->m_urban_body_code }}">{{ $urbanbody->m_urban_body_name }}</option>
                @endforeach
            @endif
        </select>
        <div id="error_block_urbanBody" class="text-danger d-none">Block / Municipality is required</div>
        <span id="value_block_urbanBody" class="fw-medium d-none"></span>
    </div>

    <div class="mb-3 col-md-4" id="divGpWard">
        <label for="gp_ward" id="gpWardLabel" class="form-label required">GP/Ward No</label>
        <select name="gp_ward" id="gp_ward" class="form-select" wire:model.live="selectedGpWard" tabindex="6">
            <option value="">--Select--</option>
            @if ($selectedRuralurban == 2)
                @foreach ($gps as $gp)
                    <option value="{{ $gp->gram_panchayat_code }}">{{ $gp->gram_panchayat_name }}</option>
                @endforeach
            @elseif ($selectedRuralurban == 1)
                @foreach ($wards as $ward)
                    <option value="{{ $ward->urban_body_ward_code }}">{{ $ward->urban_body_ward_name }}</option>
                @endforeach
            @endif
        </select>
        <div id="error_gp_ward" class="text-danger d-none">Gram Panchayat/ Ward is Required</div>
        <span id="value_gp_ward" class="fw-medium d-none"></span>
    </div>
</div>
