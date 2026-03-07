<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintStatusHistory extends Model
{
    protected $primaryKey = 'history_id';
    protected $table = 'complaint_status_history';
    protected $fillable = ['complaint_id', 'changed_by', 'old_status', 'new_status', 'notes'];

    public function complaint(){
        return $this->belongsTo(Complaint::class, 'complaint_id', 'complaint_id');
    }

    public function changed_by(){
        return $this->belongsTo(User::class, 'changed_by', 'id');
    }
}
