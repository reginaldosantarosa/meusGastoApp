<?php

namespace App\Http\Livewire\Despesa;


use App\Models\Despesa;
use Livewire\Component;
use Livewire\WithFileUploads;

class DespesaCreate extends Component
{
    use WithFileUploads;

    public $valor=0.00;
    public $descricao;
    public $type;
    public $foto;
    public $despesa_data;

    protected $rules = [
        'valor' => 'required',
        'type'   => 'required',
        'descricao' => 'required',
        'foto'=> 'image|nullable',

    ];


    public function createDespesa(){

        $this->validate();

        if ($this->foto){
            $this->foto = $this->foto->store('despesas-foto','public');
        }

        auth()->user()->despesas()->create([
            'valor' => $this->valor,
            'descricao' => $this->descricao,
            'type' => $this->type,
            'user_id' =>1,
            'foto' => $this->foto,
            'despesa_data' => $this->despesa_data,

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
