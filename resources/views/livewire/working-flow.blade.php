<div>
    <!-- Display the scheme name at the top -->
    <h4 class="mb-4">Scheme: {{ $scheme->scheme_name }}</h4>
    
    <form wire:submit.prevent="submit">
        @csrf

        <div class="form-group row align-items-end mb-3">
            <div class="col-md-4">
                <label for="step" class="col-form-label">Step Name:</label>
                <select wire:model.defer="newStep.step_id" wire:key="step-dropdown-{{ now() }}" class="form-control">
                    <option value="">Select Step</option>
                    @foreach($filteredSteps as $stepOption)
                        <option value="{{ $stepOption->id }}">{{ $stepOption->step_name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="designation" class="col-form-label">Role:</label>
                <select wire:model.defer="newStep.designation_id" wire:key="designation-dropdown-{{ now() }}" class="form-control">
                    <option value="">Select Role</option>
                    @foreach($filteredDesignations as $designationOption)
                        <option value="{{ $designationOption->id }}">{{ $designationOption->name }}</option>
                    @endforeach
                </select>
            </div>
            

            <div class="col-md-4 text-end">
                <button type="button" wire:click="addStep" class="btn btn-primary">Add</button>
            </div>
        </div>

        <input type="hidden" name="scheme_id" value="{{ $scheme_id }}">

        <!-- Temporary Data Table -->
        <h5 class="mt-4">Workflow Steps:</h5>
        <table class="table table-bordered mb-3">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Step Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temporarySteps as $index => $step)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Serial Number -->
                        <td>{{ $this->getStepName($step['step_id']) }}</td>
                        <td>{{ $this->getDesignationName($step['designation_id']) }}</td>
                        <td>
                            <button type="button" wire:click="removeTemporaryStep({{ $index }})" class="btn btn-danger">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mb-3">
            <x-button.success type="submit">
                Final
            </x-button.success>
        </div>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

</div>
