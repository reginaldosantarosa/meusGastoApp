<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;


    protected $fillable= ['nome','type','slug'];


    public function plano()
    {
        return $this->belongsTo(Plano::class); //um usuario, varias despesas.

    }



}
