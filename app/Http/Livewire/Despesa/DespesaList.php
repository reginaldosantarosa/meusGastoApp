<?php

namespace App\Http\Livewire\Despesa;

use Livewire\Component;
use App\Models\Despesa;

class DespesaList extends Component
{
    public function render()
    {
        //$despesas = Despesa::all(['id','descricao','valor','type','created_at']);
        $despesas = Despesa::paginate(2);

        return view('livewire.despesa.despesa-list', compact('despesas'));
    }

    public function remove($despesa)
    {
        $despesa=Despesa::find($despesa);
        $despesa->delete();

        session()->flash('message', 'Registro removido com sucesso!');
    }
}
