<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;


   protected $fillable= ['user_id','type','descricao', 'valor','foto','despesa_data'];

   protected $dates = ['despesa_data'];

   public function getValorAttribute()
   {
       return $this->attributes['valor'] / 100;
   }

   public function setValorAttribute($prop)
   {
       return $this->attributes['valor'] = $prop * 100;
   }

   public function setDespesaDataAttribute($prop)
   {
       if ($prop) {
           return $this->attributes['despesa_data'] = (\DateTime::createFromFormat('d/m/Y H:i:s', $prop))->format('Y-m-d H:i:s');
       }
   }



    public function user()
    {
        return $this->belongsTo(User::class); //um usuario, varias despesas.

    }

}
