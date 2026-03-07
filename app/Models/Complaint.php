<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $primaryKey = 'complaint_id';
    protected $fillable = [
        'user_id', 'category_id', 'department_id',
        'location_id', 'title', 'description', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }
    public function location(){
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }
    public function images(){
        return $this->hasMany(ComplaintImage::class, 'complaint_id', 'complaint_id');
    }
    public function statusHistory() {
        return $this->hasMany(ComplaintStatusHistory::class, 'complaint_id', 'complaint_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'complaint_id', 'complaint_id');
    }
    public function likes() {
        return $this->hasMany(Like::class, 'complaint_id', 'complaint_id');
    }
}
