<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tokenverificationController extends Controller

{
    public function tokenVerification(Request $request)
    {
        // Example: Retrieve user role from session or auth
        $userRole = Auth::user()->role_id; // Assuming role_id is stored in the user model

        // Define status mappings for verifier and approver
        $statusMapping = [
            2 => [ // Verifier
                'pending' => 1,
                'verified' => 2,
                'rejected' => 0,
            ],
            3 => [ // Approver
                'pending' => 2,
                'approved' => 3,
                'rejected' => 0,
            ],
        ];

        // Default to verifier status mapping if role is not explicitly handled
        $roleStatusMapping = $statusMapping[$userRole] ?? $statusMapping[2];

        // Determine the requested status
        $statusKey = $request->input('status', 'pending');
        $status = $roleStatusMapping[$statusKey] ?? reset($roleStatusMapping); // Default to the first status if invalid

        
        // Query the tokenPresent list
        $tokenPresent = DB::table('beneficiary_modifications')
            ->join('m_doc_modification', 'beneficiary_modifications.selected_documents_id', '=', 'm_doc_modification.id')
            ->select(
                'beneficiary_modifications.token_id',
                DB::raw("STRING_AGG(DISTINCT m_doc_modification.doc_name, ', ') as document_type"),
                DB::raw('COUNT(beneficiary_modifications.beneficiary_id) as beneficiary_count'),
                'beneficiary_modifications.status'
            )
            ->where('beneficiary_modifications.status', $status)
            ->groupBy('beneficiary_modifications.token_id', 'beneficiary_modifications.status')
            ->paginate(1);

        // Return the view with relevant data
        return view('components.tokenVerify.tokenVerification', compact('tokenPresent', 'status', 'statusKey', 'userRole'));
    }



    public function getTokenDetails($token_id)
    {
        // dd($token_id);
        $details = DB::table('beneficiary_modifications')
            ->join('m_doc_modification', 'beneficiary_modifications.selected_documents_id', '=', 'm_doc_modification.id') // Join with documents table
            ->join('m_scheme', 'beneficiary_modifications.scheme_id', '=', 'm_scheme.id') // Join with schemes table
            ->where('token_id', $token_id)
            ->select(
                'token_id',
                'beneficiary_modifications.beneficiary_id',
                'beneficiary_modifications.beneficiary_name',
                'beneficiary_modifications.mobile_no',
                'beneficiary_modifications.aadhar_no',
                'm_scheme.scheme_name as scheme_name', // Select scheme name
                'm_doc_modification.doc_name as document_name', // Select document name
                'beneficiary_modifications.status'
            )
            ->distinct()
            ->get();

        return response()->json($details);
    }


    public function bulkAction(Request $request)
    {
        $currentUser = Auth::user();

        // Fetch the current user's role details
        $currentUserRole = DB::table('designation')->where('id', $currentUser->role_id)->first();

        if (!$currentUserRole) {
            return redirect()->back()->with('error', 'User role not found.');
        }

        // Get inputs from the request
        $action = $request->input('bulk_action');
        $tokenIds = $request->input('token_ids', []);

        // Validate input: Ensure tokens are selected
        if (empty($tokenIds)) {
            return redirect()->back()->with('error', 'No tokens selected for the bulk action.');
        }

        // Define valid actions based on user roles
        $roleActions = [
            2 => [1, 2], // Verifier: Pending (1), Verified (2)
            3 => [2, 3], // Approver: Pending (2), Approved (3)
        ];

        // Check if the role supports the requested action
        $validActions = $roleActions[$currentUser->role_id] ?? [];
        if (!in_array($action, $validActions)) {
            return redirect()->back()->with('error', 'Invalid action for your role.');
        }

        // Perform the bulk update for the provided token IDs
        DB::table('beneficiary_modifications')
            ->whereIn('token_id', $tokenIds)
            ->update(['status' => $action]);

        // Provide success feedback
        $actionLabel = ($action == 2) ? 'Verified' : 'Approved';
        return redirect()->back()->with('success', "Bulk action completed successfully. Tokens have been {$actionLabel}.");
    }

    public function updateStatus(Request $request)
    {
        $currentUser = Auth::user();

        // Fetch the current user's role details
        $currentUserRole = DB::table('designation')->where('id', $currentUser->role_id)->first();
        if (!$currentUserRole) {
            return response()->json(['success' => false, 'message' => 'User role not found.'], 404);
        }
        // Get inputs from the request
        $tokenId = $request->input('token_id');
        $action = $request->input('action');
        if (!$tokenId) {
            return response()->json(['success' => false, 'message' => 'Token not found.'], 404);
        }
        // Define valid actions based on user roles
        $roleActions = [
            2 => [1, 2, 0], // Verifier: Pending (1), Verified (2), Rejected (0)
            3 => [2, 3, 0], // Approver: Pending (2), Approved (3), Rejected (0)
        ];

        // Check if the role supports the requested action
        $validActions = $roleActions[$currentUser->role_id] ?? [];
        if (!in_array($action, $validActions)) {
            return response()->json(['success' => false, 'message' => 'Invalid action for your role.'], 403);
        }

        // Ensure the token exists
        $token = DB::table('beneficiary_modifications')
            ->where('token_id', $tokenId)
            ->distinct()
            ->get(['beneficiary_id']);

        // Prepare update data
        $updateData = ['status' => $action];

        if ($action == 0) { // Rejected case
            foreach ($token as $ben_person) {
                DB::table('pension.beneficiaries')->where('id', $ben_person->beneficiary_id)
                    ->update(['process_edit_status' => 0]);
            }

            $updateData['rejected_by_id'] = $currentUser->id;
            $updateData['rejected_by'] = $currentUserRole->name;
            $updateData['rejected_time'] = now();
        }

        // Update the database
        DB::table('beneficiary_modifications')
            ->where('token_id', $tokenId)
            ->update($updateData);
        // $updatebenSatus['process_edit_status'] = 1;
        // DB::table('pension.beneficiaries')->where('id', $beneficiaryId)->update($updatebenSatus);
        // Return success response
        $actionLabel = ($action == 0) ? 'Rejected' : (($action == 2) ? 'Verified' : 'Approved');
        return response()->json(['success' => true, 'status' => $action, 'message' => "Token successfully {$actionLabel}."]);
    }
}
