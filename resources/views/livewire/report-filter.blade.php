<div class="container">
    <div class="row">
        <div class="col-md-3">
            <label class="control-label">Select Phase</label>
            <select class="form-control">
                <option value="">-----All----</option>
                @foreach ($phases as $phase)
                    <option value="{{ $phase->phase_code }}">{{ $phase->phase_des }}</option>
                @endforeach
            </select>
        </div>
        <!-- District Dropdown -->
        <div class="col-md-3">
            <label class="control-label">District</label>
            <select wire:model.live="selectedDistrict" class="form-control">
                <option value="">-----All----</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Rural/Urban Dropdown -->
        <div class="col-md-2">
            <label class="control-label">Rural/Urban</label>
            <select wire:model.live="selectedRuralUrban" class="form-control">
                <option value="">-----All----</option>
                @foreach ($ruralUrbanOptions as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        @if ($selectedRuralUrban == 2)
            <!-- Block Dropdown for Rural -->
            <div class="col-md-3">
                <label class="control-label">Block</label>
                <select wire:model.live="selectedBlock" class="form-control">
                    <option value="">-----All----</option>
                    @foreach ($blocks as $block)
                        <option value="{{ $block->block_code }}">{{ $block->block_name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- GP Dropdown for Rural -->
            <div class="col-md-3">
                <label class="control-label">GP</label>
                <select wire:model.live="selectedGpWard" class="form-control">
                    <option value="">-----All----</option>
                    @foreach ($gpwards as $gpward)
                        <option value="{{ $gpward->gram_panchayat_code }}">{{ $gpward->gram_panchayat_name }}</option>
                    @endforeach
                </select>
            </div>
        @elseif($selectedRuralUrban == 1)
            <!-- Municipality Dropdown for Urban -->
            <div class="col-md-3">
                <label class="control-label">Municipality</label>
                <select wire:model.live="selectedMunicipality" class="form-control">
                    <option value="">-----All----</option>
                    @foreach ($municipalities as $municipality)
                        <option value="{{ $municipality->m_urban_body_code }}">{{ $municipality->m_urban_body_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Ward Dropdown for Urban -->
            <div class="col-md-3">
                <label class="control-label">Ward</label>
                <select wire:model.live="selectedUrbanWard" class="form-control">
                    <option value="">-----All Wards----</option>
                    @foreach ($gpwards as $gpward)
                        <option value="{{ $gpward->urban_body_ward_code }}">{{ $gpward->urban_body_ward_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-md-3">
            <a href="{{ route('applicantReport') }}" type="button" name="reset" id="reset"
                class="btn btn-warning mt-3">Reset</a>

            <button class="mx-2 btn btn-info mt-3" wire:click="downloadCsv">Download CSV</button>

        </div>

    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            @php
                echo count($beneficiaries) > 0 ? 'true' : 'false';
            @endphp
            <table id="example" class="display" cellspacing="0" width="100%">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="district_code" id="district_code" value="{{ @$district_code }}">
                <thead>
                    <tr role="row">
                        <th width="12%" class="text-left">Application ID</th>
                        <th width="20%" class="text-left">Beneficiary Name</th>
                        <th width="10%" class="text-left">Bank IFSC</th>
                        <th width="12%" class="text-left">Bank Account No</th>
                        <th width="12%" class="text-left">District</th>
                        <th width="12%" class="text-left">Block/ Municipality Name</th>
                        <th width="12%" class="text-left">GP/Ward Name</th>
                        {{-- <th width="12%" class="text-left">Village/Town/City</th> --}}
                        <th width="12%" class="text-left">House Premise No</th>
                        <th width="12%" class="text-left">Mobile No</th>
                        @if (isset($type))
                            @if ($type == 'A' && ($scheme == '1' || $scheme == '3'))
                                <th width="12%" class="text-left">First Payment Initiated Date</th>
                                <th width="12%" class="text-left">First Payment Success Date</th>
                            @endif
                        @endif
                        <th width="12%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beneficiaries as $key => $beneficiary)
                        <tr>
                            <td class="text-left">{{ $key + 1 }}</td>
                            <td class="text-left">{{ $beneficiary->ben_fname }} {{ $beneficiary->ben_mname }}
                                {{ $beneficiary->ben_lname }}</td>
                            <td class="text-left">{{ $beneficiary->bank_ifsc }}</td>
                            <td class="text-left">{{ $beneficiary->bank_code }}</td>
                            <td class="text-left">{{ $beneficiary->district_name }}</td>
                            <td class="text-left">{{ $beneficiary->block_ulb_name }}</td>
                            <td class="text-left">{{ $beneficiary->gp_ward_name }}</td>
                            {{-- <td class="text-left">{{ $beneficiary->village_town }}</td> --}}
                            <td class="text-left">{{ $beneficiary->house_premise_no }}</td>
                            <td class="text-left">{{ $beneficiary->mobile_no }}</td>
                            @if (isset($type) && $type == 'A' && ($scheme == '1' || $scheme == '3'))
                                <td class="text-left">{{ $beneficiary->first_payment_initiated_date }}</td>
                                <td class="text-left">{{ $beneficiary->first_payment_success_date }}</td>
                            @endif
                            <td>
                                <button class="btn btn-primary">Action</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>
