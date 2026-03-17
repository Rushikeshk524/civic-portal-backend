<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Complaint;

class CommentController extends Controller
{
    public function index($id) {
        $comments = Comment::where('complaint_id', $id)
            ->with('user')
            ->latest()
            ->get();

        return response()->json($comments);
    }

    public function store(Request $request, $id) {
        $request->validate([
            'comment_text' => 'required|string|max:500',
        ]);

        $complaint = Complaint::where('complaint_id', $id)->first();

        if (!$complaint) {
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        $comment = Comment::create([
            'complaint_id' => $id,
            'user_id'      => auth()->id(),
            'comment_text' => $request->comment_text,
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment->load('user')
        ], 201);
    }
}