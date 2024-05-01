<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;

use function Spatie\LaravelPdf\Support\pdf;

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

    public function getSubtotalAttribute(){
        return ($this->mano_obra+$this->desplazamiento+$this->portes+$this->materiales);
    }

    public function generarPDF(){
        $parte=$this->load('cliente');
        pdf('pdf.parte',compact('parte'))
        ->disk('local')
        ->save('parte'.$this->numero.'.pdf');

        return Storage::disk('local')->download('parte'.$this->numero.'.pdf');

    }

}
