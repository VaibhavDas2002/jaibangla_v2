<x-app-layout>
    <x-slot name="title">
        <h1>Beneficiary Edit Page</h1>
    </x-slot>
    <x-slot name="content">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <section class="content row">
            <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
            <!-- Filter Form Section -->
            <div id="filterSection" class="row">
                <!-- Search Criteria -->
                <div class="col-3">
                    <label for="schemes">Select Scheme:</label><br>
                    <select id="schemes" name="schemes" class="form-select">
                        <option value="">Select Search Scheme</option>
                        @foreach ($schemes as $scheme)
                            <option value="{{ $scheme->id }}">{{ $scheme->scheme_name }}</option>
                        @endforeach
                    </select>

                    <label for="searchCriteria" class="form-label mt-2">Search By:</label><br>
                    <select id="searchCriteria" name="searchCriteria" class="form-select">
                        <option value="">Select Search Criteria</option>
                        <option value="beneficiary_id">Beneficiary ID</option>
                        <option value="mobile_no">Mobile Number</option>
                        <option value="aadhar_no">Aadhar Card</option>
                        <!-- <option value="bank_code">Bank AC No.</option> -->
                        <option value="beneficiary_name">Name</option>
                        <option value="token_id">Token No</option>
                    </select>

                    <label class="form-label mt-2" id="searchValueLabel" for="searchValue" style="display: none;">Enter
                        Search Value:</label><br>
                    <input class="form-control" type="text" id="searchValue" name="searchValue"
                        style="display: none;" required>
                    <button type="button" id="submitSearch" class="m-2 btn btn-outline-success">Find Applicant</button>
                </div>

            </div>

            <!-- Temporary Table Section -->
            <div id="temporaryTableSection" class="col-12 mt-4" style="display: none;">
                <h2>List of Changes</h2>
                <table border="1" style="width: 100%;" class="table" id="temporaryTable">
                    <thead>
                        <tr>
                            <th>Beneficiary ID</th>
                            <th>Token No</th>
                            <th>Beneficiary Name</th>
                            <th>Mobile No</th>
                            <th>Aadhar No</th>
                            <th>Selected Documents</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Added records will appear here -->
                    </tbody>
                </table>
            </div>

        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Show or hide Search Value field based on Search Criteria
                $('#searchCriteria').on('change', function() {
                    const selectedCriteria = $(this).val();
                    if (selectedCriteria) {
                        $('#searchValueLabel, #searchValue').show();
                        $('#searchValue').attr('placeholder', 'Enter ' + $(this).find('option:selected')
                    .text());
                    } else {
                        $('#searchValueLabel, #searchValue').hide();
                    }
                });

                // Find Applicants by criteria
                $('#submitSearch').on('click', function() {
                    const schemeId = $('#schemes').val();
                    const searchCriteria = $('#searchCriteria').val();
                    const searchValue = $('#searchValue').val();

                    if (!schemeId || !searchCriteria || !searchValue) {
                        $('#errorMessage').text(
                            'Please select a scheme, search criteria, and enter a search value.').show();
                        return;
                    }

                    $.ajax({
                        url: "{{ route('findApplicants') }}",
                        type: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            schemes: schemeId,
                            searchCriteria: searchCriteria,
                            searchValue: searchValue,
                        },
                        success: function(response) {
                            $('#errorMessage').hide();
                            const data = response.data;
                            const tableBody = $('#temporaryTable tbody');
                            tableBody.empty();

                            if (data.length === 0) {
                                tableBody.append('<tr><td colspan="7">No records found</td></tr>');
                            } else {
                                $('#temporaryTableSection').show();
                                data.forEach((record) => {
                                    const buttonClass = record.is_changed === 1 ?
                                        'btn-secondary' : 'btn-warning';
                                    tableBody.append(`
                                        <tr>
                                            <td>${record.beneficiary_id}</td>
                                            <td>${record.token_id}</td>
                                            <td>${record.beneficiary_name}</td>
                                            <td>${record.mobile_no}</td>
                                            <td>${record.aadhar_no}</td>
                                            <td>${record.selected_documents}</td>
                                            <td>
                                                ${record.is_changed === 1 || record.is_changed === 2
                                                    ? '<span class="badge bg-secondary">Under Process</span>'
                                                    : record.is_changed === 3
                                                    ? '<span class="badge bg-success">Completed</span>'
                                                    : '<button class="btn btn-warning btn-sm edit-row" data-token-id="' + record.token_id + '" data-beneficiary-id="' + record.beneficiary_id + '">Edit</button>'
                                                }
                                            </td>

                                        </tr>

                                    `);
                                });
                            }
                        },
                        error: function() {
                            $('#errorMessage').text('An unexpected error occurred.').show();
                        },
                    });
                });

                // Handle edit
                $(document).on('click', '.edit-row', function() {
                    const tokenId = $(this).data('token-id');
                    const beneficiaryId = $(this).data('beneficiary-id'); // Get the beneficiary_id
                    window.location.href = "{{ route('editBeneficiaryPage') }}?token_id=" + tokenId +
                        "&beneficiary_id=" + beneficiaryId;
                });
            });
        </script>
    </x-slot>
</x-app-layout>
