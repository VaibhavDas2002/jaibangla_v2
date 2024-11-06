<div id="report_section">
    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="schemeId" class="form-label required">Select Scheme</label>
            <select name="schemeId" id="schemeId" class="form-select is-required" wire:model.live="selectedSchemeId"
                tabindex="1">
                <option value="">--Select Scheme--</option>
                @foreach ($schemes as $scheme)
                    <option value="{{ $scheme->id }}">{{ $scheme->display_name }}</option>
                @endforeach
            </select>
            <div id="error_scheme" class="text-danger d-none">Scheme is required</div>
            <span id="value_scheme" class="fw-medium d-none"></span>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="reportId" class="form-label required">Select Report</label>
            <select name="reportId" id="reportId" class="form-select is-required" wire:model.live="selectedReportId"
                tabindex="2">
                <option value="">--Select Report--</option>
                @if (!empty($reports))
                    @foreach ($reports as $report)
                        <option value="{{ $report->id }}">{{ $report->name }}</option>
                    @endforeach
                @endif
            </select>
            <div id="error_report" class="text-danger d-none">Report is required</div>
            <span id="value_report" class="fw-medium d-none"></span>
        </div>
    </div>
</div>
