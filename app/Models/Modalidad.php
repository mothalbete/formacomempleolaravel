<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $table = 'modalidad';

    protected $fillable = ['nombre'];

    public function ofertas()
    {
        return $this->hasMany(Oferta::class, 'idmodalidad');
    }
}
