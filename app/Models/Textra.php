<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textra extends Model
{
    use HasFactory;

    protected $table = 'textras';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'precio',
    ];

    public function coches()
    {
        return $this->belongsToMany(
            tcoches::class,
            'coche_extra',
            'extra_id',
            'coche_matricula'
        );
    }
}
