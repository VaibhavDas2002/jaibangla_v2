<x-app-layout>
    <x-slot name="title">
        <h1>{{ Auth::user()->role_id == 2 ? 'Verifier Token' : 'Approver Token' }}</h1>
    </x-slot>
    <x-slot name="content">
        <section class="content row">
            <!-- Dropdown for status filter -->
            <form method="GET" action="{{ route('token.verification') }}">
                <label for="status">Filter by Status:</label>
                <select name="status" id="status" onchange="this.form.submit()">
                    @if (Auth::user()->role_id == 2)
                    <option value="pending" {{ $status == '1' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ $status == '2' ? 'selected' : '' }}>Verified</option>
                    <option value="rejected" {{ $status == '0' ? 'selected' : '' }}>Rejected</option>
                    @elseif(Auth::user()->role_id == 3)
                    <option value="pending" {{ $status == '2' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $status == '3' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $status == '0' ? 'selected' : '' }}>Rejected</option>
                    @endif
                </select>
            </form>
            <form method="POST" action="{{ route('token.bulk.action') }}">
                @csrf
                @if (Auth::user()->role_id == 2 && $status == 1)
                <button type="submit" name="bulk_action" value="2" class="btn btn-primary my-2">
                    Bulk Verify
                </button>
                @endif
                @if (Auth::user()->role_id == 3 && $status == 2)
                <button type="submit" name="bulk_action" value="3" class="btn btn-primary my-2">
                    Bulk Approve
                </button>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            @if (Auth::user()->role_id == 2 && $status == 1)
                            <th>
                                <input type="checkbox" id="select-all">
                            </th>
                            @endif
                            @if (Auth::user()->role_id == 3 && $status == 2)
                            <th>
                                <input type="checkbox" id="select-all">
                            </th>
                            @endif
                            <th>Token Number</th>
                            <th>Document Type</th>
                            <th>No.</th>
                            <th>Status</th>
                            @if (Auth::user()->role_id == 2 && $status == 1)
                            <th>Action</th>
                            @endif
                            @if (Auth::user()->role_id == 3 && $status == 2)
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tokenPresent as $token)
                        <tr>
                            @if (Auth::user()->role_id == 2 && $status == 1)
                            <td>
                                <input type="checkbox" name="token_ids[]" value="{{ $token->token_id }}">
                            </td>
                            @endif
                            @if (Auth::user()->role_id == 3 && $status == 2)
                            <td>
                                <input type="checkbox" name="token_ids[]" value="{{ $token->token_id }}">
                            </td>
                            @endif
                            <td>{{ $token->token_id }}</td>
                            <td>{{ $token->document_type }}</td>
                            {{-- <td>{{ $token->beneficiary_count }}</td> --}}
                            <td>
                                <a href="#" class="view-details" data-id="{{ $token->token_id }}">
                                    {{ $token->beneficiary_count }}
                                </a>
                            </td>
                            <td>
                                @if (Auth::user()->role_id == 2)
                                @if ($token->status == 1)
                                <span class="badge bg-warning">Pending</span>
                                @elseif ($token->status == 2)
                                <span class="badge bg-success">Verified</span>
                                @elseif ($token->status == 0)
                                <span class="badge bg-danger">Rejected</span>
                                @else
                                <span class="badge bg-secondary">Unknown</span>
                                @endif
                                @endif
                                @if (Auth::user()->role_id == 3)
                                @if ($token->status == 2)
                                <span class="badge bg-warning">Pending</span>
                                @elseif ($token->status == 3)
                                <span class="badge bg-success">Approved</span>
                                @elseif ($token->status == 0)
                                <span class="badge bg-danger">Rejected</span>
                                @else
                                <span class="badge bg-secondary">Unknown</span>
                                @endif
                                @endif
                            </td>
                            @if (Auth::user()->role_id == 2 && $status == 1)
                            <td>
                                <button type="button" class="btn btn-success btn-sm Verify-btn"
                                    data-id="{{ $token->token_id }}">Verify</button>
                                <button type="button" class="btn btn-danger btn-sm reject-btn"
                                    data-id="{{ $token->token_id }}">Reject</button>
                            </td>
                            @endif
                            @if (Auth::user()->role_id == 3 && $status == 2)
                            <td>
                                <button type="button" class="btn btn-success btn-sm Approve-btn"
                                    data-id="{{ $token->token_id }}">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm reject-btn"
                                    data-id="{{ $token->token_id }}">Reject</button>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <td colspan="6" class="mx-auto text-center"> No records found.</td>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="col-3 container d-flex ">
                    {{ $tokenPresent->appends(['status' => $statusKey])->links() }}
                </div> --}}
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            @if ($tokenPresent->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $tokenPresent->previousPageUrl() }}&status={{ $statusKey }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span> Previous
                                </a>
                            </li>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($tokenPresent->getUrlRange(1, $tokenPresent->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $tokenPresent->currentPage() ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ $url }}&status={{ $statusKey }}">{{ $page }}</a>
                            </li>
                            @endforeach

                            <!-- Next Page Link -->
                            @if ($tokenPresent->hasMorePages())
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $tokenPresent->nextPageUrl() }}&status={{ $statusKey }}"
                                    aria-label="Next">
                                    Next <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel">Beneficiary Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Beneficiary ID</th>
                                            <th>Beneficiary Name</th>
                                            <th>Mobile No</th>
                                            <th>Aadhar No</th>
                                            <th>Scheme ID</th>
                                            <th>Selected Documents ID</th>
                                            {{-- <th>Status</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="modalTableBody">
                                        <!-- Rows will be populated dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.view-details').on('click', function(e) {
                    e.preventDefault();

                    // Get the token_id
                    const tokenId = $(this).data('id');

                    // Clear previous modal content
                    $('#modalTableBody').html('<tr><td colspan="7">Loading...</td></tr>');

                    // Fetch data using AJAX
                    $.ajax({
                        url: `/token-details/${tokenId}`,
                        method: 'GET',
                        success: function(response) {
                            if (response.length) {
                                // Populate modal with data
                                const rows = response.map(item => `
                        <tr>
                            <td>${item.beneficiary_id}</td>
                            <td>${item.beneficiary_name}</td>
                            <td>${item.mobile_no}</td>
                            <td>${item.aadhar_no}</td>
                            <td>${item.scheme_name}</td>
                            <td>${item.document_name}</td>
                        </tr>
                    `).join('');
                                $('#modalTableBody').html(rows);
                            } else {
                                $('#modalTableBody').html(
                                    '<tr><td colspan="6">No records found.</td></tr>');
                            }

                            // Show the modal
                            $('#detailsModal').modal('show');
                        },
                        error: function() {
                            $('#modalTableBody').html(
                                '<tr><td colspan="6">Error loading data.</td></tr>');
                        }
                    });
                });
            });

            // Select/Deselect all checkboxes
            document.getElementById('select-all').addEventListener('click', function() {
                let checkboxes = document.querySelectorAll('input[name="token_ids[]"]');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });

            // Approve button handler
            document.querySelectorAll('.Verify-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let tokenId = this.dataset.id;
                    updateStatus(tokenId, 2);
                });
            });

            document.querySelectorAll('.Approve-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let tokenId = this.dataset.id;
                    updateStatus(tokenId, 3);
                });
            });

            // Reject button handler
            document.querySelectorAll('.reject-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let tokenId = this.dataset.id;
                    updateStatus(tokenId, 0);
                });
            });

            // Function to handle approve/reject AJAX
            function updateStatus(tokenId, action) {
                fetch(`{{ route('token.update.status') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            token_id: tokenId,
                            action: action
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Status updated successfully.');
                            location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    });
            }
        </script>
    </x-slot>
</x-app-layout>