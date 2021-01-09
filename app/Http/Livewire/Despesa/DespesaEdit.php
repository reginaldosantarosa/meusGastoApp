<?php

namespace App\Http\Livewire\Despesa;

use App\Models\Despesa;
use Livewire\Component;

class DespesaEdit extends Component
{

    public Despesa $despesa;

    public $descricao;
    public $valor;
    public $type;
    

    protected $rules = [
        'valor' => 'required',
        'type'   => 'required',
        'descricao' => 'required',
        
    ];

    public function mount(/*Despesa $despesa*/)
        {   
            $this->descricao   = $this->despesa->descricao;
            $this->valor       = $this->despesa->valor ;
            $this->type        = $this->despesa->type ;
        }
    

    public function updateDespesa()
    {
        $this->validate();
    
        $this->despesa->update([
            'descricao' => $this->descricao,
            'valor'      => $this->valor,
            'type'        => $this->type,
            //'photo'       => $this->photo ?? $this->despesa->photo
        ]);

        session()->flash('message', 'Registro atualizado com sucesso!');
    }


    

    public function render()
    {
        return view('livewire.despesa.despesa-edit');
    }
}
