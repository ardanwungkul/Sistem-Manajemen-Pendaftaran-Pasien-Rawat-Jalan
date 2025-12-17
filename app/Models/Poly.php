<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poly extends Model
{
    use HasFactory;
    public function doctor()
    {
        return $this->hasMany(Doctor::class, 'poly_id');
    }
}
