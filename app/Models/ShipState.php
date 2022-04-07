<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shipdivision()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }

    public function shipdistrict()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }
}
