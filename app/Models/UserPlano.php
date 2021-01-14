<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlano extends Model
{
    use HasFactory;

    protected $table='user_plano';


    protected $fillable= ['plano_id','referencia_transacao','data_inscricao','status'] ;


    public function user()
    {
        return $this->belongsTo(User::class); //um usuario, varias despesas.

    }


    public function plano()
    {
        return $this->belongsTo(Plano::class); //um usuario, varias despesas.

    }
}
