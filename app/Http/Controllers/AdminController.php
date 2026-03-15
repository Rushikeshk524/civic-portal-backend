<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
class AdminController extends Controller
{
    public function allComplaints(Request $request){
        $complaints = Complaint::with(['user', 'category', 'department', 'location', 'images'])
            ->latest()
            ->get();

        return response()->json($complaints);
    }
    public function assign(Request $request, $id){
        $request->validate([
            'department_id' => 'required|exists:departments,department_id',
        ]);

        $complaint = Complaint::where('complaint_id', $id)->first();

        if(!$complaint){
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        $complaint->update([
            'department_id' => $request->department_id,
            'status' => 'in_progress',
        ]);

        ComplaintStatusHistory::create([
            'complaint_id' => $complaint->complaint_id,
            'changed_by' => auth()->id(),
            'old_status' => 'pending',
            'new_status' => 'in_progress',
            'notes' => 'Assigned to department',
        ]);

        return response()->json([
            'message' => 'complaint assigned successfully',
            'complaint' => $complaint->load('department')
        ]);
    }

    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'notes' => 'nullable|string',
        ]);

        $complaint = Complaint::where('complaint_id', $id)->first();

        if(!$complaint){
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        $oldStatus = $complaint->status;

        $complaint->update([
            'status' => $request->status,
        ]);

        ComplaintStatusHistory::create([
            'complaint_id' => $complaint->complaint_id,
            'changed_by' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'message' =>'Status updated successfully',
            'complaint' => $complaint
        ]);
    }

    public function stats(){
        try {
        return response()->json([
            'total' => Complaint::count(),
            'pending' => Complaint::where('status', 'pending')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}
