<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Municipio;

class Cliente extends Model
{
    protected $fillable = [
        'cpf',
        'nome',
        'data_nascimento',
        'sexo',
        'endereco',
        'estado',
        'cidade',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Municipio::class, 'cidade_id');
    }
}
