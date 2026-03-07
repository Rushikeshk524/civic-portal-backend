<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $primaryKey = 'location_id';
    protected $fillable = ['area_name', 'pincode','latitude','longitude'];

    public function complaints() {
        return $this->hasMany(complaint::class, 'location_id', 'location_id');
    }
}
