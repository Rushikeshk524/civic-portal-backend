<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $primaryKey = 'like_id';

    protected $fillable = [
        'complaint_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function complaint() {
        return $this->belongsTo(Complaint::class, 'complaint_id', 'complaint_id');
    }
}