<x-app-layout>
    <x-slot name="title">
        <h1>{{ Auth::user()->role_id == 2 ? 'Verifier Edit Verification' : 'Approver Edit Verification' }}</h1>
    </x-slot>

    <x-slot name="content">
        <section class="content row">
            <!-- Filter Dropdown -->
            <div class="mb-3">
                <label for="filter-status" class="form-label">Filter by Status:</label>
                <select id="filter-status">
                    @if (Auth::user()->role_id == 2)
                        <option value="pending" {{ $status == '1' ? 'selected' : '' }}>Pending</option>
                        <option value="verified" {{ $status == '2' ? 'selected' : '' }}>Verified</option>
                        <option value="revert" {{ $status == '0' ? 'selected' : '' }}>Revert</option>
                    @elseif(Auth::user()->role_id == 3)
                        <option value="pending" {{ $status == '2' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $status == '3' ? 'selected' : '' }}>Approved</option>
                        <option value="revert" {{ $status == '0' ? 'selected' : '' }}>Revert</option>
                    @endif
                </select>
            </div>

            <!-- Table with Records -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @if (Auth::user()->role_id == 2 && $status == 1)
                            <th><input type="checkbox" id="select-all"></th>
                        @endif
                        @if (Auth::user()->role_id == 3 && $status == 2)
                            <th><input type="checkbox" id="select-all"></th>
                        @endif
                        <th>Token ID</th>
                        <th>Beneficiary ID</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Aadhar No</th>
                        <th>Selected Documents</th>
                        <th>Status</th>
                        <th>Action</th> <!-- Add action column -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            @if (Auth::user()->role_id == 2 && $status == 1)
                                <td><input type="checkbox" class="select-record" data-token-id="{{ $record->token_id }}" data-beneficiary-id="{{ $record->beneficiary_id }}"></td>
                            @endif
                            @if (Auth::user()->role_id == 3 && $status == 2)
                                <td><input type="checkbox" class="select-record" data-token-id="{{ $record->token_id }}" data-beneficiary-id="{{ $record->beneficiary_id }}"></td>
                            @endif
                            <td>{{ $record->token_id }}</td>
                            <td>{{ $record->beneficiary_id }}</td>
                            <td>{{ $record->beneficiary_name }}</td>
                            <td>{{ $record->mobile_no }}</td>
                            <td>{{ $record->aadhar_no }}</td>
                            <td>{{ $record->selected_documents }}</td>
                            <td>
                                @if (Auth::user()->role_id == 2)
                                    @if ($record->is_changed == 1)
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($record->is_changed == 2)
                                        <span class="badge bg-success">Verified</span>
                                    @elseif ($record->is_changed == 0)
                                        <span class="badge bg-danger">Revert</span>
                                    @endif
                                @endif
                                @if (Auth::user()->role_id == 3)
                                    @if ($record->is_changed == 2)
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($record->is_changed == 0)
                                        <span class="badge bg-danger">Revert</span>
                                    @elseif ($record->is_changed == 3)
                                        <span class="badge bg-primary">Approved</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->role_id == 2 && $record->is_changed == 1)
                                    <button class="btn btn-success btn-verify" data-token-id="{{ $record->token_id }}" data-beneficiary-id="{{ $record->beneficiary_id }}">Verify</button>
                                    <button class="btn btn-danger btn-revert" data-token-id="{{ $record->token_id }}" data-beneficiary-id="{{ $record->beneficiary_id }}">Revert</button>
                                @endif
                                @if (Auth::user()->role_id == 3 && $record->is_changed == 2)
                                    <button class="btn btn-primary btn-approve" data-token-id="{{ $record->token_id }}" data-beneficiary-id="{{ $record->beneficiary_id }}">Approve</button>
                                    <button class="btn btn-danger btn-revert" data-token-id="{{ $record->token_id }}" data-beneficiary-id="{{ $record->beneficiary_id }}">Revert</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Handle status filter change
                $('#filter-status').on('change', function() {
                    const status = $(this).val();
                    const url = new URL(window.location.href);
                    url.searchParams.set('status', status);
                    window.location.href = url.href;
                });

                // Handle Verify button click for role 2 (Verifier)
                $('.btn-verify').on('click', function() {
                    const tokenId = $(this).data('token-id');
                    const beneficiaryId = $(this).data('beneficiary-id');

                    // Perform the action to verify
                    updateStatus(tokenId, beneficiaryId, 'verify');
                });

                // Handle Approve button click for role 3 (Approver)
                $('.btn-approve').on('click', function() {
                    const tokenId = $(this).data('token-id');
                    const beneficiaryId = $(this).data('beneficiary-id');

                    // Perform the action to approve
                    updateStatus(tokenId, beneficiaryId, 'approve');
                });

                // Handle Revert button click
                $('.btn-revert').on('click', function() {
                    const tokenId = $(this).data('token-id');
                    const beneficiaryId = $(this).data('beneficiary-id');

                    // Perform the action to revert
                    updateStatus(tokenId, beneficiaryId, 'revert');
                });

                // Update the status based on the action (verify, approve, revert)
                function updateStatus(tokenId, beneficiaryId, action) {
                    $.ajax({
                        url: '/bulk-action',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            records: [{
                                token_id: tokenId,
                                beneficiary_id: beneficiaryId
                            }],
                            action: action
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function(error) {
                            alert('An error occurred while performing the action.');
                        }
                    });
                }
            });
        </script>
    </x-slot>
</x-app-layout>
