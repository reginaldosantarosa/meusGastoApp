<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    protected $fillable= ['nome','descricao','slug','reference','preco'] ;


    public function features()
    {
        return $this->hasMany(Feature::class); //um usuario, varias despesas.

    }

}
