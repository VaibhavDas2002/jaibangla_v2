<x-app-layout>
    <x-slot name="title">
        <h1>Token Creation</h1>
    </x-slot>
    <x-slot name="content">
        <section class="content row">
            <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
            <!-- Filter Form Section -->
            <div id="filterSection" class="col-4">
                <form id="documentForm" class="row">
                    @csrf
                    <!-- Document Selection -->
                    <div class="col-6">
                        <label for="documents">Select Fields / Documents:</label><br>
                        <select id="documents" name="documents[]" multiple size="5" class="form-select">
                            @foreach ($docPresent as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->doc_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Search Criteria -->
                    <div class="col-6">
                        <label for="schemes">Select Scheme:</label><br>
                        <select id="schemes" name="schemes" class="form-select">
                            <option value="">Select Search Scheme</option>
                            @foreach ($schemes as $scheme)
                                <option value="{{ $scheme->id }}">{{ $scheme->scheme_name }}</option>
                            @endforeach
                        </select>
                        <label for="searchCriteria">Search By:</label><br>
                        <select id="searchCriteria" name="searchCriteria" class="form-select">
                            <option value="">Select Search Criteria</option>
                            <option value="id">Beneficiary ID</option>
                            <option value="mobile_no">Mobile Number</option>
                            <option value="aadhar_no">Aadhar Card</option>
                            <option value="bank_code">Bank AC No.</option>
                            <option value="ben_fname">First Name</option>
                        </select>
                        <label class="form-label mt-2" id="searchValueLabel" for="searchValue"
                            style="display: none;">Enter Search Value:</label><br>
                        <input class="form-control" type="text" id="searchValue" name="searchValue"
                            style="display: none;" required>
                        <button type="button" id="submitSearch" style="display: none;">Find Applicant</button>
                    </div>
                </form>
            </div>
            <!-- Search Results Section -->
            <div id="searchResults" class="results col-8">
                <!-- Search results will be injected here dynamically -->
            </div>
            <!-- Temporary Table Section -->
            <div id="temporaryTableSection" class="col-12 mt-4" style="display: none;">
                <h2>List of Changes</h2>
                <table border="1" style="width: 100%;" class="table" id="temporaryTable">
                    <thead>
                        <tr>
                            <th>Beneficiary ID</th>
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
                <button type="button" id="finalSubmit" class="btn btn-success mt-3">Final Submit</button>
            </div>
        </section>
        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to submit the selected records?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" id="confirmSubmit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            var addedRecords = []; // Store added records temporarily
            function showError(message) {
                $('#errorMessage').text(message).show();
            }
            $(document).ready(function() {
                function isDocumentSelected() {
                    return $('#documents option:selected').length > 0;
                }
                // Clear search results and temporary table when document selection changes
                $('#documents').on('change', function() {
                    // Clear search results
                    $('#searchResults').empty();
                    $('#errorMessage').hide();
                    // Clear temporary table and hide the section
                    addedRecords = [];
                    $('#temporaryTable tbody').empty();
                    $('#temporaryTableSection').hide();
                });

                $('#searchCriteria').on('change', function() {
                    $('#errorMessage').hide();
                    var selectedValue = $(this).val();
                    if (selectedValue) {
                        $('#searchValueLabel').text("Enter " + $('#searchCriteria option:selected').text() +
                            ":").show();
                        $('#searchValue, #submitSearch').show();
                    } else {
                        $('#searchValueLabel, #searchValue, #submitSearch').hide();
                    }
                });

                $('#submitSearch').on('click', function(e) {
                    e.preventDefault();
                    if (!isDocumentSelected()) {
                        alert("Please select at least one document.");
                        showError("Please select at least one document.");
                        return;
                    }
                    var searchCriteria = $('#searchCriteria').val();
                    var searchValue = $('#searchValue').val();
                    var schemes = $('#schemes').val();
                    var token = $('input[name="_token"]').val();

                    if (!searchValue) {
                        alert("Please enter a value in the search field."); // Display an alert if empty
                        showError("Please enter a value in the search field.");
                        return; // Stop the function here, so no request is made
                    }
                    $.ajax({
                        url: "{{ route('searchBeneficiaries') }}",
                        type: "POST",
                        data: {
                            _token: token,
                            searchCriteria: searchCriteria,
                            searchValue: searchValue,
                            schemes: schemes,
                        },
                        success: function(response) {
                            $('#errorMessage').hide();
                            var resultsHtml = '';
                            if (response.length > 0) {
                                resultsHtml += '<h2>Search Results:</h2>';
                                resultsHtml +=
                                    '<table border="1" style="width: 100%;" class="table">';
                                resultsHtml +=
                                    '<tr><th>Beneficiary ID</th><th>Beneficiary Name</th><th>Mobile No</th><th>Aadhar No</th><th></th></tr>';

                                $.each(response, function(index, result) {
                                    resultsHtml += '<tr>';
                                    resultsHtml += '<td>' + result.id + '</td>';
                                    resultsHtml += '<td>' + result.ben_fname + ' ' + result
                                        .ben_mname + ' ' + result.ben_lname + '</td>';
                                    resultsHtml += '<td>' + result.mobile_no + '</td>';
                                    resultsHtml += '<td>' + result.aadhar_no + '</td>';
                                    resultsHtml +=
                                        '<td>' +
                                        (result.process_edit_status === 1 ?
                                            '<span class="badge bg-secondary">Under Process</span>' :
                                            '<button type="button" class="btn btn-primary add-btn" data-id="' +
                                            result.id + '" data-name="' + result.ben_fname +
                                            ' ' + result.ben_mname + ' ' + result
                                            .ben_lname +
                                            '" data-mobile="' + result.mobile_no +
                                            '" data-aadhar="' + result.aadhar_no +
                                            '">Add to Modify</button>') +
                                        '</td>';
                                    resultsHtml += '</tr>';
                                });
                                resultsHtml += '</table>';
                            } else {
                                resultsHtml = '<p>No results found.</p>';
                            }
                            $('#searchResults').html(resultsHtml);
                        },
                        error: function(xhr) {
                            alert("An error occurred while processing the request.");
                            showError("An error occurred while processing the request.");
                        }
                    });
                });

                // Handle Add button click
                $(document).on('click', '.add-btn', function() {
                    var id = $(this).data('id');
                    var name = $(this).data('name');
                    var mobile = $(this).data('mobile');
                    var aadhar = $(this).data('aadhar');

                    // Retrieve selected document names
                    var selectedDocuments = [];
                    var selectedDocuments_text = [];
                    $('#documents option:selected').each(function() {
                        selectedDocuments.push($(this).val());

                        selectedDocuments_text.push($(this).text());

                    });

                    // Check if the record has already been added
                    if (!addedRecords.some(record => record.id === id)) {
                        addedRecords.push({
                            id,
                            name,
                            mobile,
                            aadhar,
                            selectedDocuments
                        });

                        // Create a new row in the temporary table
                        var rowHtml = '<tr data-id="' + id + '">';
                        rowHtml += '<td>' + id + '</td>';
                        rowHtml += '<td>' + name + '</td>';
                        rowHtml += '<td>' + mobile + '</td>';
                        rowHtml += '<td>' + aadhar + '</td>';
                        rowHtml += '<td>' + selectedDocuments_text.join(', ') + '</td>';
                        rowHtml += '<td><button type="button" class="btn btn-danger remove-btn" data-id="' +
                            id + '">Remove</button></td>';
                        rowHtml += '</tr>';

                        // Add the new row to the temporary table
                        $('#temporaryTable tbody').append(rowHtml);
                        $('#temporaryTableSection').show();

                        // Remove or hide the row from the search results table
                        $(this).closest('tr').remove();
                    }
                });


                // Handle Remove button click
                $(document).on('click', '.remove-btn', function() {
                    var id = $(this).data('id');
                    addedRecords = addedRecords.filter(record => record.id !== id);
                    $('#temporaryTable tbody tr[data-id="' + id + '"]').remove();

                    if (addedRecords.length === 0) {
                        $('#temporaryTableSection').hide();
                    }
                });
            });

            // $('#finalSubmit').on('click', function() {
            //     var token = $('input[name="_token"]').val();

            //     if (addedRecords.length === 0) {
            //         alert("No records to submit.");
            //         showError("No records to submit.");
            //         return;
            //     }
            //     schemes = $('#schemes').val()
            //     $.ajax({
            //         url: "{{ route('finalSubmit') }}", // You need to define this route
            //         type: "POST",
            //         data: {
            //             _token: token,
            //             records: addedRecords,
            //             schemes: schemes
            //         },
            //         success: function(response) {
            //             $('#errorMessage').hide();
            //             alert("Records submitted successfully!");
            //             window.location.reload();
            //             // Clear the temporary table and reset the addedRecords array
            //             addedRecords = [];
            //             //$('#temporaryTable tbody').empty();
            //             //$('#temporaryTableSection').hide();

            //         },
            //         error: function(xhr) {
            //             alert("An error occurred while submitting the records.");
            //             showError("An error occurred while processing the records.");
            //         }
            //     });
            // });
            $('#finalSubmit').on('click', function() {
                if (addedRecords.length === 0) {
                    alert("No records to submit.");
                    showError("No records to submit.");
                    return;
                }
                // Show confirmation modal
                $('#confirmationModal').modal('show');
            });

            $('#confirmSubmit').on('click', function() {
                var token = $('input[name="_token"]').val();
                var schemes = $('#schemes').val();

                $('#confirmationModal').modal('hide');

                $.ajax({
                    url: "{{ route('finalSubmit') }}", // Define this route in your web.php
                    type: "POST",
                    data: {
                        _token: token,
                        records: addedRecords,
                        schemes: schemes
                    },
                    success: function(response) {
                        $('#errorMessage').hide();
                        alert("Records submitted successfully!");
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert("An error occurred while submitting the records.");
                        showError("An error occurred while submitting the records.");
                    }
                });
            });
            // });
        </script>
    </x-slot>
</x-app-layout>
