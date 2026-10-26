<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttipos_motor extends Model
{
    use HasFactory;

    protected $table = 'ttipos_motor';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function coches()
    {
        return $this->hasMany(tcoches::class, 'ttipos_motor_id');
    }
}
