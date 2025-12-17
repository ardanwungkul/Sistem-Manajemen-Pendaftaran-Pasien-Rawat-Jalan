<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'poly_id'];

    public function poly()
    {
        return $this->belongsTo(Poly::class, 'poly_id');
    }
}
