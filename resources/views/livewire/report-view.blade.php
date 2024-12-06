<div>
    <!-- Buttons to toggle between List view and Count view -->
    <div class="d-flex justify-content-end mb-4">
        <button wire:click="setViewMode('list')" class="btn btn-primary mx-2">
            Show List
        </button>
        <button wire:click="setViewMode('count')" class="btn btn-secondary">
            Show Count
        </button>
    </div>

    <!-- List View (shown by default) -->
    @if ($viewMode === 'list')
        <h5>User List:</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($fields as $field)
                        <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        @foreach ($fields as $field)
                            <td>{{ $user->$field }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Count View -->
    @if ($viewMode === 'count')
        <h5>Total Verified Users: {{ $users->count() }}</h5>
    @endif

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('SelectReport') }}" class="btn btn-success">Back</a>
    </div>
</div>
