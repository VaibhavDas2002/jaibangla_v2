<div>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-3">
                    <h5 class="mb-0">User Management</h5>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search users..." wire:model.live="searchTerm">
                </div>
                <div class="col-md-3 text-end">
                    <label class="me-2">
                        Show
                        <select wire:model.live="perPage" class="form-select form-select-sm d-inline-block" style="width: auto;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entries
                    </label>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Display Name</th>
                            <th>Role</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Schemes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->role_name }}</td>
                            <td>{{ $user->mobile_no ?? 'N/A' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->district_name }}
                                @if($user->block_name)
                                    , {{ $user->block_name }}
                                @elseif($user->sub_district_name)
                                    , {{ $user->sub_district_name }}
                                @endif
                            </td>
                            <td>{{ $user->scheme_names ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('editUserForm', ['id' => $user->id]) }}" class="btn btn-outline-primary btn-sm me-2">Edit</a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" wire:click="confirmSoftDelete({{ $user->id }})">Delete</button>
                                </div>
                            </td>                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div class="text-muted">
                Showing 
                <strong>{{ $users->firstItem() }}</strong> to 
                <strong>{{ $users->lastItem() }}</strong> of 
                <strong>{{ $users->total() }}</strong> entries
            </div>
            <div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" wire:click.prevent="previousPage" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
        
                        @php
                            $currentPage = $users->currentPage();
                            $lastPage = $users->lastPage();
                            $visiblePages = 5; // Number of page links to show
                            $start = max(1, $currentPage - floor($visiblePages / 2));
                            $end = min($lastPage, $start + $visiblePages - 1);
        
                            if ($start > 1) {
                                // Show first page
                                echo '<li class="page-item"><a class="page-link" wire:click.prevent="gotoPage(1)">1</a></li>';
                                if ($start > 2) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        @endphp
        
                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                <a class="page-link" wire:click.prevent="gotoPage({{ $i }})">{{ $i }}</a>
                            </li>
                        @endfor
        
                        @php
                            if ($end < $lastPage) {
                                if ($end < $lastPage - 1) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                // Show last page
                                echo '<li class="page-item"><a class="page-link" wire:click.prevent="gotoPage(' . $lastPage . ')">' . $lastPage . '</a></li>';
                            }
                        @endphp
        
                        <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" wire:click.prevent="nextPage" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        
    </div>
    <!-- Confirmation Modal -->
@if($confirmingDelete)
<div class="modal fade show" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" wire:click="cancelDelete" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="cancelDelete">Cancel</button>
                <button type="button" class="btn btn-danger" wire:click="softDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
@endif

     
</div>
