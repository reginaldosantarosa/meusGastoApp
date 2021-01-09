<?php

namespace App\Http\Livewire\Despesa;

use App\Models\Despesa;
use Livewire\Component;

class DespesaCreate extends Component
{

    public $valor=0.00;
    public $descricao;
    public $type;

    protected $rules = [
        'valor' => 'required',
        'type'   => 'required',
        'descricao' => 'required',
       
    ];


    public function createDespesa(){

        $this->validate();

        Despesa::create([
            'valor' => $this->valor,
            'descricao' => $this->descricao,
            'type' => $this->type,
            'user_id' =>1,

        ]);

        session()->flash('message','Registro criado com sucesso');

        $this->valor=$this->descricao= $this->type=null;
    }

    public function render()
    {
        return view('livewire.despesa.despesa-create');
        //return view('livewire.despesa.despesa-create')->layout("ok");
    }
}
