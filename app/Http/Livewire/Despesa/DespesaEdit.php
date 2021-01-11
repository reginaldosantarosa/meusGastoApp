<?php

namespace App\Http\Livewire\Despesa;

use App\Models\Despesa;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class DespesaEdit extends Component
{
    use WithFileUploads;

    public Despesa $despesa;

    public $descricao;
    public $valor;
    public $type;
    public $foto;


    protected $rules = [
        'valor' => 'required',
        'type'   => 'required',
        'descricao' => 'required',
        'foto'=> 'image|nullable',

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


        if($this->foto){
            if (Storage::disk('public')->exists($this->despesa->foto)) {
                Storage::disk('public')->delete($this->despesa->foto);
            }

            $this->foto = $this->foto->store('despesas-foto','public');


        }

        $this->despesa->update([
            'descricao' => $this->descricao,
            'valor'      => $this->valor,
            'type'        => $this->type,
            'foto'       => $this->foto ?? $this->despesa->foto
        ]);

        session()->flash('message', 'Registro atualizado com sucesso!');
    }




    public function render()
    {
        return view('livewire.despesa.despesa-edit');
    }
}
