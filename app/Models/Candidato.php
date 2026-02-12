<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $table = 'candidatos';

    protected $fillable = [
        'idusuario',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'cv',
        'experiencia',
    ];

    protected $appends = ['cv_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'idusuario');
    }

    public function ofertas()
    {
        return $this->belongsToMany(
            Oferta::class,
            'candidato_oferta',
            'candidato_id',
            'oferta_id'
        )->withTimestamps();
    }

    public function getCvUrlAttribute()
    {
        return $this->cv
            ? asset('storage/cvs/' . $this->cv)
            : null;
    }
}

