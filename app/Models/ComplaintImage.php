<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintImage extends Model
{
    protected $table      = 'complaint_images';  // ← add this
    protected $primaryKey = 'image_id';          // ← fix typo (was primarkyKey)

    protected $fillable = [
        'complaint_id',
        'image_url',
    ];

    public function complaint() {
        return $this->belongsTo(Complaint::class, 'complaint_id', 'complaint_id');
    }
}