<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Complaint;

class LikeController extends Controller
{
    public function toggle($id) {
        $complaint = Complaint::where('complaint_id', $id)->first();

        if (!$complaint) {
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        $existing = Like::where('complaint_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json([
                'message' => 'Unliked',
                'liked'   => false,
                'count'   => Like::where('complaint_id', $id)->count()
            ]);
        }

        Like::create([
            'complaint_id' => $id,
            'user_id'      => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Liked',
            'liked'   => true,
            'count'   => Like::where('complaint_id', $id)->count()
        ]);
    }

    public function count($id) {
        return response()->json([
            'count' => Like::where('complaint_id', $id)->count(),
            'liked' => Like::where('complaint_id', $id)
                ->where('user_id', auth()->id())
                ->exists()
        ]);
    }
}