<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;
    

   protected $fillable= ['user_id','type','descricao', 'preco'];


    public function user()
    {
        return $this->belongsTo(User::class); //um usuario, varias despesas.

    }

}