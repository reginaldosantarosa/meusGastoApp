<?php

namespace App\Http\Livewire\Plano;

use App\Models\Plano;
use Livewire\Component;

class PlanoList extends Component
{
    public function render()
    {
        $planos=Plano::all(['id','nome','valor','created_at']);
        return view('livewire.plano.plano-list',compact('planos'));
    }
}
