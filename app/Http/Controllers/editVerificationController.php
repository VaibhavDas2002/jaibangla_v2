<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditVerificationController extends Controller
{
    // Method to handle both bulk verify and bulk approve actions
    public function bulkAction(Request $request)
    {
        $records = $request->input('records', []);
        $action = $request->input('action', 'verify');

        if (empty($records)) {
            return response()->json(['message' => 'No records selected for action.'], 400);
        }

        foreach ($records as $record) {
            if (!isset($record['token_id']) || !isset($record['beneficiary_id'])) {
                return response()->json(['message' => 'Missing required fields for some records.'], 400);
            }
        }

        try {
            foreach ($records as $record) {
                $updateData = [];

                if ($action == 'verify') {
                    $updateData['is_changed'] = 2;  // Set 'verified' for bulk verify
                } elseif ($action == 'approve') {
                    $updateData['is_changed'] = 3;  // Set 'approved' for bulk approve
                } elseif ($action == 'revert') {
                    $updateData['is_changed'] = 0;  // Revert the record
                }

                DB::table('beneficiary_modifications')  // Replace with actual table name
                    ->where('token_id', $record['token_id'])
                    ->where('beneficiary_id', $record['beneficiary_id'])
                    ->update($updateData);
            }

            return response()->json(['message' => 'Action successfully completed.']);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating records.'], 500);
        }
    }

    // Method to display the verification/edit verification page based on the user's role
    public function editVerification(Request $request)
    {
        // Get the user's role ID
        $userRole = Auth::user()->role_id;

        // Define status mappings for verifier and approver roles
        $statusMapping = [
            2 => [ // Verifier
                'pending' => 1,
                'verified' => 2,
                'revert' => 0,
            ],
            3 => [ // Approver
                'pending' => 2,
                'approved' => 3,
                'revert' => 0,
            ],
        ];

        // Default to verifier status mapping if role is not explicitly handled
        $roleStatusMapping = $statusMapping[$userRole] ?? $statusMapping[2];

        // Determine the requested status
        $statusKey = $request->input('status', 'pending');
        $status = $roleStatusMapping[$statusKey] ?? reset($roleStatusMapping);

        // Retrieve records based on the selected status
        $records = DB::table('beneficiary_modifications')
            ->join('m_doc_modification', 'beneficiary_modifications.selected_documents_id', '=', 'm_doc_modification.id')
            ->select(
                'beneficiary_modifications.token_id',
                'beneficiary_modifications.beneficiary_id',
                'beneficiary_modifications.beneficiary_name',
                'beneficiary_modifications.mobile_no',
                'beneficiary_modifications.aadhar_no',
                'beneficiary_modifications.is_changed',
                DB::raw("STRING_AGG(m_doc_modification.doc_name, ', ') as selected_documents")
            )
            ->where('beneficiary_modifications.is_changed', $status)
            ->groupBy(
                'beneficiary_modifications.token_id',
                'beneficiary_modifications.beneficiary_id',
                'beneficiary_modifications.beneficiary_name',
                'beneficiary_modifications.mobile_no',
                'beneficiary_modifications.aadhar_no',
                'beneficiary_modifications.is_changed'
            )
            ->get();

        // Return the view with the necessary data
        return view('components.editVerify.editVerification', compact('records', 'status', 'statusKey', 'userRole'));
    }
}
