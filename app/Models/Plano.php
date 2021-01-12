<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    protected $fillable= ['nome','descricao','slug','referencia','valor'] ;

    public function getValorAttribute()
    {
        return $this->attributes['valor'] / 100;
    }

    public function setValorAttribute($prop)
    {
        return $this->attributes['valor'] = $prop * 100;
    }

    public function features()
    {
        return $this->hasMany(Feature::class); //um usuario, varias despesas.

    }

}
