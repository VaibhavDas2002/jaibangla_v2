<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class DutyManagementTable extends Component
{
    use WithPagination;

    public $perPage = 10; // Default items per page
    //protected $paginationTheme = 'bootstrap';
    public $confirmingDelete = false; // State for confirming deletion
    public $userIdToDelete; // Store the user ID to delete
    public $searchTerm = ''; // Search term

    public function updatingSearchTerm()
    {
        $this->resetPage(); // Reset to page 1 when search term changes
    }

    public function updatingPerPage()
    {
        $this->resetPage(); // Reset to page 1 when perPage changes
    }

    public function confirmSoftDelete($userId)
    {
        $this->userIdToDelete = $userId; // Store the ID of the user to delete
        $this->confirmingDelete = true; // Open the confirmation modal
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false; // Close the confirmation modal
        $this->userIdToDelete = null; // Clear the user ID
    }

    public function softDelete()
    {
        if ($this->userIdToDelete) {
            // Perform soft delete by setting is_deleted to true
            DB::table('users')->where('id', $this->userIdToDelete)->update(['is_deleted' => true]);
            session()->flash('success', 'User has been soft deleted successfully.');
            $this->confirmingDelete = false; // Close the confirmation modal
            $this->userIdToDelete = null; // Clear the user ID
            $this->resetPage(); // Optionally, refresh the user list
        }
    }

    public function render()
    {
        $searchTerm = '%' . strtolower($this->searchTerm) . '%'; // Prepare search term for query
        // Fetch paginated user data with roles, districts, blocks, subdivisions, and schemes
        $users = DB::table('users')
            ->leftJoin('designation', 'users.role_id', '=', 'designation.id')
            ->leftJoin('duty_assignement', 'users.id', '=', 'duty_assignement.user_id')
            ->leftJoin('m_district', 'duty_assignement.district_code', '=', 'm_district.district_code')
            ->leftJoin('m_block', 'duty_assignement.blk_subdiv_code', '=', 'm_block.block_code')
            ->leftJoin('m_sub_district', 'duty_assignement.blk_subdiv_code', '=', 'm_sub_district.sub_district_code')
            ->leftJoin('m_scheme', 'duty_assignement.scheme_id', '=', 'm_scheme.id')
            ->select(
                'users.id',
                'users.username',
                'users.mobile_no',
                'users.email',
                'designation.name as role_name',
                'm_district.district_name',
                'm_block.block_name',
                'm_sub_district.sub_district_name',
                DB::raw('string_agg(m_scheme.scheme_name, \', \') as scheme_names')
            )->where(function ($query) use ($searchTerm) {
                $query->where(DB::raw('LOWER(users.username)'), 'like', $searchTerm);
                    //   ->orWhere(DB::raw('LOWER(users.email)'), 'like', $searchTerm)
                    //   ->orWhere(DB::raw('LOWER(users.mobile_no)'), 'like', $searchTerm);
            })
            ->where(function ($query) {
                $query->where('users.is_deleted', false)
                      ->orWhereNull('users.is_deleted'); // Include users with is_deleted = false or is_deleted is null
            })
            ->groupBy(
                'users.id',
                'users.username',
                'users.mobile_no',
                'users.email',
                'designation.name',
                'm_district.district_name',
                'm_block.block_name',
                'm_sub_district.sub_district_name'
            )
            ->paginate($this->perPage); // Use pagination based on perPage
        return view('livewire.duty-management-table', [
            'users' => $users
        ]);
    }
}
