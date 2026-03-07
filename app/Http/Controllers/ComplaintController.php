<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;

class ComplaintController extends Controller
{
    public function index(Request $request) {
        $complaints = Complaint::where('user_id', auth()->id())
            ->with(['category', 'department', 'location', 'images'])
            ->latest()
            ->get();

        return response()->json($complaints);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,category_id',
            'location_id' => 'nullable|exists:locations,location_id',
            'image_url' => 'nullable|string',
        ]);

        $complaint = Complaint::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        if($request->image_url){
            $complaint->images()->create([
                'image_url' => $request->image_url
            ]);
        }

        return response()->json([
            'message' => 'Complaint submitted sucessfully',
            'complaint' => $complaint->load('category', 'location', 'images')
        ], 201);
    }

    public function show($id){
        $complaint = Complaint::where('complaint_id', $id)
            ->where('user_id', auth()->id())
            ->with(['category', 'department', 'location', 'images', 'statusHIstory'])
            ->first();
        
        if(!$complaint){
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        return response()->json($complaint);
    }
}
