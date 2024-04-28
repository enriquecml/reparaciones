<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parte extends Model
{
    use HasFactory;

    protected $fillable=[
        'cliente_id',
        'numero',
        'fecha',
        'maquina',
        'averia',
        'reparacion',
        'mano_obra',
        'desplazamiento',
        'portes',
        'materiales',
        'iva'
    ];

    protected $dates=['fecha'];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function getTotalAttribute(){
        return ($this->mano_obra+$this->desplazamiento+$this->portes+$this->materiales)*(1+$this->iva/100);
    }

}
