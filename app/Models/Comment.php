<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'comment_id';
    protected $fillable = ['complaint_id', 'user_id', 'comment_text'];

    public function complaint(){
        return $this->belongsTo(Complaint::class, 'complaint_id', 'complaint_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
